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
    "id_dependencia",
    "activo",
    "cve_usuario",
  ];

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }


}
