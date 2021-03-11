<?php
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminController;
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

Route::group(['middleware'=>['auth']],function(){
    Route::match(['get','post'],'/admin/dashboard','AdminController@dashboard');
    Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
    Route::match(['get','post'],'/admin/view-product','ProductsController@viewProducts');

});
Route::get('logout',[AdminController::class,'logout']);
