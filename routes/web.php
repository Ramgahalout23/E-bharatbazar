<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
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
Route::get('logout',[AdminController::class,'logout']);
