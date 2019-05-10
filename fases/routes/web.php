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
		Route::get('categoria',[
			'as'=>'categoria.index',
			'uses'=>'CategoriaController@index'
		]);
		Route::get('unidad',[
			'as'=>'unidad.index',
			'uses'=>'UnidadController@index'
		]);
	
		Route::get('proveedor',[
			'as'=>'proveedor.index',
			'uses'=>'ProveedorController@index'
		]);

		Route::get('compra',[
			'as'=>'compra.index',
			'uses'=>'CompraController@index'
		]);
		Route::get('salida',[
			'as'=>'salida.index',
			'uses'=>'SalidaController@index'
		]);
		Route::get('salidaLista', 'SalidaDetalleController@listaSalida');

		Route::get('item',[
			'as'=>'item.index',
			'uses'=>'ItemController@index'
		]);

	});