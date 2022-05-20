<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class ComisionAcreditados extends Model{
  protected $table = "t_comision_especificar_acreditar";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "acreditado",
    "activo",
    "cve_usuario",
  ];


}
