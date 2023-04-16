<?php

use App\Product;
use App\Category;
use App\Http\Controllers\Dashboard\HomeImagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
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

Route::get('/', function () {
    return view('welcome');
});





/*
|--------------------------------------------------------------------------
| Frontend Routes Start
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Dashboard'], function () {
    /*
    |--------------------------------------------------------------------------
    | Frontend Controller Routes Start
    |--------------------------------------------------------------------------
    */
    Route::match(['get', 'post'], '/','AdminController@login');


});
/*
|--------------------------------------------------------------------------
| Frontend Routes End
|--------------------------------------------------------------------------
*/

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
