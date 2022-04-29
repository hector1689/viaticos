<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Taxi extends Model{
  protected $table = "cat_taxi";
  protected $fillable = [
    "id",
    "descripcion",
    "tarifa_evento",
    "tarifa_adicional",
    "vigencia_inicial",
    "vigencia_final",
    "activo",
    "cve_usuario",
  ];


}
