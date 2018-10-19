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


Route::get('usuario/cargararticulo/','artController@ver');


//peticiones para acceptar get o post
//Route::match(["get","post"],'usuario/cargar_articulo','artController@form');


Route::get('usuario/cargar_articulo','artController@ver');
Route::post('usuario/cargar_articulo','artController@form');



Route::get('/uploadfile', 'artController@index');
Route::post('/uploadfile', 'artController@upload');

