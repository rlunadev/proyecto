<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/RedirectToServer', 'InicioController@RedirectToServer');
Route::get('/api/almacen', 'AlmacenController@test');
//Almacen





// Route::post('register', 'AuthController@register');
// Route::post('login', 'AuthController@login');
// Route::post('recover', 'AuthController@recover');
// Route::group(['middleware' => ['jwt.auth']], function() {
//     Route::get('logout', 'AuthController@logout');
//     //Route::get('test', function(){
//       //  return response()->json(['foo'=>'bar']);
//     //});
//     Route::get('admin',[
// 		'as'=>'admin.index',
// 		'uses'=>'AuthController@admin'
//     ]);
//     //******* USERS ******//
//     Route::get('users/GetAll', 'UsersController@GetAll');
//     Route::post('users/DeleteById', 'UsersController@DeleteById');

//     //******* SISTEMAS ******//
//     Route::get('sistemas/GetAll', 'SistemasController@GetAll');
//     Route::post('sistemas/DeleteById', 'SistemasController@DeleteById');
//     Route::post('sistemas/SaveData', 'SistemasController@SaveData');
//     Route::post('sistemas/GetById', 'SistemasController@GetById');
//     Route::post('sistemas/Update', 'SistemasController@Update');
// });











/*
se pueden tener rutas GET PUT POST DELETE 
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/api/RedirectToServer', 'InicioController@RedirectToServer');
// Route::get('api/almacen', 'AlmacenController@test');

// Route::get('categories/{name}',[
// 	'uses'=>'FrontController@searchCategory',
// 	'as'=>'front.search.category'
// 	]);

// Route::get('tags/{name}',[
// 	'uses'=>'FrontController@searchTag',
// 	'as'=>'front.search.tag'
// 	]);

// Route::get('articles/{slug}',[
// 	'uses'=>'FrontController@viewArticle',
// 	'as'=>'front.view.article'
// 	]);
// //rutas frontend
// Route::get('PDF',[
// 	'uses'=>'PdfController@index',
// 	'as'=>'pdf.invoice'
// 	]);
// Route::get('excel',[
// 	'uses'=>'ExcelController@index',
// 	'as'=>'excel.index'
// 	]);


// Route::group(['prefix'=>'rest'],function () {
// 	Route::get('',['uses'=>'restController@index']);
// 	Route::get('/{id}',['uses'=>'restController@getById']);
// 	Route::post('',['uses'=>'restController@store']);
// 	Route::put('{id}',['uses'=>'restController@update']);
// 	Route::delete('{id}','restController@destroy');
// });

//Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
//Route::group(['prefix'=>'api','middleware'=>'auth'], function () {

	// Route::get('/',['as'=>'admin.index',function () {
	// 	return view('admin.index');
	// }]);

	// Route::group(['middleware'=>'admin'],function() {
	// 	Route::resource('users','UsersController');
	// 	Route::get('users/{id}/destroy',[
	// 		'uses'=>'UsersController@destroy',
	// 		'as'=>'admin.users.destroy'
	// 		]);
	// });

	// Route::resource('categories','CategoriesController');
	// Route::get('categories/{id}/destroy',[
	// 	'uses'=>'CategoriesController@destroy',
	// 	'as'=>'admin.categories.destroy'
	// 	]);

	// Route::resource('tags','TagsController');
	// Route::get('tags/{id}/destroy',[
	// 	'uses'=>'TagsController@destroy',
	// 	'as'=>'admin.tags.destroy'
	// 	]);
	// INVENTARIO


	//Almacen
	// Route::resource('almacen','AlmacenController');
	// Route::get('almacen/{id}/destroy',[
	//     'uses'=>'AlmacenController@destroy',
	//     'as'=>'admin.almacen.destroy'
	//     ]);
	//categoria
//     Route::resource('categoria','CategoriaController');
// 	Route::get('categoria/{id}/destroy',[
// 	    'uses'=>'CategoriaController@destroy',
// 	    'as'=>'admin.categoria.destroy'
// 	    ]);
// 	//detalle stock
// 	Route::resource('detallestock','DetalleStockController');
// 	Route::get('detallestock/{id}/destroy',[
// 	    'uses'=>'DetalleStockController@destroy',
// 	    'as'=>'admin.detallestock.destroy'
// 	    ]);
// 	// empresa
// 	Route::resource('empresa','EmpresaController');
// 	Route::get('empresa/{id}/destroy',[
// 	    'uses'=>'EmpresaController@destroy',
// 	    'as'=>'admin.empresa.destroy'
// 	    ]);
// 	// item
// 	Route::resource('item','ItemController');
// 	Route::get('item/{id}/destroy',[
// 	    'uses'=>'ItemController@destroy',
// 	    'as'=>'admin.item.destroy'
// 	    ]);
// 	//periodo
// 	Route::resource('periodo','PeriodoController');
// 	Route::get('periodo/{id}/destroy',[
// 	    'uses'=>'PeriodoController@destroy',
// 	    'as'=>'admin.periodo.destroy'
// 	    ]);
// 	//stock
// 	Route::resource('stock','StockController');
// 	Route::get('stock/{id}/destroy',[
// 	    'uses'=>'StockController@destroy',
// 	    'as'=>'admin.stock.destroy'
// 	    ]);
// 	//unidad
// 	Route::resource('unidad','UnidadController');
// 	Route::get('unidad/{id}/destroy',[
// 	    'uses'=>'UnidadController@destroy',
// 	    'as'=>'admin.unidad.destroy'
// 		]);
// 	//Proveedor
// 	Route::resource('proveedor','ProveedorController');
// 	Route::get('proveedor/{id}/destroy',[
// 	    'uses'=>'ProveedorController@destroy',
// 	    'as'=>'admin.proveedor.destroy'
// 		]);
// 	//Producto
// 	Route::resource('producto','ProductoController');
// 	Route::get('producto/{id}/destroy',[
// 	    'uses'=>'ProductoController@destroy',
// 	    'as'=>'admin.producto.destroy'
// 	    ]);
// 	//imagenes
// 	Route::resource('images','ImagesController');
// 	Route::resource('articles','ArticlesController');
// 	Route::get('articles/{id}/destroy',[
// 		'uses'=>'ArticlesController@destroy',
// 		'as'=>'admin.articles.destroy'
// 		]);
// //CICLOS
// 	Route::resource('ciclos','CiclosController');
// 	Route::get('ciclos/{id}/destroy',[
// 		'uses'=>'CiclosController@destroy',
// 		'as'=>'admin.ciclos.destroy'
// 		]);
// //DOCENTE
// 	Route::resource('docente','DocenteController');
// 	Route::get('docente/{id}/destroy',[
// 		'uses'=>'DocenteController@destroy',
// 		'as'=>'admin.docente.destroy'
// 		]);
// //ESTADO FINANCIERO
// 	Route::resource('estadofinanciero','EstadoFinancieroController');
// 	Route::get('estadofinanciero/{id}/destroy',[
// 		'uses'=>'EstadoFinancieroController@destroy',
// 		'as'=>'admin.estadofinanciero.destroy'
// 		]);
// //CURSO
// 	Route::resource('cursos','CursosController');
// 	Route::get('cursos/{id}/destroy',[
// 		'uses'=>'CursosController@destroy',
// 		'as'=>'admin.cursos.destroy'
// 		]);
// //CURSO
// 	Route::resource('calificacion','CalificacionController');
// 	Route::get('calificacion/{id}/destroy',[
// 		'uses'=>'CalificacionController@destroy',
// 		'as'=>'admin.calificacion.destroy'
// 		]);
// 	Route::get('calificacion/{id}/pdf_id',[
// 		'uses'=>'CalificacionController@pdf_id',
// 		'as'=>'admin.calificacion.pdf_id',
// 		]);
// 	Route::get('calificacion/{id}/pdf_all',[
// 		'uses'=>'CalificacionController@pdf_all',
// 		'as'=>'admin.calificacion.pdf_all',
// 		]);
// //ALUMNO
// 	Route::resource('alumno','AlumnoController');
// 	Route::get('alumno/{id}/destroy',[
// 		'uses'=>'AlumnoController@destroy',
// 		'as'=>'admin.alumno.destroy',
// 		]);
// 	Route::get('alumno/{id}/pdf_id',[
// 		'uses'=>'AlumnoController@pdf_id',
// 		'as'=>'admin.alumno.pdf_id',
// 		]);
// 	Route::get('alumno/{id}/pdf_all',[
// 		'uses'=>'AlumnoController@pdf_all',
// 		'as'=>'admin.alumno.pdf_all',
// 		]);
// 	// Route::get('alumno/pdf_all',[
// 	// 	'uses'=>'AlumnoController@pdf_all',
// 	// 	'as'=>'admin.alumno.pdf_all',
// 	// 	]);
// //ASISTENCIA
// 	Route::resource('asistencia','AsistenciaController');
// 	Route::get('asistencia/{id}/destroy',[
// 		'uses'=>'AsistenciaController@destroy',
// 		'as'=>'admin.asistencia.destroy'
// 		]);
// //RESPONSABLE
// 	Route::resource('responsable','ResponsableController');
// 	Route::get('responsable/{id}/destroy',[
// 		'uses'=>'ResponsableController@destroy',
// 		'as'=>'admin.responsable.destroy'
// 		]);
// //NOTAS
// 	Route::resource('nota','notasController');
// 	Route::get('nota/{id}/destroy',[
// 		'uses'=>'notasController@destroy',
// 		'as'=>'admin.notas.destroy'
// 		]);
// 	//Route::get('users')
// 	//API /admin/api/articles
// 	Route::group(['prefix'=>'api'], function() {
// 		Route::group(['prefix'=>'articles'], function() {
// 			Route::get('',function(){
// 				return 'devuelve usuario';
// 			});			
// 			Route::get('{id}',function($id){
// 				return 'Usuario '.$id;
// 			});			
// 			Route::post('',function(){
// 				return 'guarda '.$id;
// 			});			
// 			Route::put('{id}',function($id){
// 				return 'Edita '.$id;
// 			});			
// 			Route::delete('{id}',function($id){
// 				return 'Borra '.$id;
// 			});
// 		});	
// 	});
// });
// Route::get('admin/auth/login', [
// 	'uses'=>'Auth\AuthController@getLogin',
// 	'as'=>'admin.auth.login'
// 	]);
// Route::post('admin/auth/login',[
// 	'uses'=>'Auth\AuthController@postLogin',
// 	'as'=>'admin.auth.login'
// 	]);
// Route::get('admin/auth/logout',[
// 	'uses'=>'Auth\AuthController@getLogout',
// 	'as'=>'admin.auth.logout'
// 	]);
/**Route::group(['prefix'=>'admin'], function() {
	Route::resource('user','UsersController');
});*/
//nos creamos una ruta /parametro
/**Route::get('articles/{nombre?}',function ($nombre="sin nombre") {
	echo "nombre es".$nombre;
});*/
/**Route::group(['prefix'=>'articles'], function () {

	Route::get('view/{id}',[
		'uses'=>'TestController@view',
		'as'=>'articlesView'
		]);

});*/