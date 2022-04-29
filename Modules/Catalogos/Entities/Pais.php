<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model{
  protected $table = "cat_paises";
  protected $fillable = [
    "id",
    "clave",
    "nombre",
    "corto",
    "phonecode",
    "activo",
  ];


}
