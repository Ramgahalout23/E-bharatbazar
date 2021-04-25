<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [indexController::class, 'index']);
Route::get('/home', [indexController::class, 'index'])->name('home');
Route::get('/products/{id}', [ProductsController::class, 'productDetail']);
Route::get('/productscategories/{category_id}', [IndexController::class, 'categories']);
Route::get('/get-product-price','ProductsController@getprice');
// Routes for add to Cart
Route::match(['get','post'],'/addtoCart','ProductsController@addtoCart');
Route::match(['get','post'],'/Cart','ProductsController@Cart');
Route::match(['get','post'],'/cart/delete-product/{id}','ProductsController@deleteCart');
//Route For update Quantity
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
//Apply Coupon Code
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

Route::match(['get','post'],'admin','AdminController@login');

// Category Route
Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/view-categories','CategoryController@viewCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
Route::post('/admin/update-category-status','CategoryController@updateStatus');


// Products routes
Route::group(['middleware'=>['AdminLogin']],function(){
    Route::match(['get','post'],'/admin/dashboard','AdminController@dashboard');
    Route::match(['get','post'],'/admin/user-profile','AdminController@changePassword');
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/view-product','ProductsController@viewProducts');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProducts');
    Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProducts');
    Route::post('/admin/update-product-status','ProductsController@updateStatus');
    Route::post('/admin/update-featured-product-status','ProductsController@updateFeatured');

});

//Products Attributes
Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');
Route::match(['get','post'],'/admin/delete-attributes/{id}','ProductsController@deleteAttribute');
Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttribute');
Route::match(['get','post'],'/admin/add-images/{id}','ProductsController@addImages');
Route::match(['get','post'],'/admin/delete-alt-image/{id}','ProductsController@deleteAltImage');

//Banners Route
Route::match(['get','post'],'/admin/banners','BannersController@banners');
Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
Route::match(['get','post'],'/admin/delete-banner/{id}','BannersController@deleteBanner');
Route::post('/admin/update-banner-status','BannersController@updateStatus');
// Coupons Routes
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
Route::match(['get','post'],'/admin/view-coupons','CouponsController@viewCoupon');
Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');
Route::post('/admin/update-coupon-status','CouponsController@updateStatus');
Route::get('logout',[AdminController::class,'logout']);

//Route for login-register
Route::get('/login-register','UsersController@userLoginRegister');
//Route for add users registration
Route::post('/user-register','UsersController@register');
//Route for login-User
Route::post('/user-login','UsersController@login');
//Route for add users registration
Route::get('/user-logout','UsersController@logout');

//Route for middleware after front login
Route::group(['middleware' => ['frontlogin']],function(){
//Route for users account
Route::match(['get','post'],'/account','UsersController@account');
Route::match(['get','post'],'/change-password','UsersController@changePassword');
Route::match(['get','post'],'/change-address','UsersController@changeAddress');
Route::match(['get','post'],'/checkout','ProductsController@checkout');
Route::match(['get','post'],'/order-review','ProductsController@orderReview');
Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
Route::get('/thanks','ProductsController@thanks');
Route::match(['get','post'],'/stripe','ProductsController@stripe'); 
Route::get('/orders','ProductsController@userOrders');
Route::get('/orders/{id}','ProductsController@userOrderDetails');
});


// Admin Orders Routes
Route::get('/admin/orders','ProductsController@viewOrders');
Route::get('/admin/orders/{id}','ProductsController@viewOrderDetails');
//Update Order Status
Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');
