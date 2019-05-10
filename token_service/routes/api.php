<?php

use Illuminate\Http\Request;
Route::get('/', function () {
  return view('welcome');
});
Route::get('/null', function () {
  return view('welcome');
});
Route::get('RedirectToServer', 'InicioController@RedirectToServer');
// Route::post('/', 'AuthController@register');
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {

    Route::get('logout', 'AuthController@logout');
    Route::get('admin',[
		'as'=>'admin.index',
		'uses'=>'AuthController@admin'
    ]);
    //******* USERS ******//
    Route::post('users/GetAll', 'UsersController@GetAll');
    Route::post('users/DeleteById', 'UsersController@DeleteById');
    Route::post('users/GetById', 'UsersController@GetById');

    //******* SISTEMAS ******//
     Route::get('sistemas/GetAll', 'SistemasController@GetAll');
     Route::post('sistemas/DeleteById', 'SistemasController@DeleteById');
     Route::post('sistemas/SaveData', 'SistemasController@SaveData');
     Route::post('sistemas/GetById', 'SistemasController@GetById');
     Route::post('sistemas/Update', 'SistemasController@Update');
     //******* SISTEMAS REGISTRADOS******//
     Route::get('sistemaRegistrado/GetAll', 'SistemaRegistradoController@GetAll');
     Route::post('sistemaRegistrado/DeleteById', 'SistemaRegistradoController@DeleteById');
     Route::post('sistemaRegistrado/SaveData', 'SistemaRegistradoController@SaveData');
     Route::post('sistemaRegistrado/GetById', 'SistemaRegistradoController@GetById');
     Route::post('sistemaRegistrado/Update', 'SistemaRegistradoController@Update');
     /*service for inventario*/
     Route::post('sistemaRegistrado/GetByTokenId', 'SistemaRegistradoController@GetByTokenId');
     //******* EMPRESAS ******//
     Route::post('empresa/GetAll', 'EmpresaController@GetAll');
     Route::post('empresa/DeleteById', 'EmpresaController@DeleteById');
     Route::post('empresa/SaveData', 'EmpresaController@SaveData');
     Route::post('empresa/GetById', 'EmpresaController@GetById');
     Route::post('empresa/Update', 'EmpresaController@Update');
     //******* ROLES ******//
     Route::post('roles/GetAll', 'RolController@GetAll');
     Route::post('roles/DeleteById', 'RolController@DeleteById');
     Route::post('roles/SaveData', 'RolController@SaveData');
     Route::post('roles/GetById', 'RolController@GetById');
     Route::post('roles/Update', 'RolController@Update');
     //******* GRUPOS ******//
     Route::post('grupos/GetAll', 'GrupoController@GetAll');
     Route::post('grupos/GetSelect', 'GrupoController@GetSelect');
     Route::post('grupos/DeleteById', 'GrupoController@DeleteById');
     Route::post('grupos/SaveData', 'GrupoController@SaveData');
     Route::post('grupos/GetById', 'GrupoController@GetById');
     Route::post('grupos/Update', 'GrupoController@Update');
     

});
//Route::get('asdf', 'UsersController@GetAll');
