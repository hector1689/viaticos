<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Gasolina extends Model{
  protected $table = "cat_gasolina";
  protected $fillable = [
    "id",
    "cve_tipo_gasolina",
    "anio",
    "mes",
    'id_dependencia',
    "precio_litro",
    "vigencia",
    "activo",
  ];

  public function obteneGasolina(){
    return $this->hasOne('\Modules\Catalogos\Entities\TipoGasolina', 'id', 'cve_tipo_gasolina');
  }

  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }

}
