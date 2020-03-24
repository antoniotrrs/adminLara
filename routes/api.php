<?php

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/historia', 'eventosController@getHistorial');

Route::get('/eventos', 'eventosController@obtenerEventosActivos');
Route::post('/eventos', 'eventosController@store');
Route::get('/deletevent/{id}', 'eventosController@deleteEvent');
Route::post('/subirimagen','eventosController@subirimagen');

Route::get('/sesiones', 'sesionesController@obtenerSesionesActivas');
Route::post('/sesiones', 'sesionesController@nuevaSesion');
Route::get('/deleteSesion/{id}', 'sesionesController@deleteSesion');
Route::post('/updatesesion','sesionesController@updateSesion');

Route::get('/actividades', 'actividadesController@obtenerActividadesActivas');
Route::post('/actividades', 'actividadesController@nuevaActividad');
Route::get('/deleactiv/{id}', 'actividadesController@deletActividad');

Route::get('/biblioteca', 'bibliotecaController@obtenerLibrosActivos');
Route::post('/biblioteca','bibliotecaController@nuevoLibro');
Route::get('/deletBook/{id}', 'bibliotecaController@deletLibro');

Route::post('/createUser', 'userController@create');
Route::post('/editUser','userController@acutalizarUsuario');
Route::post('/usuarios','userController@getUsers');
Route::post('/getuser','userController@showUser');
Route::post('/nuevousuario','userController@create');
Route::post('/inicioSesion','userController@inicioSesion');
Route::post('/actpersonal','userController@actPersonal');
Route::post('/actlaboral','userController@actLaboral');
Route::post('/actualizarcontra','userController@nuevaContrasena');

Route::post('/iniciarlive','sesionController@iniciardetenerlive');
Route::post('/habilitarsesion','sesionController@habilitarbttn');
Route::post('/tomarasistencia','sesionController@tomarasistencia');
