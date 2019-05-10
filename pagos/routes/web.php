<?php

use Illuminate\Http\Request;

	Route::get('/', function () {
		return view('welcome');
	  });
	  Route::get('/null', function () {
		return view('welcome');
	  });

	

	Route::get('admin',[
		'as'=>'admin.index',
		'uses'=>'AuthController@admin'
		]);
		Route::get('configuration',[
			'as'=>'configuration.index',
			'uses'=>'ConfigurationController@index'
		]);

	Route::group(['middleware' => ['jwt.auth']], function() {
		Route::get('empresa', 'EmpresaController@index');
		Route::get('home','InicioController@index');	
		
		Route::get('tipoPago', 'TipoPagoController@index');
		Route::get('tipoEmpleado', 'TipoEmpleadoController@index');
		Route::get('empleado', 'EmpleadoController@index');
		Route::get('pago', 'PagoController@index');
		Route::get('listaEmpleado', 'EmpleadoController@listaEmpleado');
		Route::get('listaPago', 'PagoController@listaPago');

		Route::get('item',[
			'as'=>'item.index',
			'uses'=>'ItemController@index'
		]);

	});