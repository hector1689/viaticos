<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model{
  protected $table = "cat_localidad";
  protected $fillable = [
    "id",
    "cve_pais",
    "cve_estado",
    "cve_municipio",
    "localidad",
    "activo",
    "cve_usuario",
  ];


}
