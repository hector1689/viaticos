<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class TaxiTransporte extends Model{
  protected $table = "t_taxi";
  protected $fillable = [
    "id",
    "cve_t_transporte",
"clasificacion_recorrido",
"name_calsificacion",
"cve_kilometraje_origen",
"name_kilometraje_origen",
"cve_kilometraje_destino",
"name_kilometraje_destino",
"dia_adicional",
"tarifa_evento",
"terifa_evento2",
"tarifa_adicional",
"tarifa_adicional2",

    "activo",
    "cve_usuario",
  ];


}
