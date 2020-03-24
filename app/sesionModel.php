<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sesionModel extends Model
{
  
    protected $table = "envivo";
    protected $fillable = ['id', 'nombre', 'online', 'created_at', 'updated_at'];
}
