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

#############################
// ruta de prueba
Route::get('/prueba', function(){
    $marcas = \App\Marca::all();
    dd($marcas);
});
#####################################
######  CRUD DE MARCAS
//Route::get('/marcas', 'MarcaController@index');

Route::get('/adminMarcas', 'MarcaController@index');

#####################################
######  CRUD DE CATEGORIAS
Route::get('/adminCategorias', 'CategoriaController@index');
Route::get('/agregarCategoria', 'CategoriaController@create');
Route::post('/agregarCategoria', 'CategoriaController@store');

#####################################
######  CRUD DE PRODUCTOS
Route::view('/adminProductos', 'adminProductos');
