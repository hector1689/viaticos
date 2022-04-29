<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model{
  protected $table = "cat_estados";
  protected $fillable = [
    "id",
    "id_pais",
    "nombre",
    "corto",
    "coordenadas",
    "activo",
  ];


}
