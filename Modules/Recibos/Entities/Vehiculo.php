<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model{
  protected $table = "t_vehiculo_particular";
  protected $fillable = [
    "id",
    "cve_t_transporte",
    "tipo_transporte",
    "tipo_viaje",
    "marca",
    "modelo",
    "tipo",
    "placas",
    "cilindraje",
    "cuota",
    "gasolina",
    "mes_gasolina",
    "gasolina_vh_oficial",
    "cve_programa",
    "proporciono_vales",
    "total_transporte",
    "activo",
    "cve_usuario",
  ];

  public function obteneGasolinas2(){
    return $this->hasOne('\Modules\Catalogos\Entities\Gasolina', 'id', 'gasolina');
  }


}
