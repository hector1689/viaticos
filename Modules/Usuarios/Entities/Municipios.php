<?php

namespace Modules\Usuarios\Entities;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model{
  protected $table = "cat_municipios";
  protected $primaryKey = "id";
  protected $fillable = [
    "c_municipio",
    "c_estado",
    "nombre",
    "c_mpio"
  ];


}
