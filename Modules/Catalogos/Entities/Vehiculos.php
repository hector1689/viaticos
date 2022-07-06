<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model{
  protected $table = "cat_vehiculos";
  protected $fillable = [
    "id",
    "num_oficial",
    "marca",
    "modelo",
    "tipo",
    "placas",
    "cilindraje",
    "id_dependencia",
    "activo",
    "cve_usuario",
  ];

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }

}
