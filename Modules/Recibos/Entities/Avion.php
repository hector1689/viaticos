<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Avion extends Model{
  protected $table = "t_avion";
  protected $fillable = [
    "id",
    "cve_t_transporte",
    "tipo_viaje",
    "costo_total",
    "activo",
    "cve_usuario",
  ];


}
