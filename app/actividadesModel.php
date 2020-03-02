<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actividadesModel extends Model
{
  protected $table = 'actividades';

  protected $fillable = ['titulo','detalle','link','fechalimite','hora','imagen','var2','activo'];
}
