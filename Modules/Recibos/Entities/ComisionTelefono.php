<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class ComisionTelefono extends Model{
  protected $table = "t_comision_especificar_telefono";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "telefono",
    "activo",
    "cve_usuario",
  ];


}
