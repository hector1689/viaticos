<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model{
  protected $table = "t_seguimiento";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "fecha",
    "tarea",
    "activo",
    "cve_usuario",
  ];


  public function Usuario_obt(){
     return $this->hasOne('app\Models\User', 'id', 'cve_usuario');
  }


}
