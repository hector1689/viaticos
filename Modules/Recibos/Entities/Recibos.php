<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Recibos extends Model{
  protected $table = "t_viaticos";
  protected $fillable = [
    "id",
    "folio",
    "oficio_comision",
    "cve_estatus",
    "num_empleado",
    "nombre",
    "rfc",
    "nivel",
    "clave_departamental",
    "dependencia",
    "direccion",
    "fecha_hora_salida",
    "fecha_hora_recibio",
    "departamentos",
    "lugar_adscripcion",
    "num_dias",
    "num_dias_inhabiles",
    "descripcion_comision",
    "recibo_complentario",
    "motivo",
    "activo",
    "cve_usuario",

  ];


  public function obtenerEstatus(){
    return $this->hasOne('\Modules\Recibos\Entities\EstatusRecibo', 'id', 'cve_estatus');
  }

}
