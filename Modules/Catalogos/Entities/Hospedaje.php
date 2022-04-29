<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model{
  protected $table = "cat_hospedajes";
  protected $fillable = [
    "id",
    "rango_inicial",
    "rango_final",
    "cve_zona",
    "importe",
    "vigencia_inicial",
    "vigencia_final",
    "activo",
    "cve_usuario",
  ];

  public function obtenerZona(){
    return $this->hasOne('\Modules\Catalogos\Entities\Zona', 'id', 'cve_zona');
  }


}
