<?php

namespace App\Http\Controllers;

use App\envivoModel;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class envivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\envivoModel  $envivoModel
     * @return \Illuminate\Http\Response
     */
    public function show(envivoModel $envivoModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\envivoModel  $envivoModel
     * @return \Illuminate\Http\Response
     */
    public function edit(envivoModel $envivoModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\envivoModel  $envivoModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, envivoModel $envivoModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\envivoModel  $envivoModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(envivoModel $envivoModel)
    {
        //
    }


    public function abrirAsis(){


      setlocale(LC_ALL, 'es_ES');

      $asis = DB::select('select id,created_at,updated_at from envivo where online = 0 ORDER BY id DESC');
      //dd($asis[0]->created_at);
      $timezone  = -5; //(GMT -5:00) EST (U.S. & Canada)

      $sesArray = [];
      foreach ($asis as $sesion) {

      $fechaini = Carbon::parse($sesion->created_at);
      $fechaini->setTimezone('GMT-5');
      $fechan = $fechaini->formatLocalized('%d %B %Y %H:%M');

      $fechafin = Carbon::parse($sesion->updated_at);
      $fechafin->setTimezone('GMT-5');
      $fechaf = $fechafin->formatLocalized('%d %B %Y %H:%M');


        $sesion = (object) array(
          'id' => $sesion->id,
          'fecha_inicio' => $fechan,
          'fecha_fin' => $fechaf,
        );
        array_push($sesArray,$sesion);
      }

      return View('asistencia',['sesiones'=>$sesArray]);
    }


    public function miembrosasistentes(Request $request){

      $idsesion = $request->idses;
      $asistentes = DB::select('select u.id, u.email, u.nombre, u.apellidoM, u.apellidoP from usuarios u INNER JOIN asistencias a on  u.id = a.idusuario WHERE a.idsesion = ?',[$idsesion]);

      $finalesfinal = "";
      foreach ($asistentes as $usu ) {
        $finalesfinal = $finalesfinal." "."<tr><td>".$usu->id."</td><td>".$usu->nombre." ".$usu->apellidoP." ".$usu->apellidoM."</td><td>".$usu->email."</td></tr>";
      }

      $finaltable = '<tbody id="tableasis">'.$finalesfinal.'</tbody>';

      $response['estatus'] = 1;
      $response['mensaje'] = '';
      $response['tabla'] = $finaltable;

      echo json_encode($response);

    }


}
