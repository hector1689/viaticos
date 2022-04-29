<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Alimentos extends Model{
  protected $table = "cat_alimentacion";
  protected $fillable = [
    "id",
    "rango_inicia",
    "rango_final",
    "importe_desayuno",
    "importe_comida",
    "importe_cena",
    "vigencia_inicia",
    "vigencia_final",
    "activo",
    "cve_usuario",
  ];


}
