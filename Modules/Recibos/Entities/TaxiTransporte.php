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
    "dia_adicional",
    "activo",
    "cve_usuario",
  ];


}
