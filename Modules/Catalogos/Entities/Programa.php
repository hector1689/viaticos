<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model{
  protected $table = "cat_programa";
  protected $fillable = [
    "id",
    "nombre",
    "activo",
    "cve_usuario",
  ];


}
