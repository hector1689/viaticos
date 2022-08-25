<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model{
  protected $table = "cat_localidad";
  protected $fillable = [
    "id",
    "cve_pais",
    "cve_estado",
    "cve_municipio",
    "localidad",
    'id_dependencia',
    "activo",
    "cve_usuario",
  ];



  public function obtenePais(){
    return $this->hasOne('\Modules\Catalogos\Entities\Pais', 'id', 'cve_pais');
  }

  public function obteneEstado(){
    return $this->hasOne('\Modules\Catalogos\Entities\Estado', 'id', 'cve_estado');
  }

  public function obteneMunicipio(){
    return $this->hasOne('\Modules\Catalogos\Entities\Municipio', 'id', 'cve_municipio');
  }


  public function obtenerDependencia(){
    return $this->hasOne('\Modules\Catalogos\Entities\Areas', 'id', 'id_dependencia');
  }
}
