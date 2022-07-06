<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Kilometraje extends Model{
  protected $table = "cat_kilometraje";
  protected $fillable = [
    "id",
    "cve_localidad_origen",
    "cve_localidad_destino",
    "distancia_kilometros",
      "id_dependencia",
    "activo",
    "cve_usuario",
  ];

  public function obteneLocalidad(){
    return $this->hasOne('\Modules\Catalogos\Entities\Localidad', 'id', 'cve_localidad_origen');
  }

  public function obteneLocalidad2(){
    return $this->hasOne('\Modules\Catalogos\Entities\Localidad', 'id', 'cve_localidad_destino');
  }


public function obtenerDependencia(){
  return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
}

}
