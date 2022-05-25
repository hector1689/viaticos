<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model{
  protected $table = "cat_vehiculos";
  protected $fillable = [
    "id",
    "num_oficial",
    "marca",
    "modelo",
    "tipo",
    "placas",
    "cilindraje",
    "activo",
    "cve_usuario",
  ];


}
