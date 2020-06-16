<?php

namespace App\Http\Controllers;

use App\userModel;
use Illuminate\Http\Request;
use DB;
use Mail;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

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
    public function showUser($id)
    {

      $event = DB::table('usuarios')->where('id',$id)->first();
      return View('verusuario',['usuario'=>$event]);
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
    public function update(Request $request)
    {


    }

    public function acutalizarUsuario(Request $request){

      if(isset($request->contrasenaN)){

        $nuevacontra = Crypt::encryptString($request->contrasenaN);
        $evet = DB::update('update usuarios set contrasena = ?, nuevo = 0 where id = ?',[$nuevacontra, $request->idu]);

      }

      $event = DB::update('update usuarios set nombre = ?, apellidoP = ?, apellidoM = ?, telefono = ?, grado = ?, certificacion = ?, cedulaGeneral
       = ?, cedulaFamiliar = ?, trabajo = ?, trabajoPrivado = ?, infoPrivado = ?, curp = ?, celular = ?, rol = ? where id = ?',[$request->nombre,$request->apellidoP,$request->apellidoM,$request->telefono,$request->grado,$request->certificacion,$request->cedulaGeneral,$request->cedulaFamiliar,$request->trabajo,$request->trabajoPrivado,$request->infoPrivado,$request->curp,$request->celular,$request->rol,$request->idu]);

      //$event = DB::table('usuarios')->where('id', $request->idu)->update($request->all());

        $estatus = 1;
        $mensaje = "Se actualizo la información correctamente";


      //return response()->json(['estatus' => $event,'mensaje' => $mensaje],201);
      echo json_encode(['estatus' => $estatus,'mensaje' => $mensaje]);
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

    if ($request->sistema == 'iOS') {
      $passUser = stripslashes(Crypt::decrypt($request->contrasena));
    }else{
      $passUser = stripslashes(Crypt::decryptString($request->contrasena));
    }

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

public function actPersonal (Request $request){

  $completPath = null;
  if ($request->imagen != "") {
        $image = $request->imagen;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $photoName = time().'.'.'jpg';
    $completPath = 'images/'.$photoName;
    //$request->img->move(public_path('images'), $photoName);
    File::put(public_path('images'). '/' . $photoName, base64_decode($image));

    }

  try {
      $userPersonal = DB::update('update usuarios set nombre = ?, apellidoP = ?, apellidoM = ?, curp = ?, telefono = ?, celular = ?, grado = ?, certificacion = ?, imagen = ? where id = ? ',[$request->nombre, $request->apellidoP, $request->apellidoM, $request->curp, $request->telefono, $request->celular, $request->grado, $request->certificacion, $completPath , $request->idu]);
      $estatus = 1;
      $mensaje = "Se actualizo la información correctamente";
      $usuario = DB::table('usuarios')->where('id',$request->idu)->first();
  } catch ( Illuminate\Database\QueryException $e) {
      var_dump($e->errorInfo);
      $estatus = 0;
      $mensaje = "No se pudo actualizar la información";
      $usuario = [];
  }

  return response()->json(['estatus' => $estatus,'mensaje' => $mensaje, 'usuario' => $usuario],201);

}

public function actLaboral (Request $request) {
  try {
      $userPersonal = DB::update('update usuarios set cedulaGeneral = ?, cedulaFamiliar = ?, trabajo = ?, privada = ?, trabajoPrivado = ?, infoPrivado = ?, promocion = ? where id = ? ',[$request->cedulaGeneral, $request->cedulaFamiliar, $request->trabajo, $request->privada, $request->trabajoPrivado, $request->infoPrivado, $request->promocion, $request->idu]);
      $estatus = 1;
      $mensaje = "Se actualizo la información correctamente";
      $usuario = DB::table('usuarios')->where('id',$request->idu)->first();
  } catch ( Illuminate\Database\QueryException $e) {
      var_dump($e->errorInfo);
      $estatus = 0;
      $mensaje = "No se pudo actualizar la información";
      $usuario = [];
  }
  return response()->json(['estatus' => $estatus,'mensaje' => $mensaje, 'usuario' => $usuario],201);
}

public function nuevaContrasena(Request $request){
try {
      $nuevacontra = Crypt::encryptString($request->contrasena);
      $evet = DB::update('update usuarios set contrasena = ?, nuevo = 0 where id = ?',[$nuevacontra, $request->idu]);
      $estatus = 1;
      $mensaje = "Se actualizo la contraseña correctamente";
    } catch ( Illuminate\Database\QueryException $e) {
      var_dump($e->errorInfo);
      $estatus = 0;
      $mensaje = "No se pudo actualizar la contraseña";

    }
    return response()->json(['estatus' => $estatus,'mensaje' => $mensaje],201);
}

}
