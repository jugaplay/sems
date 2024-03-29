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

Route::get('/home', 'HomeController@index')->name('home');

// Rutas para dar de alta patentes dentro de usuarios
Route::get('/users/vehicles','UserController@userVehicles')->name('user.vehicles.index');
Route::post('/users/vehicles','UserController@associateVehicle')->name('user.vehicles.save');
// corre esta funcion (userVehicles) con este control (UserController)

Route::resource('users','UserController');
Route::resource('locals','LocalController');
Route::resource('blocks','BlocksController');
Route::resource('areas','AreasController');
Route::resource('exeptuatedvehicles','ExeptuatedVehiclesController');



//Route::get('/cuentas','CuentasController@cuentas')->name('cuentas');
//Route::get('projects/delete/{company_id?}', 'ProjectsControler@delete'); // Le paso la variable a leer
