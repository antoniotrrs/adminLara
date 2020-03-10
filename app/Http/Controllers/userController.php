<?php

namespace App\Http\Controllers;

use App\userModel;
use Illuminate\Http\Request;
use DB;
use Mail;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

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
       $emailto = $request->email;
       $randomPass = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
       $password = Crypt::encryptString($randomPass);
       $mensaje = "";

       $validate = DB::table('usuarios')->where('email', $emailto)->exists();
       if ($validate) {
         $estatus = 0;
         $mensaje = "El correo ya se encuentra registrado";

       }else{
         $credentials['contrasena'] = $password;
         $event = userModel::create($credentials);
         $estatus = 1;
         $mensaje = "Se registro correctamente";

         Mail::send(['html'=>'emailregistro'], ["email" => $emailto,"contrasena" => $randomPass], function($message) use ($emailto) {
            $message->to($emailto)->subject('Activacion de Cuenta');
            $message->from('comefaenl@gmail.com',"COMEFAENL");
            });
        $mail =Mail::failures();
       }

       $data = array();
       $data['mensaje'] = $mensaje;
       $data['estatus'] = $estatus;
       echo json_encode($data);
       //return response()->json(['mensaje'=>$mensaje,'estatus'=>$estatus],201);
      //return View('nuevousuario',['mensaje'=>$mensaje,'estatus'=>$estatus]);
      //return redirect()->action('userController@addUser', ['mensaje'=>$mensaje,'estatus'=>$estatus]);

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

        return View('usuarios',compact('event'));
        //return response()->json(['usuarios' => $event],201);
    }

    public function addUser(){
      return View('nuevousuario');
    }

  public function inicioSesion(Request $request){

  try{
    //$contra = Crypt::encryptString($request->contrasena);
    $passUser = stripslashes(Crypt::decryptString($request->contrasena));
  } catch (DecryptException $e) {
    dd($e);
  }

    $event = DB::table('usuarios')->where('email',$request->email)->first();
    //dd($event->email);
    if ($event) {
      $contraBD = Crypt::decryptString($event->contrasena);

      if ($passUser == $contraBD) {
        $usuario = $event;
        $event = 1;
        $mensaje = "Usuario encontrado";
      }else{
        $mensaje = "Los accesos son incorrectos";
        $usuario = [];
        $event = 0;
      }
    }else{
      $mensaje = "El usuario no se encuentra registrado";
      $usuario = [];
      $event = 0;
    }

    return response()->json([
      'estatus' => $event,
      'usuario' => $usuario,
      'mensaje' => $mensaje
    ]);
  }

}
