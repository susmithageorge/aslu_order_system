<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Input;
use Validator;
use Redirect;
use Hash;
use DB;
use Auth;

class AdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\AdminMiddleware');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function dashboard()
    {
       
        //
        $orders = \App\Order::paginate(15);
        return view("admin/orders/list", ['orders' => $orders]);
    }

    
    /* Users */
    function getUsers(){
        $users = \App\User::where('id', "!=", 1)->paginate(15);
        return view("admin/users/list", ['users' => $users]);
    }

     public function addUser(){
        return view('admin/users/add');
    }


    public function storeUser(){
        $input = Input::all();
        
        $validate = Validator::make(Input::all(), [
                'name'      => 'required',
                'email'     => 'required|email|unique:users',
                'username'  => 'required|unique:users,username|min:5',
                'password'  => 'required|min:5'
        ]);
        
        if (!$validate->fails()){
            $user                = new \App\User;
            $user->email        = trim(Input::get('email'));
            $user->name         = trim(Input::get('name'));
            $user->address      = Input::get('address');
            $user->bio          = Input::get('bio');
            $user->user_type    = 2;
            $user->username         = trim(Input::get('username'));
            $user->password     = Hash::make(Input::get('password'));
            if($user->save()){
                return redirect("admin/users")->with('success', 'User added successfully!');
            }else{
                return Redirect::back()->withInput()->withErrors("Unable to save user.");
            }    
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }


    public function editUser($id){
        $user = \App\User::findOrFail($id);
        return view('admin/users/edit', ['user' => $user]);
    }

    public function updateUser($id){
        $user = \App\User::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
                'name'      => 'required',
                'username'  => 'required||min:5|unique:users,username,'.$user->id,
                'email'     => 'required|email',
        ]);
        
        if (!$validate->fails()){
            $user->email        = trim(Input::get('email'));
            $user->username     = trim(Input::get('username'));
            $user->name         = trim(Input::get('name'));
            $user->address      = Input::get('address');
            $user->bio          = Input::get('bio');
            if($user->save()){
                return redirect("admin/users")->with('success', 'User updated successfully!');
            }else{
                return Redirect::back()->withInput()->withErrors("Unable to save user.");
            }    
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }

    public function changePassword($id){
        $user = \App\User::find($id);
        if($user){
            return view('admin/users/change_password', ['user' => $user]);
        }else{
            return Redirect::back()->withInput()->withErrors("Unable to find user.");
        }
    }

    public function updatePassword($id){
        $user = \App\User::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
                'password'              => 'required|min:5|confirmed',
                'password_confirmation' => 'required|min:5'
        ]);
        
        if (!$validate->fails()){
            $user->password     = Hash::make(Input::get('password'));
            if($user->save()){
                return redirect("admin/users")->with('success', 'Password changed successfully!');
            }else{
                return Redirect::back()->withInput()->withErrors("Unable to save user.");
            }    
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }

    public function deleteUser($id){
        $user = \App\User::findOrFail($id);
        $user->delete();
        return redirect("admin/users")->with('success', 'User deleted successfully!');
    }

    /*********************/

    /********** Dealers***********/

    function syncDealer(){
       $dealers = DB::connection('mysql_master')->table('party_master')->select("PM_ID", "PM_Name","PM_AddressOff", "PM_CityOff", "PM_EmailOff")->get();
       $new_list = array();
       foreach($dealers as $dealer){
            $name = $dealer->PM_Name;
            if(!empty($name)){
                    $new_list[] = ['user_id' => Auth::user()->id, 
                            'party_master_id' => $dealer->PM_ID,
                            'name' => $dealer->PM_Name,
                            'address' => $dealer->PM_AddressOff,
                            'city' => $dealer->PM_CityOff,
                            'email' => $dealer->PM_EmailOff,
                            'created_at'=>date('Y-m-d H:i:s'),
                            'updated_at'=> date('Y-m-d H:i:s')
                    ];
            }       
       }
       if(!empty($new_list)){
        DB::table('dealers')->truncate();
        DB::table('dealers')->insert($new_list);
       }
       print count($new_list);
    }


    function getDealers(){
        $dealers = \App\Dealer::paginate(15);;
        return view("admin/dealers/list", ['dealers' => $dealers]);
    }

    public function editDealer($id){
        $dealer  = \App\Dealer::findOrFail($id);
        return view('admin/dealers/edit', ['dealer' => $dealer]);
    }

    public function updateDealer($id){
        $dealer = \App\Dealer::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
            'name'      => 'required',
            'address'   => 'required',
            'city'      => 'required'
        ]);
        if (!$validate->fails()){
            $dealer->name             = Input::get('name');
            $dealer->address          = Input::get('address');
            $dealer->city             = Input::get('city');
            $dealer->email            = Input::get('email');
            $dealer->save();
            return redirect("admin/dealers")->with('success', 'Dealer updated successfully!');
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }

    public function deleteDealer($id){
        $dealer = \App\Dealer::findOrFail($id);
        $dealer->delete();
        return redirect("admin/dealers")->with('success', 'Dealer deleted successfully!');
    }


    /********** Manufacturers***********/
    function syncManufacturer(){
       $manufacturers = DB::connection('mysql_master')->table('itemmaster')->select("ID", "Manufacturer")->groupBy('Manufacturer')->get();
       $new_list = array();
       foreach($manufacturers as $manufacturer){
            $name = $manufacturer->Manufacturer;
            if(!empty($name)){
                    $new_list[] = ['user_id'    => Auth::user()->id, 
                            'itemmaster_id'     => $manufacturer->ID,
                            'name'              => $manufacturer->Manufacturer,
                            'created_at'        =>date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                    ];
            }       
       }
       if(!empty($new_list)){
        DB::table('manufacturers')->truncate();
        DB::table('manufacturers')->insert($new_list);
       }
       print count($new_list);
    }


    function getManufacturers(){
        $manufacturers = \App\Manufacturer::orderBy('name')->paginate(15);
        return view("admin/manufacturers/list", ['manufacturers' => $manufacturers]);
    }

    public function editManufacturer($id){
        $manufacturer  = \App\Manufacturer::findOrFail($id);
        return view('admin/manufacturers/edit', ['manufacturer' => $manufacturer]);
    }

    public function updateManufacturer($id){
        $manufacturer = \App\Manufacturer::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
            'name'      => 'required'
        ]);
        if (!$validate->fails()){
            $manufacturer->name             = Input::get('name');
            $manufacturer->description      = Input::get('description');
            $manufacturer->save();
            return redirect("admin/manufacturers")->with('success', 'Manufacturer updated successfully!');
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }

    public function deleteManufacturer($id){
        $manufacturer = \App\Manufacturer::findOrFail($id);
        $manufacturer->delete();
        return redirect("admin/manufacturers")->with('success', 'Manufacturer deleted successfully!');
    }


    /********** Products ***********/
    function syncProduct(){
       $products = DB::connection('mysql_master')->table('itemmaster')->select("ID", "Code", "Name", "Std_Rate", "Sales_Rate", "Market_Rate", "MinRetailPrice", "MaxRetailPrice", "Manufacturer")->groupBy('Name')->get();
       $new_list = array();
       foreach($products as $product){
            $name = $product->Name;
            if(!empty($name)){
                    $manufacturer_id = DB::table('manufacturers')->where('name', $product->Manufacturer)->pluck('id');
                    if(empty($manufacturer_id)){
                        $manufacturer_id = 0;
                    }
                    $new_list[] = ['user_id'            => Auth::user()->id, 
                            'itemmaster_id'             => $product->ID,
                            'manufacturer_id'           => $manufacturer_id,
                            'name'                      => $product->Name,
                            'code'                      => $product->Code,
                            'std_rate'                  => $product->Std_Rate,
                            'sales_rate'                => $product->Sales_Rate,
                            'market_rate'               => $product->Market_Rate,
                            'min_retail_price'          => $product->MinRetailPrice,
                            'max_retail_price'          => $product->MaxRetailPrice,
                            'created_at'                =>date('Y-m-d H:i:s'),
                            'updated_at'                => date('Y-m-d H:i:s')
                    ];
            }       
       }
       if(!empty($new_list)){
        DB::table('products')->truncate();
        DB::table('products')->insert($new_list);
       }
       print count($new_list);
    }


    function getProducts(){
        $products = \App\Product::orderBy('name')->paginate(15);
        return view("admin/products/list", ['products' => $products]);
    }

    public function editProduct($id){
        $product  = \App\Product::findOrFail($id);
        $manufacturers  = \App\Manufacturer::lists('name', 'id');
        return view('admin/products/edit', ['product' => $product, 'manufacturers' => $manufacturers]);
    }

    public function updateProduct($id){
        $product = \App\Product::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
            'name'      => 'required'
        ]);
        if (!$validate->fails()){
            $product->name                  = Input::get('name');
            $product->manufacturer_id       = Input::get('manufacturer_id');
            $product->code                  = Input::get('code');
            $product->std_rate              = Input::get('std_rate');
            $product->sales_rate            = Input::get('sales_rate');
            $product->market_rate           = Input::get('market_rate');
            $product->min_retail_price      = Input::get('min_retail_price');
            $product->max_retail_price      = Input::get('max_retail_price');
            $product->save();
            return redirect("admin/products")->with('success', 'Product updated successfully!');
        }else{
            return Redirect::back()->withInput()->with('error', 'Error: Please fix the errors')->withErrors($validate);
        }
    }

    public function deleteProduct($id){
        $product = \App\Product::findOrFail($id);
        $product->delete();
        return redirect("admin/products")->with('success', 'Product deleted successfully!');
    }


    /********** Categories***********/
    function getCategories(){
        $categories = \App\Category::paginate(15);;
        return view("admin/category/list", ['categories' => $categories]);
    }

    public function addCategory(){
        return view('admin/category/add');
    }

    public function storeCategory(){
        $input = Input::all();
        
        $validate = Validator::make(Input::all(), [
                'name' => 'required'
        ]);
        
        if (!$validate->fails()){
            $name                   = Input::get('name');
            $description            = Input::get('description');
            $standard               = Input::get('standard');
            $category               = new \App\Category;
            $category->name         = $name;
            $category->description  = $description;
            $category->standard     = $standard;
            $category->save();
            return redirect("admin/categories")->with('success', 'Category added successfully!');
        }else{
            return Redirect::back()->with('error', 'Error: Please fill name');
        }
    }

     public function editCategory($id){
        $category = \App\Category::findOrFail($id);
        return view('admin/category/edit', ['category' => $category]);
    }

    public function updateCategory($id){
        $category = \App\Category::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
            'name' => 'required',
        ]);
        if (!$validate->fails()){
            $category->name             = Input::get('name');
            $category->description      = Input::get('description');
            $category->standard         = Input::get('standard');;
            $category->save();
            return redirect("admin/categories")->with('success', 'Category updated successfully!');
        }else{
            return Redirect::back()->with('error', 'Error: Invalid data');
        }
    }

    public function deleteCategory($id){
        $category = \App\Category::findOrFail($id);
        $category->delete();
        return redirect("admin/categories")->with('success', 'Category deleted successfully!');
    }

    /*************** ORDERS **********************/
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function listOrders()
    { 
        //
        $orders = \App\Order::orderBy('created_at', "desc")->paginate(15);
        return view("admin.orders.index", ['orders' => $orders]);
    }

    function orderDelete($order_id){
        if(\App\Order::findOrFail($order_id)){
            \App\Order::destroy($order_id);
            \App\Item::where('order_id', $order_id)->delete();
            return redirect("admin/orders")->with('warning', 'Order deleted successfully!');
        }else{
            return redirect("admin/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }

    function orderView($order_id){
        if($order = \App\Order::findOrFail($order_id)){
            return view("admin.orders.view", ['order' => $order]);
        }else{
            return redirect("admin/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }

    function orderExport($order_id){
        if($order = \App\Order::findOrFail($order_id)){
            $data = array();
            $items = $order->items;
            $cnt = 0;
            foreach($items as $item){
                $cnt++;
                $data[] = ['#'  => $cnt, 'Order' => $order->name, 'Dealer' => $order->dealer_name, 'User' => $order->user->name, 'Manufacturer' => $order->manufacturer_name, 'Item code' => $item->product->code, 'Item name' => $item->name, 'Quantity' => $item->quantity, 'Price' => $item->price . "/-", 'Remarks' => $item->remarks, 'Dated' => date("d-m-Y", strtotime($order->created_at))];
            }
            if(!empty($data)){
                \Excel::create($order->name, function($excel) use($data, $order) {
                    $excel->sheet('Order - ' . date("F d, Y", strtotime($order->created_at)) , function($sheet) use($data) {
                        $sheet->fromArray($data);
                    });
                })->export('xls');
            }    
        }else{
            return redirect("admin/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }

    function orderChangeStatus($order_id){
        if($order = \App\Order::findOrFail($order_id)){
            if($order->sent_flag == 1){
                $order->sent_flag = 0;     
            }else{
                $order->sent_flag = 1;
            }
            if($order->save()){
                return Redirect::back()->with('success', 'Status changed successfully.');
            } else {
                return Redirect::back()->with('error', 'Unable to change status. Please try again.');    
            }    
        }else{
            return redirect("admin/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }
    /***************************************/

    // Sub categories
    function getSubCategories(){
        $sub_categories = \App\SubCategory::paginate(15);;
        return view("admin/sub_category/list", ['sub_categories' => $sub_categories]);
    }

    public function addSubCategory($id = null){
        $category   = array();
        $categories = \App\Category::lists("name", "id");
        if($id){
            $category = \App\Category::findOrFail($id);
        }
        return view('admin/sub_category/add', ["category" => $category, "categories" => $categories]);
    }

    public function storeSubCategory(){
        $input = Input::all();
        
        $validate = Validator::make(Input::all(), [
                'category_id'               => 'required',
                'name'                      => 'required',
                'liter_per_item'            => 'required|numeric',
                'alcohol_content_per_item'  => 'required|numeric'
        ]);
        
        if (!$validate->fails()){
            $sub_category                               = new \App\SubCategory;
            $sub_category->category_id                  = Input::get('category_id');
            $sub_category->name                         = Input::get('name');
            $sub_category->description                  = Input::get('description');
            $sub_category->liter_per_item               = Input::get('liter_per_item');
            $sub_category->alcohol_content_per_item     = Input::get('alcohol_content_per_item');
            $sub_category->save();
            return redirect("admin/sub_categories")->with('success', 'Sub Category added successfully!');
        }else{
            return Redirect::back()->with('error', 'Error: Invalid data');
        }
    }

     public function editSubCategory($id){
        $sub_category = \App\SubCategory::findOrFail($id);
        $categories = \App\Category::lists("name", "id");
        return view('admin/sub_category/edit', ['categories' => $categories, 'sub_category' => $sub_category]);
    }

    public function updateSubCategory($id){
        $sub_category = \App\SubCategory::findOrFail($id);
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
            'name' => 'required',
        ]);
        if (!$validate->fails()){
            $sub_category->category_id                  = Input::get('category_id');
            $sub_category->name                         = Input::get('name');
            $sub_category->description                  = Input::get('description');
            $sub_category->liter_per_item               = Input::get('liter_per_item');
            $sub_category->alcohol_content_per_item     = Input::get('alcohol_content_per_item');
            $sub_category->save();
            return redirect("admin/sub_categories")->with('success', 'Sub Category updated successfully!');
        }else{
            return Redirect::back()->with('error', 'Error: Invalid data');
        }
    }

    public function deleteSubCategory($id){
        $sub_category = \App\SubCategory::findOrFail($id);
        $sub_category->delete();
        return redirect("admin/sub_categories")->with('success', 'Sub Category deleted successfully!');
    }
}
