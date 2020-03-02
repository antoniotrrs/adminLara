<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eventosModel extends Model
{
    protected $table = 'eventos';

    protected $fillable = ['titulo','detalle','fecha','img','activo','hora','lugar'];
}
