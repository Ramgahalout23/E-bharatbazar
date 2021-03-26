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
Auth::routes();
Route::match(['get','post'],'admin','AdminController@login');

// Category Route
Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/view-categories','CategoryController@viewCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
Route::post('/admin/update-category-status','CategoryController@updateStatus');


// Products routes
Route::group(['middleware'=>['auth']],function(){
    Route::match(['get','post'],'/admin/dashboard','AdminController@dashboard');
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/view-product','ProductsController@viewProducts');
    Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProducts');
    Route::match(['get','post'],'/admin/delete-product/{id}','ProductsController@deleteProducts');
    Route::post('/admin/update-product-status','ProductsController@updateStatus');

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

Route::get('logout',[AdminController::class,'logout']);
