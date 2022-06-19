<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Transporte extends Model{
  protected $table = "t_transporte";
  protected $fillable = [
    "id",
    "kilometro_interno",
    "cve_t_viatico",
    "especificar_recorrido",
    "total_km_recorrido",
    "programavehiculo",
    "valeCombustible",
    "total_transporte",
    "activo",
    "cve_usuario",
  ];

  public function obtenePrograma(){
    return $this->hasOne('\Modules\Catalogos\Entities\Programa', 'id', 'programavehiculo');
  }



}
