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
	Route::get('parametro', 'ParametroController@index');
	Route::get('home','InicioController@index');	
	Route::get('categoria',[
		'as'=>'categoria.index',
		'uses'=>'CategoriaController@index'
	]);

	Route::group(['middleware' => ['jwt.auth']], function() {
		
		Route::get('parametro', 'ParametroController@index');
		Route::get('formula', 'FormulaController@index');
		Route::get('formulaDetalle', 'FormulaDetalleController@index');
		Route::get('proyecto', 'ProyectoController@index');
		Route::get('listaproyecto', 'ProyectoController@lista');
		Route::get('modulo', 'ModuloController@index');
		Route::get('listamodulo', 'ModuloController@lista');
		Route::get('pago', 'PagoController@index');
		Route::get('pagoDetalle', 'PagoDetalleController@index');
		Route::get('home','InicioController@index');	
		Route::get('unidad',[
			'as'=>'unidad.index',
			'uses'=>'UnidadController@index'
		]);
		
	});