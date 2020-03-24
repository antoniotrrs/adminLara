<?php

namespace App\Http\Controllers;

use App\sesionvivo;
use Illuminate\Http\Request;
use DB;
use App\sesionModel;

class sesionController extends Controller
{

  public function view(){
    $event = DB::table('envivo')->where('online',1)->first();
    return View('vivo',['live' => $event]);
  }

  public function iniciardetenerlive (Request $request){
    $flight = sesionModel::updateOrCreate(['id' => $request->idu],['online' => $request->online]);

  }

  public function habilitarbttn(Request $request){
    $event = DB::table('envivo')->where('online',1)->first();
    if ($event) {
      $estatus = 1;
      $mensaje = "Existe una sesión en vivo.";
    }else{
      $estatus = 0;
      $mensaje = "No hay sesiones en vivo.";
    }

    return response()->json(['estatus' => $estatus,'mensaje' => $mensaje],201);
  }


  public function tomarasistencia(Request $request){
    $sesion = DB::table('envivo')->where('online',1)->first();

    $exist = DB::table('asistencias')->where(['idsesion' => $sesion->id, 'idusuario' => $request->idu])->first();

if ($exist) {
  $estatus = 1;
  $mensaje = "Su asistencia ya ha sido registrada en esta sesión";
}else{
  $asisten = DB::table('asistencias')->insertGetId(['idsesion' => $sesion->id, 'idusuario' => $request->idu,'created_at' => date('Y-m-d H:i:s') , 'updated_at' => date('Y-m-d H:i:s')]);

    if ($asisten) {
      $estatus = 1;
      $mensaje = "Su asistencia se marcó correctamente.";
    }else{
      $estatus = 0;
      $mensaje = "No fue posible marcar su asistencia a esta sesión";
    }
}

    return response()->json(['estatus' => $estatus,'mensaje' => $mensaje],201);


  }


}
