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


Route::get('/', 'Auth\LoginController@showLoginForm');

Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('dashboard','DashboardController@index')->name('dashboard');

Route::resource('/herramienta', 'herramientaController');
Route::post('/herramienta/registrar','herramientaController@store');
Route::post('/herramienta/{id_herramienta}','herramientaController@danados');


Route::resource('/cristaleria', 'cristaleriaController');
Route::post('/cristaleria/registrar','cristaleriaController@store');

Route::resource('/usuario', 'UsuariosController');
Route::post('/usuario/registrar','UsuariosController@store');


Route::resource('/cristaleria', 'cristaleriaController');
Route::post('/cristaleria/registrar','cristaleriaController@store');

Route::resource('/danados', 'danadosController');
Route::post('/danados/agregar','danadosController@store');

Route::resource('/mueble', 'muebleController');
Route::post('/mueble/registrar','muebleController@store');

Route::get('/roles/listarRoles','RolesController@listarRoles');

Route::resource('/cubiertos', 'CubiertosController');
Route::post('/cubiertos/registrar','CubiertosController@store');
Route::resource('/limpieza', 'limpiezaController');
Route::post('/limpieza/registrar','limpiezaController@store');

Route::get('/pdfVer', 'danadosController@pdfVer');
Route::get('/pdfDescargar', 'danadosController@pdfDescargar');
