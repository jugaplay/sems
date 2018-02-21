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
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

// Rutas para dar de alta patentes dentro de usuarios
Route::get('/users/vehicles','UserController@userVehicles')->name('user.vehicles.index');
Route::post('/users/vehicles','UserController@associateVehicle')->name('user.vehicles.save');

Route::get('/users/vehiclesOff','UserController@userVehiclesOff')->name('user.vehiclesOff.index');
Route::post('/users/vehiclesOff','UserController@disassociateVehicle')->name('user.vehiclesOff.save');

// corre esta funcion (userVehicles) con este control (UserController)
Route::resource('users','UserController');

Route::get('/locals/ticket','LocalController@localTicket')->name('locals.ticket.index');
Route::post('/locals/ticket','LocalController@localTicketCreate')->name('locals.ticket.save');

Route::get('/locals/credit','LocalController@localCredit')->name('locals.credit.index');
Route::post('/locals/credit','LocalController@localCreditAdd')->name('locals.credit.save');

Route::get('locals/delete/{local_id?}', 'LocalController@delete');
Route::resource('locals','LocalController');

Route::get('blocks/delete/{block_id?}', 'BlocksController@delete');
Route::get('blocks/all','BlocksController@showAll')->name('blocks.showall');
Route::resource('blocks','BlocksController');


Route::get('areas/all','AreasController@showAll')->name('areas.showall');
Route::resource('areas','AreasController');

Route::get('costs/all','CostsController@showAll')->name('costs.showall');
Route::resource('costs','CostsController');

Route::resource('exeptuatedvehicles','ExeptuatedVehiclesController');

Route::resource('exeptuatedvehiclesblock','ExeptuatedVehiclesBlocksController');

Route::get('spacereservations/all','SpacesReservationsController@showAll')->name('spacereservations.showall');
Route::resource('spacereservations','SpacesReservationsController');
