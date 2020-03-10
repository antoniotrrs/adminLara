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

  $event = DB::table('usuarios')->where([['email',$request->usuario],['rol',1]])->first();
  //dd($event->email);
  if ($event) {
    $contraBD = Crypt::decryptString($event->contrasena);

    if ($request->pass == $contraBD) {
      $_SESSION['token'] = Crypt::encryptString($event->id);
      $_SESSION['name'] = $event->nombre." ".$event->apellidos;

      $event = 1;
      $mensaje = "Usuario encontrado";
    }else{
      $mensaje = "Los accesos son incorrectos";
      $event = 0;
    }
  }else{
    $mensaje = "El usuario no es Administrador.";
    $event = 0;
  }

  echo json_encode([
    'estatus' => $event,
    'mensaje' => $mensaje
  ]);

//OLXS8AMV

});

Route::get('/home',['as' => 'home', function (){

  unset($_SESSION['token']);
  return View('iniciosesion');
}]);



Route::get('/allevents', 'eventosController@showallEvents')->name('allevents')->middleware('webuser');

Route::get('/sesiones', 'sesionesController@todasSesiones')->name('allSesions')->middleware('webuser');
Route::get('/actividades', 'actividadesController@todasactividades')->name('allActivi')->middleware('webuser');
Route::get('/biblioteca','bibliotecaController@todosLibros')->name('allBiblio')->middleware('webuser');
Route::get('usuarios','userController@getUsers')->name('allUsers')->middleware('webuser');
Route::get('/editarsesion/{id}','sesionesController@editarSesion')->name('editarSesion')->middleware('webuser');
Route::get('/usuarionuevo','userController@addUser')->name('usuarionuevo')->middleware('webuser');
