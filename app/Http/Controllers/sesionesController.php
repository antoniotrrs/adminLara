<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sesionesModel;

use DB;
use App\pushNotification;

class sesionesController extends Controller
{
    //
    public function obtenerSesionesActivas(){
      $yr = date('Y');
      $yrAnt = date('Y')-1;

      $events = DB::select('select * from sesiones where activo = 1 and YEAR(created_at) = "'.$yr.'" order by created_at DESC');
      $sesionAnt = DB::select('select * from sesiones where YEAR(created_at) = "'.$yrAnt.'" order by created_at DESC');

      return response()->json(['estatus' => 1,
                              'mensaje' => '',
                              'sesiones' => $events,
                            'sesionesAnt' => $sesionAnt], 201);
      //return eventosModel::all();
    }

    public function nuevaSesion(Request $request){
      $sesion = sesionesModel::create($request->all());
      $sendpush =  new pushNotification;
      $sendpush->sendNotification($sesion["titulo"],"Se agrego la sesión del mes de ".$sesion["mes"]);
      return redirect()->route('allSesions');
    }

    public function todasSesiones(){
      $sesions = DB::select('select * from sesiones where activo = 1 order by created_at DESC');
      return View('sesiones',compact('sesions'));
    }

    public function deleteSesion($id){
      $event = DB::update('update sesiones set activo = 0 where id = ?',[$id]);
      return redirect()->route('allSesions');
    }

    public function editarSesion($id){
      $result = DB::table('sesiones')->where('id', $id)->get();
      //echo $result;
      return View('editarSesiones', compact('result'));
    }

    public function updateSesion(Request $request){

      $sesion = DB::update('update sesiones set mes = ?, titulo = ?, ponente = ? , video = ? , pdf = ? where id = ?',[$request->mes,$request->titulo,$request->ponente,$request->video, $request->pdf,$request->id]);
      return redirect()->route('allSesions');

    }

}
