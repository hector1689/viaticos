<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class PeajeTransporte extends Model{
  protected $table = "t_peaje";
  protected $fillable = [
    "id",
    "cve_peaje",
    "cve_t_transporte",
    "nombre",
    "costo",
    "activo",
    "cve_usuario",
  ];


}
