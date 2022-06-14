<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Folios extends Model{
  protected $table = "cat_folios";
  protected $fillable = [
    "id",
    "dependencia",
    "direccion_area",
    "director_administrativo",
    "comisario",
    "superior_inmediato",
    "cve_usuario_inmediato",
    "cve_usuario",
    "activo",
  ];

  public function obteneUsuario(){
    return $this->hasOne('\App\Models\User', 'id', 'cve_usuario_inmediato');
  }

  public function obtenerArea(){
    return $this->hasOne('Modules\Catalogos\Entities\Areas', 'id', 'dependencia');
  }

}
