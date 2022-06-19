<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class TaxiTransporte extends Model{
  protected $table = "t_taxi";
  protected $fillable = [
    "id",
    "cve_t_transporte",
    "clasificacion_recorrido",
    "cve_kilometraje_origen",
    "cve_kilometraje_destino",

    "tipotransporte",
    "region",
    "region_name",
    "dia_adicional",
    "recorrido1",
    "recorrido2",
    "name_recorrido",
    "name_recorrido2",
    "tarifa_evento",
    "tarifa_evento2",
    "tarifa_adicional",
    "tarifa_adicional2",

    "activo",
    "cve_usuario",
  ];


}
