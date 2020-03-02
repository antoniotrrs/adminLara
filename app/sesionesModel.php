<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sesionesModel extends Model
{
    protected $table = 'sesiones';
    protected $fillable = ['mes','titulo','ponente','video','pdf','activo'];
}
