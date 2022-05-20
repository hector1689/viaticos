<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class ComisionEspecificar extends Model{
  protected $table = "t_comision_especificar";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "especificar_comision",
    "recorrido_interno",
    "cve_kilometraje",
    "direccion",
    "activo",
    "cve_usuario",
  ];


  public function Lugar_obt(){
     return $this->hasOne('Modules\Catalogos\Entities\Kilometraje', 'id', 'cve_kilometraje');
  }

}
