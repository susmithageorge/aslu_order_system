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
class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\UserMiddleware');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function dashboard()
    { 
        //
        return view("users.users.home");
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function listOrders()
    { 
        //
        $orders = \App\Order::where('user_id', Auth::user()->id)->paginate(15);
        return view("users.orders.index", ['orders' => $orders]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function addOrder()
    { 
        //
        $dealers            = \App\Dealer::orderBy("name", "asc")->lists("name", "id")->toArray();
        $manufacturers      = \App\Manufacturer::orderBy("name", "asc")->lists("name", "id")->toArray();
        $dealers            = array('' => 'Select dealers') + $dealers;
        $manufacturers      = array('' => 'Select manufacturers') +  $manufacturers;
        return view("users.orders.add", ['manufacturers' => $manufacturers, 'dealers' => $dealers]);
    }

    function addItemForm($manufacturer_id){
        $products           = \App\Product::where('manufacturer_id', $manufacturer_id)->orderBy("name", "asc")->lists("name", "id")->toArray();
        $products           = array('' => 'Select product') +  $products;
        return view("users.orders.ajax_add_items", ['products' => $products]);
    }

    function pluckProdMrp($prod_id){
        return DB::table('products')->where('id', $prod_id)->pluck('max_retail_price');
    }

    function storeOrder(){
        $input = Input::all();
        $validate = Validator::make(Input::all(), [
                'manufacturer_id'      => 'required',
                'dealer_id'            => 'required'
        ]);
        
        if (!$validate->fails()){
            $dealer                 = DB::table('dealers')->where('id', Input::get('dealer_id'))->first();
            $manufacturer           = DB::table('manufacturers')->where('id', Input::get('manufacturer_id'))->first();

            $order                          = new \App\Order;
            $order->user_id                 = Auth::user()->id;
            $order->dealer_id               = Input::get('dealer_id');
            $order->manufacturer_id         = Input::get('manufacturer_id');
            $order->name                    = "";
            $order->dealer_name             = $dealer->name;
            $order->manufacturer_name       = $manufacturer->name;
            $order->description             = "";

            if($order->save()){
                $order_id           = $order->id;
                $order              = \App\Order::find($order_id);
                $order->name        = "OrdNo-" . $order_id;
                $order->save();
                $items = array();
                $product_names  = Input::get("prod_name");
                $qtys           = Input::get("prod_qty");
                $remarks        = Input::get("prod_remark");

                for($i = 0; $i < 25; $i++){
                    if(isset($product_names[$i])){
                        $product = \App\Product::where('id', $product_names[$i])->first();
                        $mrp = 0;
                        $item_qty = 0;
                        $total_price = 0;
                        if($product){
                            $mrp = $product->max_retail_price;
                            $item_qty = $qtys[$i];
                            $total_price = $mrp * $item_qty;
                            $items[]    = [
                                                'order_id'      => $order_id, 
                                                'product_id'    => $product->id,
                                                'name'          => $product->name,
                                                'quantity'      => $item_qty,
                                                'price'         => $total_price,
                                                'remarks'       => $remarks[$i]
                                           ];

                        }                   
                    }    
                }
                //dd($items);
                DB::table('items')->insert($items);
                return redirect("users/orders")->with('success', 'Order added successfully!');
            }else{
                return Redirect::back()->withInput()->withErrors("Unable to create order.");
            }    
        }else{
            return Redirect::back()->withInput()->with('error', 'You need to select Manufacturer and Dealer')->withErrors($validate);
        }
    }

    function orderDelete($order_id){
        if(\App\Order::findOrFail($order_id)){
            \App\Order::destroy($order_id);
            \App\Item::where('order_id', $order_id)->delete();
            return redirect("users/orders")->with('warning', 'Order deleted successfully!');
        }else{
            return redirect("users/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }

    function orderView($order_id){
        if($order = \App\Order::findOrFail($order_id)){
            return view("users.orders.view", ['order' => $order]);
        }else{
            return redirect("users/orders")->with('error', 'Unable to find the order. Please try again.');
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
            return redirect("users/orders")->with('error', 'Unable to find the order. Please try again.');
        }    
    }
}

