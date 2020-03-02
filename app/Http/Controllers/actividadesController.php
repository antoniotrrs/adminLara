<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\actividadesModel;
use DB;
use App\pushNotification;

class actividadesController extends Controller
{

  public function obtenerActividadesActivas(){

    $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
           "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $activ = DB::select('select activo,created_at,detalle,DATE_FORMAT(fechalimite,"%d-%m-%Y") as fechalimite,hora,id,imagen,link,titulo from actividades where activo = 1');
    for ($i=0; $i < sizeof($activ) ; $i++) {
      $result = explode('-',$activ[$i]->fechalimite);
      $num = $activ[$i]->hora;
      if (intVal($num) >= 12) {
        $activ[$i]->hora = (intVal($num)-12).' P.M.';
      }else{
        $activ[$i]->hora = $num.' A.M.';
      }
      $activ[$i]->fechalimite = $result[0].' - '.$mesesN[intVal($result[1])].' - '.$result[2];
    }

    return response()->json(['estatus' => 1,
                            'mensaje' => '',
                            'actividades' => $activ],201);
    //return eventosModel::all();
  }

  public function todasactividades()
  {
    $activ = DB::select('select * from actividades where activo = 1');
    return View('actividades',compact('activ'));
  }

  public function nuevaActividad(Request $request){

    $attributes = $request->all();

    if ($request->hasFile('imagen')) {
      $photoName = time().'.'.$request->imagen->getClientOriginalExtension();
      $completPath = 'images/'.$photoName;
      $request->imagen->move(public_path('images'), $photoName);

      $attributes['imagen'] = $completPath;
      }

      $attributes['fechalimite']= date('Y-m-d', strtotime($request->fechalimite));
    $actividad = actividadesModel::create($attributes);
    $sendpush =  new pushNotification;
    $sendpush->sendNotification($actividad["titulo"],"Se agrego una nueva actividad");
    return redirect()->route('allActivi');
  }

  public function deletActividad($id){
    $event = DB::update('update actividades set activo = 0 where id = ?',[$id]);
    return redirect()->route('allActivi');
  }




}
