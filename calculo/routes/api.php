<?php

use Illuminate\Http\Request;
Route::get('/', function () {
  return view('welcome');
});
Route::get('/null', function () {
  return view('welcome');
});
Route::get('RedirectToServer', 'InicioController@RedirectToServer');

//Route::get('test','AlmacenController@test');
Route::group(['middleware' => ['jwt.auth']], function() {
//Route::get('almacen', 'AlmacenController@test');
Route::post('setMenu', 'InicioController@setMenu');
Route::post('avanzeProyecto', 'InicioController@avanzeProyecto');
    //******* Parametro******//
    Route::post('parametro/GetAll', 'ParametroController@GetAll');
    Route::post('parametro/DeleteById', 'ParametroController@DeleteById');
    Route::post('parametro/SaveData', 'ParametroController@SaveData');
    Route::post('parametro/GetById', 'ParametroController@GetById');
    Route::post('parametro/Update', 'ParametroController@Update');
    Route::post('parametro/GetByEmpresaId', 'ParametroController@GetByEmpresaId');
    //******* Parametro******//
    Route::post('formula/GetAll', 'FormulaController@GetAll');
    Route::post('formula/DeleteById', 'FormulaController@DeleteById');
    Route::post('formula/SaveData', 'FormulaController@SaveData');
    Route::post('formula/GetById', 'FormulaController@GetById');
    Route::post('formula/Update', 'FormulaController@Update');
    Route::post('formula/GetByEmpresaId', 'FormulaController@GetByEmpresaId');
    //******* Formula******//
    Route::post('formulaDetalle/GetAll', 'FormulaDetalleController@GetAll');
    Route::post('formulaDetalle/DeleteById', 'FormulaDetalleController@DeleteById');
    Route::post('formulaDetalle/SaveData', 'FormulaDetalleController@SaveData');
    Route::post('formulaDetalle/GetById', 'FormulaDetalleController@GetById');
    Route::post('formulaDetalle/Update', 'FormulaDetalleController@Update');
    Route::post('formulaDetalle/GetByEmpresaId', 'FormulaDetalleController@GetByEmpresaId');
     //******* PROYECTO******//
    Route::post('proyecto/GetAll', 'ProyectoController@GetAll');
    Route::post('proyecto/DeleteById', 'ProyectoController@DeleteById');
    Route::post('proyecto/SaveData', 'ProyectoController@SaveData');
    Route::post('proyecto/GetById', 'ProyectoController@GetById');
    Route::post('proyecto/GetByIdDate', 'ProyectoController@GetByIdDate');
    Route::post('proyecto/Update', 'ProyectoController@Update');
    Route::post('proyecto/GetByEmpresaId', 'ProyectoController@GetByEmpresaId');
    Route::post('proyecto/CreaProyectoModulo', 'ProyectoController@CreaProyectoModulo');
      //******* MODULO******//
    Route::post('modulo/GetAll', 'ModuloController@GetAll');
    Route::post('modulo/GetAllGroup', 'ModuloController@GetAllGroup');
    Route::post('modulo/GetForFase', 'ModuloController@GetForFases');
    Route::post('modulo/GetFaseById', 'ModuloController@GetFaseById');
    Route::post('modulo/UpdateDataById', 'ModuloController@UpdateDataById');

    Route::post('modulo/DeleteById', 'ModuloController@DeleteById');
    Route::post('modulo/SaveData', 'ModuloController@SaveData');
    Route::post('modulo/GetById', 'ModuloController@GetById');
    Route::post('modulo/Update', 'ModuloController@Update');
    Route::post('modulo/GetByEmpresaId', 'ModuloController@GetByEmpresaId');
    //******* MODULO DETALLE******//
    Route::post('moduloDetalle/GetAll', 'ModuloDetalleController@GetAll');
    Route::post('moduloDetalle/DeleteById', 'ModuloDetalleController@DeleteById');
    Route::post('moduloDetalle/SaveData', 'ModuloDetalleController@SaveData');
    Route::post('moduloDetalle/GetById', 'ModuloDetalleController@GetById');
    Route::post('moduloDetalle/Update', 'ModuloDetalleController@Update');
    Route::post('moduloDetalle/GetByEmpresaId', 'ModuloDetalleController@GetByEmpresaId');
     //******* PAGO******//
    Route::post('pago/GetAll', 'PagoController@GetAll');
    Route::post('pago/DeleteById', 'PagoController@DeleteById');
    Route::post('pago/SaveData', 'PagoController@SaveData');
    Route::post('pago/GetById', 'PagoController@GetById');
    Route::post('pago/Update', 'PagoController@Update');
    Route::post('pago/GetByEmpresaId', 'PagoController@GetByEmpresaId');
      //******* PAGO DETALLE******//
    Route::post('pagoDetalle/GetAll', 'PagoDetalleController@GetAll');
    Route::post('pagoDetalle/DeleteById', 'PagoDetalleController@DeleteById');
    Route::post('pagoDetalle/SaveData', 'PagoDetalleController@SaveData');
    Route::post('pagoDetalle/GetById', 'PagoDetalleController@GetById');
    Route::post('pagoDetalle/Update', 'PagoDetalleController@Update');
    Route::post('pagoDetalle/GetByEmpresaId', 'PagoDetalleController@GetByEmpresaId');
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
 });
