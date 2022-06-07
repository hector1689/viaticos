<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Lugares extends Model{
  protected $table = "t_lugares";
  protected $fillable = [
    "id",
    "remoto",
    "cve_t_viatico",
    "cve_localidad_origen",
    "cve_localidad_destino",
    "dias",
    "cve_zona",
    "kilometros",
    "combustible",
    "hospedaje",
    "desayuno",
    "comida",
    "cena",
    "cve_programa",
    "total_recibido",
    "activo",
  ];


}
