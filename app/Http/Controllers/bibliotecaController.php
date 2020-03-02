<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\biblioModel;
use DB;
use App\pushNotification;

class bibliotecaController extends Controller
{
  public function obtenerLibrosActivos(){
    $events = DB::select('select * from biblioteca where activo = 1 order by id DESC');

    return response()->json(['estatus' => 1,
                            'mensaje' => '',
                            'libros' => $events],201);
    //return eventosModel::all();
  }

   public function todosLibros()
    {
       $biblio = DB::select('select * from biblioteca where activo = 1');
       return View('biblio',compact('biblio'));
    }

    public function nuevoLibro(Request $request){
      $libro = biblioModel::create($request->all());
      $sendpush =  new pushNotification;
      $sendpush->sendNotification($libro["titulo"],"Se agrego un nuevo libro a la biblioteca");
      return redirect()->route('allBiblio');
    }

    public function deletLibro($id){
      $event = DB::update('update biblioteca set activo = 0 where id = ?',[$id]);
      return redirect()->route('allBiblio');
    }

}
