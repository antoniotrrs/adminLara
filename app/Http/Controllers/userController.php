<?php

namespace App\Http\Controllers;

use App\userModel;
use Illuminate\Http\Request;
use DB;
class userController extends Controller
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
    public function create(Request $request)
    {
       $credentials = $request->all();
       $password = encrypt($request->contrasena);

       $validate = DB::table('usuarios')->where('email', $request->email)->exists();
       if ($validate) {
         $estatus = 0;
         $mensaje = "El correo ya se encuentra registrado";
       }else{
         $credentials['contrasena'] = $password;
         $event = userModel::create($credentials);
         $estatus = 1;
         $mensaje = "Se registro correctamente";
       }

      return response()->json(['estatus' => $estatus,
                               'mensaje' => $mensaje],201);

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
     * @param  \App\userModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function showUser(Request $request)
    {

      $event = DB::select('select * from usuarios where id = ?',[$request->id]);

      return response()->json([
        'usuario' => $event
      ],201);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\userModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function edit(userModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\userModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, userModel $userModel)
    {
        $event = DB::update('update usuarios set nombre = ?, apellidos = ?, curp = ?, celular = ?, gradoac = ? where id = ?',[$request->nombre,$request->apellidos,$request->curp,$request->celular,$request->gradoac,$request->id]);
        if ($event) {
          $mensaje = "Se actualizo la información correctamente";
        }else{
          $mensaje = "No se pudo actualizar la información";
        }

        return response()->json(['estatus' => $event,
                                 'mensaje' => $mensaje],201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userModel  $userModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(userModel $userModel)
    {
        //
    }

    public function getUsers(Request $request){
      if ($request->rol == 0) {
        $event = DB::table('usuarios')->get();
      }else{
          $event = DB::select('select * from usuarios where rol = ?',[$request->rol]);
      }

      return response()->json(['usuarios' => $event],201);
    }

}
