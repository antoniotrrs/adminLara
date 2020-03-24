<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\eventosModel;
use DB;
use App\pushNotification;


class eventosController extends Controller
{
    //
    public function obtenerEventosActivos(){
      $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");

        $events = DB::select('select activo,created_at,detalle,DATE_FORMAT(fecha,"%d-%m-%Y") as fecha, hora,id,img,lugar,titulo,updated_at from eventos where activo = 1 and fecha >= CURDATE() order by fecha ASC');
        for ($i=0; $i < sizeof($events) ; $i++) {
          $result = explode('-',$events[$i]->fecha);
          $num = $events[$i]->hora;
          if (intVal($num) >= 12) {
            $events[$i]->hora = (intVal($num)-12).' P.M.';
          }else{
            $events[$i]->hora = $num.' A.M.';
          }

          $events[$i]->fecha = $result[0].'-'.$mesesN[intVal($result[1])].'-'.$result[2];
        }

      return response()->json(['estatus' => 1,
                              'mensaje' => '',
                              'eventos' => $events],201);
      //return eventosModel::all();
    }

    public function store(Request $request)
    {

        $attributes = $request->all();

        if ($request->hasFile('img')) {
          $photoName = time().'.'.$request->img->getClientOriginalExtension();
          $completPath = 'images/'.$photoName;
          $request->img->move(public_path('images'), $photoName);

          $attributes['img'] = $completPath;
          }

        $attributes['fecha']= date('Y-m-d', strtotime($request->fecha));
        $event = eventosModel::create($attributes);

        $sendpush =  new pushNotification;
        $sendpush->sendNotification($event["titulo"],"Se agrego un nuevo evento");
        return redirect()->route('allevents');
        //return response()->json(['estatus' => 1,
                                //'mensaje' => 'Se creo con exito.'],201);
    }

    public function subirimagen(Request $request){
      
    }


public function showhome(){
  return View('iniciosesion');

}

    public function showallEvents(){


      $events = DB::select('select * from eventos where activo = 1');
      return View('welcome',['events'=>$events]);
    }


    public function deleteEvent($id){
      $event = DB::update('update eventos set activo = 0 where id = ?',[$id]);
      return redirect()->route('allevents');
    }

    public function getHistorial(){

      $mesesN=array(1=>"Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio",
             "Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      $mt = $mesesN[date('n')];
      $yr = date('Y');


      $events = DB::select('select activo,created_at,detalle,DATE_FORMAT(fecha,"%d-%m-%Y") as fecha, hora,id,img,lugar,titulo,updated_at from eventos where activo = 1 and fecha >= CURDATE() order by fecha ASC , hora ASC limit 1');
      for ($i=0; $i < sizeof($events) ; $i++) {
        $result = explode('-',$events[$i]->fecha);
        $num = $events[$i]->hora;
        if (intVal($num) >= 12) {
          $events[$i]->hora = (intVal($num)-12).' P.M.';
        }else{
          $events[$i]->hora = $num.' A.M.';
        }

        $events[$i]->fecha = $result[0].' - '.$mesesN[intVal($result[1])].' - '.$result[2];
      }
      $activ  = DB::select('select activo,created_at,detalle,DATE_FORMAT(fechalimite,"%d-%m-%Y") as fechalimite,hora,id,imagen,link,titulo from actividades where activo = 1 and fechalimite >= CURDATE() order by fechalimite ASC , hora ASC limit 1');
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
      $sesion = DB::select('select * from sesiones where activo = 1 and YEAR(created_at) = "'.$yr.'" and mes = "'.$mt.'"');

      return response()->json(['estatus' => 1,
                              'mensaje' => '',
                              'eventos' => sizeof($events)>0 ? $events[0] : null,
                            'actividades' => sizeof($activ)>0 ? $activ[0] : null,
                              'sesiones' => sizeof($sesion)>0 ? $sesion[0] : null],201);
    }

}
