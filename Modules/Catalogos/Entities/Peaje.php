<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Peaje extends Model{
  protected $table = "cat_peaje";
  protected $fillable = [
    "id",
    "ubicacion_peaje",
    "costo",
    "vigencia",
    "activo",
    "cve_usuario",
  ];


}
