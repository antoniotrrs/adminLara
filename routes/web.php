<?php
session_start();

use Illuminate\Http\Request;
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

//Route::get('/','eventosController@showallEvents');
Route::get('/',function (){
//$_SESSION['token'] = 0;
  if (isset($_SESSION['token'])) {
    return redirect()->route('allevents');
  }else{
    return View('iniciosesion');
  }
});

Route::post('/login',function (Request $request){

if ($request->usuario == "admin" && $request->pass == "Admin2020") {
  $_SESSION['token'] = 1;
  return redirect()->route('allevents');
}else {
  return View('iniciosesion');
}

});

Route::get('/home',['as' => 'home', function (){

  unset($_SESSION['token']);
  return View('iniciosesion');
}]);



Route::get('/allevents', 'eventosController@showallEvents')->name('allevents')->middleware('webuser');

Route::get('/sesiones', 'sesionesController@todasSesiones')->name('allSesions')->middleware('webuser');
Route::get('/actividades', 'actividadesController@todasactividades')->name('allActivi')->middleware('webuser');
Route::get('/biblioteca','bibliotecaController@todosLibros')->name('allBiblio')->middleware('webuser');
Route::get('/editarsesion/{id}','sesionesController@editarSesion')->name('editarSesion')->middleware('webuser');
