<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model{
  protected $table = "cat_hospedajes";
  protected $fillable = [
    "id",
    "rango_inicia",
    "rango_final",
    "zona",
    "importe",
    "vigencia_inicia",
    "vigencia_final",
    "activo",
    "cve_usuario",
  ];


}
