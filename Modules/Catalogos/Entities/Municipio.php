<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model{
  protected $table = "cat_municipios";
  protected $fillable = [
    "id",
    "id_estado",
    "nombre",
    "corto",
    "distrito_local",
    "distrito_federal",
    "coordenadas",
    "activo",
  ];


}
