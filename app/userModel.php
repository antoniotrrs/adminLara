<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    //
    protected $table = 'usuarios';
    protected $fillable = ['id','email','contrasena','nombre','apellidoP','apellidoM','telefono','certificacion','cedulaGeneral','cedulaFamiliar','trabajo','constancia','privada','promocion','trabajoPrivado','infoPrivado','nuevo','curp','celular','imagen','grado','rol','firetoken'];

}
