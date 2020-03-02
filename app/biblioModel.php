<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class biblioModel extends Model
{
    protected $table = 'biblioteca';
    protected $fillable = ['titulo','autor','link','detalle'];
}
