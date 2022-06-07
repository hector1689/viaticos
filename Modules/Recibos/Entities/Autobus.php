<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Autobus extends Model{
  protected $table = "t_autobus";
  protected $fillable = [
    "id",
    "cve_t_transporte",
    "tipo_transporte",
    "tipo_viaje",
    "costo_total",
    "activo",
    "cve_usuario",
  ];


}
