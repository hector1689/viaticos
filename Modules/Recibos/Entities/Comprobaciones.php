<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class Comprobaciones extends Model{
  protected $table = "t_comprobaciones";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "archivo",
    "activo",
    "cve_usuario",
  ];


}
