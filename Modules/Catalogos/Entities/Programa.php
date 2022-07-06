<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model{
  protected $table = "cat_programa";
  protected $fillable = [
    "id",
    "nombre",
    "id_dependencia",
    "activo",
    "cve_usuario",
  ];

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }


}
