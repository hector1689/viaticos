<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class ComisionPersonal extends Model{
  protected $table = "t_comision_especificar_personal";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "id_personal",
    "activo",
    "cve_usuario",
  ];

  public function Personal_obt(){
     return $this->hasOne('Modules\Catalogos\Entities\Personal_Departamento', 'id', 'id_personal');
  }




}
