<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Rendimiento extends Model{
  protected $table = "cat_rendimiento";
  protected $fillable = [
    "id",
    "tarifa",
    "kilometros_litros",
    "descripcion",
    "activo",
    'id_dependencia',
    "cve_usuario",
  ];

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }


}
