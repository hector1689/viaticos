<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Rendimiento extends Model{
  protected $table = "cat_rendimiento";
  protected $fillable = [
    "id",
    "tarifa",
    "kilometros_litros",
    "descripcion",
    "activo",
    "cve_usuario",
  ];


}
