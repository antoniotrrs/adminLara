<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userModel extends Model
{
    //
    protected $table = 'usuarios';
    protected $fillable = ['id','email','contrasena','nombre','apellidos','curp','celular','gradoac','rol'];
}
