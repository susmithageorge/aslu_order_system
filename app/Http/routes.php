<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@getLogout');


// Using A Route Closure...
Route::get('admin', [
    'middleware' => 'auth',
    'uses' => 'AdminController@dashboard'
]);

// Using A Route Closure...
Route::get('users', [
    'middleware' => 'auth',
    'uses' => 'UsersController@dashboard'
]);

Route::any('login', function() 
{
	return redirect('auth/login');
});

Route::get('/', function() 
{
	if(\Auth::check()){
		$user_type = Auth::user()->user_type;
		if($user_type == 1){
		 	return redirect('admin/dashboard');
		}else{
			return redirect('users/dashboard');
		}
	}else{
		return View::make("ace_admin.views.home");
	}
});

// GET route
Route::get('login', function() {
  return View::make('login');
});

// GET route
Route::get('get_form', function() {
	/*$category_id = Input::get('category_id');
	if(Request::ajax()){
	  	$sub_categories = \App\SubCategory::where("category_id", $category_id)->lists("alcohol_content_per_item","liter_per_item","description","name", "id");
	  	$sub_category_select = \App\SubCategory::where("category_id", $category_id)->lists("name", "id");
	    return View::make("ace_admin.views.get_form", ['sub_categories' => $sub_categories, 'sub_category_select' => $sub_category_select]);
	} */
	return View::make("ace_admin.views.get_form");  
});

Route::get('/documentation', function()
{
	return View::make('documentation');
});

// Using A Route Closure...
Route::get('home', [
    'middleware' => 'auth',
    'uses' => 'UsersController@dashboard'
]);

// User routes
Route::group([ 'prefix' => 'users', 'middleware' => 'auth'], function() {
	Route::get('dashboard', 'UsersController@dashboard');

	/* Orders */
	Route::get('orders', 'UsersController@listOrders');
	Route::get('orders/new', 'UsersController@addOrder');
	Route::get('orders/add_items/{manufacturer_id}', 'UsersController@addItemForm');
	Route::get('orders/pluck_mrp/{prod_id}', 'UsersController@pluckProdMrp');
	Route::post('order/add', 'UsersController@storeOrder');
	Route::any('orders/{id}/delete', array('as' => 'userordersdestroy', 'uses' => 'UsersController@orderDelete'));
	Route::any('orders/{id}/view', array('as' => 'userordersview', 'uses' => 'UsersController@orderView'));
	Route::any('orders/{id}/export', array('as' => 'userordersexport', 'uses' => 'UsersController@orderExport'));

});	
// Admin routes
Route::group([ 'prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('dashboard', 'AdminController@listOrders');	
	// users
	Route::get('users', 'AdminController@getUsers');
	Route::get('user/add', 'AdminController@addUser');
	Route::post('user/add', 'AdminController@storeUser');
	Route::get('user/{id}/edit', 'AdminController@editUser');
	Route::post('user/{id}/edit', 'AdminController@updateUser');
	Route::post('user/{id}/changepassword', 'AdminController@updatePassword');
	Route::delete('user/{id}/delete', 'AdminController@deleteUser');


	// manufacturers
	Route::get('manufacturers', 'AdminController@getManufacturers');
	Route::get('manufacturer/add', 'AdminController@addManufacturer');
	Route::post('manufacturer/add', 'AdminController@storeManufacturer');
	Route::get('manufacturer/{id}/edit', 'AdminController@editManufacturer');
	Route::post('manufacturer/{id}/edit', 'AdminController@updateManufacturer');
	Route::delete('manufacturer/{id}/delete', 'AdminController@deleteManufacturer');
	Route::any('manufacturers/sync', 'AdminController@syncManufacturer');

	// Dealers
	Route::get('dealers', 'AdminController@getDealers');
	Route::get('dealer/add', 'AdminController@addDealer');
	Route::post('dealer/add', 'AdminController@storeDealer');
	Route::get('dealer/{id}/edit', 'AdminController@editDealer');
	Route::post('dealer/{id}/edit', 'AdminController@updateDealer');
	Route::delete('dealer/{id}/delete', 'AdminController@deleteDealer');
	Route::any('dealers/sync', 'AdminController@syncDealer');

	// products
	Route::get('products', 'AdminController@getProducts');
	Route::get('product/add', 'AdminController@addProduct');
	Route::post('product/add', 'AdminController@storeProduct');
	Route::get('product/{id}/edit', 'AdminController@editProduct');
	Route::post('product/{id}/edit', 'AdminController@updateProduct');
	Route::delete('product/{id}/delete', 'AdminController@deleteProduct');
	Route::any('products/sync', 'AdminController@syncProduct');
	
	// Order
	Route::get('orders', 'AdminController@listOrders');
	Route::get('order/{id}/edit', 'AdminController@editOrder');
	Route::post('order/{id}/edit', 'AdminController@updateOrder');
	Route::any('order/export', 'AdminController@exportOrder');
	Route::any('orders/{id}/delete', array('as' => 'adminordersdestroy', 'uses' => 'AdminController@orderDelete'));
	Route::any('orders/{id}/view', array('as' => 'adminordersview', 'uses' => 'AdminController@orderView'));
	Route::any('orders/{id}/export', array('as' => 'adminordersexport', 'uses' => 'AdminController@orderExport'));
	Route::any('orders/{id}/change_status', array('as' => 'adminorderschangestatus', 'uses' => 'AdminController@orderChangeStatus'));
});

