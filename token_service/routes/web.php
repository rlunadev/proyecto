<?php

use Illuminate\Http\Request;

Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');

Route::get('/', function () {
	return view('welcome');
});
Route::get('registro',[
	'as'=>'registro.index',
	'uses'=>'AuthController@registro'
	]);
Route::get('admin',[
	'as'=>'admin.index',
	'uses'=>'AuthController@admin'
	]);

Route::group(['middleware' => ['jwt.auth']], function() {
	Route::get('logout', 'AuthController@logout');
	
   
	//users
	Route::resource('users','UsersController');
	// Route::get('users/{id}/destroy',[
	// 	'uses'=>'UsersController@destroy',
	// 	'as'=>'users.destroy'
	// ]);
	//Sistemas
	Route::get('sistema', 'SistemasController@index');
	//Empresas
	Route::get('empresa', 'EmpresaController@index');
	//Sistemas Registrados
	Route::get('sistemaRegistrado', 'SistemaRegistradoController@index');
	Route::get('roles', 'RolController@index');
	Route::get('grupos', 'GrupoController@index');

});


Route::get('login',[
	'as'=>'login.index',
	'uses'=>'AuthController@index'
	]);