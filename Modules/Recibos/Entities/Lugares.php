<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Lugares extends Model{
  protected $table = "t_lugares";
  protected $fillable = [
    "id",
    "remoto",
    "cve_t_viatico",
    "cve_localidad_origen",
    "cve_localidad_destino",
    "dias",
    "cve_zona",
    "kilometros",
    "combustible",
    "hospedaje",
    "desayuno",
    "comida",
    "cena",
    "cve_programa",
    "total_recibido",
    "activo",
  ];

  public function obteneLocalidad(){
    return $this->hasOne('\Modules\Catalogos\Entities\Kilometraje', 'id', 'cve_localidad_origen');
  }

  public function obteneLocalidad2(){
    return $this->hasOne('\Modules\Catalogos\Entities\Kilometraje', 'id', 'cve_localidad_destino');
  }

  public function obteneLocalidades(){
    return $this->hasOne('\Modules\Catalogos\Entities\Kilometraje', 'id', 'cve_localidad_origen');
  }

  public function obteneLocalidades2(){
    return $this->hasOne('\Modules\Catalogos\Entities\Kilometraje', 'id', 'cve_localidad_destino');
  }

  public function obteneZona(){
    return $this->hasOne('\Modules\Catalogos\Entities\Zona', 'id', 'cve_zona');
  }

  public function obtenePrograma(){
    return $this->hasOne('\Modules\Catalogos\Entities\Programa', 'id', 'cve_programa');
  }


}
