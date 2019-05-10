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
     //******* EMPRESAS ******//
    Route::get('empresa/GetAll', 'EmpresaController@GetAll');
    Route::post('empresa/DeleteById', 'EmpresaController@DeleteById');
    Route::post('empresa/SaveData', 'EmpresaController@SaveData');
    Route::post('empresa/GetById', 'EmpresaController@GetById');
    Route::post('empresa/Update', 'EmpresaController@Update');
    //******* CATEGORIA ******//
    Route::get('categoria/GetAll', 'CategoriaController@GetAll');
    Route::post('categoria/DeleteById', 'CategoriaController@DeleteById');
    Route::post('categoria/SaveData', 'CategoriaController@SaveData');
    Route::post('categoria/GetById', 'CategoriaController@GetById');
    Route::post('categoria/Update', 'CategoriaController@Update');
    //******* UNIDAD ******//
    Route::get('unidad/GetAll', 'UnidadController@GetAll');
    Route::post('unidad/DeleteById', 'UnidadController@DeleteById');
    Route::post('unidad/SaveData', 'UnidadController@SaveData');
    Route::post('unidad/GetById', 'UnidadController@GetById');
    Route::post('unidad/Update', 'UnidadController@Update');
    //******* PROVEEDOR ******//
    Route::get('proveedor/GetAll', 'ProveedorController@GetAll');
    Route::post('proveedor/DeleteById', 'ProveedorController@DeleteById');
    Route::post('proveedor/SaveData', 'ProveedorController@SaveData');
    Route::post('proveedor/GetById', 'ProveedorController@GetById');
    Route::post('proveedor/Update', 'ProveedorController@Update');
    //******* COMPRA ******//
    // Route::get('compra/GetAll', 'CompraController@GetAll');
    // Route::post('compra/DeleteById', 'CompraController@DeleteById');
    // Route::post('compra/SaveData', 'CompraController@SaveData');
    // Route::post('compra/GetById', 'CompraController@GetById');
    // Route::post('compra/Update', 'CompraController@Update');
    //******* ITEM ******//
    Route::post('item/GetAll', 'ItemController@GetAll');
    Route::post('item/DeleteById', 'ItemController@DeleteById');
    Route::post('item/SaveData', 'ItemController@SaveData');
    Route::post('item/GetById', 'ItemController@GetById');
    Route::post('item/Update', 'ItemController@Update');
    Route::post('item/GetByEmpresaId', 'ItemController@GetByEmpresaId');

    //******* SALIDA ******//
    Route::get('salida/GetAll', 'SalidaController@GetAll');
    Route::post('salida/DeleteById', 'SalidaController@DeleteById');
    Route::post('salida/SaveData', 'SalidaController@SaveData');
    Route::post('salida/GetById', 'SalidaController@GetById');
    Route::post('salida/Update', 'SalidaController@Update');
    Route::post('salida/GetByEmpresaId', 'SalidaController@GetByEmpresaId');
    //******* SALIDA DETALLE******//
    Route::get('salidaDetalle/GetAll', 'SalidaDetalleController@GetAll');
    Route::post('salidaDetalle/DeleteById', 'SalidaDetalleController@DeleteById');
    Route::post('salidaDetalle/SaveData', 'SalidaDetalleController@SaveData');
    Route::post('salidaDetalle/GetById', 'SalidaDetalleController@GetById');
    Route::post('salidaDetalle/Update', 'SalidaDetalleController@Update');
    Route::post('salidaDetalle/GetByEmpresaId', 'SalidaDetalleController@GetByEmpresaId');
    /********EXTERNAL CALCULATE****/
    Route::post('salidaDetalle/salidaItemCalculo', 'SalidaDetalleController@salidaItemCalculo');
     
 });
