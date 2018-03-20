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
Route::get('users/all','UserController@showAll')->name('users.showall');
Route::resource('users','UserController');


Route::get('/tickets/localticket','TicketController@localTicket')->name('tickets.localticket.index');
Route::post('/tickets/localticket','TicketController@localTicketCreate')->name('tickets.localticket.save');

Route::get('/tickets/localcredit','TicketController@localCredit')->name('tickets.localcredit.index');
Route::post('/tickets/localcredit','TicketController@localCreditAdd')->name('tickets.localcredit.save');

Route::get('/tickets/driverticket','TicketController@driverTicket')->name('tickets.driverticket.index');
Route::post('/tickets/driverticket','TicketController@driverTicketCreate')->name('tickets.driverticket.save');

Route::get('/tickets/drivercredit','TicketController@driverCredit')->name('tickets.drivercredit.index');
Route::post('/tickets/drivercredit','TicketController@driverCreditAdd')->name('tickets.drivercredit.save');

Route::post('/tickets/controlparking','TicketController@controlParking')->name('tickets.controlparking.save');

Route::resource('tickets','TicketController');
//checkuser
Route::get('/self_load','CreditController@selfLoad')->name('credit.self');
Route::post('/credit/checkuser','CreditController@checkUser')->name('credit.checkuser');
Route::resource('credit','CreditController');

Route::get('locals/delete/{local_id?}', 'LocalController@delete');// Esto me parece que no va asi
Route::get('locals/all','LocalController@showAll')->name('locals.showall');
Route::resource('locals','LocalController');

Route::get('blocks/delete/{block_id?}', 'BlocksController@delete');
Route::get('blocks/all','BlocksController@showAll')->name('blocks.showall');
Route::resource('blocks','BlocksController');


Route::get('areas/all','AreasController@showAll')->name('areas.showall');
Route::resource('areas','AreasController');

Route::get('costs/all','CostsController@showAll')->name('costs.showall');
Route::resource('costs','CostsController');

Route::get('exeptuatedvehicles/all','ExeptuatedVehiclesController@showAll')->name('exeptuatedvehicles.showall');
Route::resource('exeptuatedvehicles','ExeptuatedVehiclesController');

Route::resource('exeptuatedvehiclesblock','ExeptuatedVehiclesBlocksController');

Route::get('spacereservations/all','SpacesReservationsController@showAll')->name('spacereservations.showall');
Route::get('spacereservations/active','SpacesReservationsController@showActive')->name('spacereservations.active');
Route::resource('spacereservations','SpacesReservationsController');

Route::get('/infringements/cancel/{infringementId?}','InfringementsController@cancel')->name('infringements.cancel.index');
Route::post('/infringements/cancel','InfringementsController@cancelUpdate')->name('infringements.cancel.save');
Route::post('/infringements/img','InfringementsController@uploadImage')->name('infringements.img.upload');
Route::post('/infringements/comments','InfringementsController@uploadComments')->name('infringements.comments.upload');
Route::post('/infringements/close','InfringementsController@close')->name('infringements.close');
Route::get('infringements/control','InfringementsController@control')->name('infringements.control');

Route::get('infringements/all','InfringementsController@showAll')->name('infringements.all');
Route::get('infringements/filter','InfringementsController@filter')->name('infringements.filter');



Route::resource('infringements','InfringementsController');

Route::resource('infringementcauses','InfringementCausesController');

// Estadisticas
Route::get('/statistics/ticketsStatistics','StatisticsController@ticketsStatistics');
Route::get('/statistics/ticketsFiltros','StatisticsController@ticketsFiltros');
Route::get('/statistics/ticketsBlock','StatisticsController@ticketsBlock');
Route::get('/statistics/infringementsBlock','StatisticsController@infringementsBlock');
Route::get('/statistics/operationsStatistics','StatisticsController@operationsStatistics');


Route::resource('statistics','StatisticsController');
