<?php

use Illuminate\Http\Request;
Route::get('/', function () {
  return view('welcome');
});
Route::get('/null', function () {
  return view('welcome');
});
Route::get('RedirectToServer', 'InicioController@RedirectToServer');

Route::get('test','AlmacenController@test');
Route::group(['middleware' => ['jwt.auth']], function() {
Route::get('almacen', 'AlmacenController@test');
Route::post('setMenu', 'InicioController@setMenu');
     //******* Tipo pago ******//
    Route::post('tipoPago/GetAll', 'TipoPagoController@GetAll');
    Route::post('tipoPago/DeleteById', 'TipoPagoController@DeleteById');
    Route::post('tipoPago/SaveData', 'TipoPagoController@SaveData');
    Route::post('tipoPago/GetById', 'TipoPagoController@GetById');
    Route::post('tipoPago/Update', 'TipoPagoController@Update');
    //******* Tipo empleado ******//
    Route::post('tipoEmpleado/GetAll', 'TipoEmpleadoController@GetAll');
    Route::post('tipoEmpleado/DeleteById', 'TipoEmpleadoController@DeleteById');
    Route::post('tipoEmpleado/SaveData', 'TipoEmpleadoController@SaveData');
    Route::post('tipoEmpleado/GetById', 'TipoEmpleadoController@GetById');
    Route::post('tipoEmpleado/Update', 'TipoEmpleadoController@Update');
    //******* empleado ******//
    Route::post('empleado/GetAll', 'EmpleadoController@GetAll');
    Route::post('empleado/DeleteById', 'EmpleadoController@DeleteById');
    Route::post('empleado/SaveData', 'EmpleadoController@SaveData');
    Route::post('empleado/GetById', 'EmpleadoController@GetById');
    Route::post('empleado/Update', 'EmpleadoController@Update');
    //******* pago ******//
    Route::post('pago/GetAll', 'PagoController@GetAll');
    Route::post('pago/DeleteById', 'PagoController@DeleteById');
    Route::post('pago/SaveData', 'PagoController@SaveData');
    Route::post('pago/GetById', 'PagoController@GetById');
    Route::post('pago/Update', 'PagoController@Update');
    
    /********EXTERNAL CALCULATE****/
    Route::post('salidaDetalle/salidaItemCalculo', 'SalidaDetalleController@salidaItemCalculo');
     
 });
