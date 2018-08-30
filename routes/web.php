<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index', ['middleware'=> ['auth']])->name('home');

Route::get('/dashboard','DashboardController@index', ['middleware'=> ['auth']]);
Route::resource('/colors','Master\ColorController', ['middleware'=> ['auth']]);
Route::post('/colors/status','Master\ColorController@changeStatus', ['middleware'=> ['auth']]);
Route::resource('/sizes','Master\SizeController', ['middleware'=> ['auth']]);
Route::post('/sizes/status','Master\SizeController@changeStatus', ['middleware'=> ['auth']]);
Route::resource('/units','Master\UnitController', ['middleware'=> ['auth']]);
Route::post('/units/status','Master\UnitController@changeStatus', ['middleware'=> ['auth']]);

Route::resource('/categories','CategoryController', ['middleware'=> ['auth']]);
Route::post('/categories/status','CategoryController@changeStatus', ['middleware'=> ['auth']]);

Route::resource('/staffs','StaffController', ['middleware'=> ['auth']]);
Route::post('/staffs/status','StaffController@changeStatus', ['middleware'=> ['auth']]);

Route::group(['prefix'=>'stores'],function(){
	Route::resource('/','StoreController');
	Route::post('/status','StoreController@changeStatus');
});

Route::resource('/events','EventController', ['only' => ['index', 'store', 'update', 'destroy']]);

Route::group(['prefix'=>'suppliers'],function(){
	Route::resource('/','SupplierController');
	Route::post('/status','SupplierController@changeStatus');
});
Route::group(['prefix'=>'brands'],function(){
	Route::resource('/','BrandController');
	Route::post('/status','BrandController@changeStatus');
});

Route::group(['prefix'=>'items'],function(){
	Route::resource('/','ItemController');
	Route::resource('/fields','ItemFieldController');
	Route::post('/status','ItemController@changeStatus');
	Route::post('/restore','ItemController@restoreItem');
});