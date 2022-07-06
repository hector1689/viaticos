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
    "id_dependencia",
    "activo",
    "cve_usuario",
  ];

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }

}
