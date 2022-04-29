<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model{
  protected $table = "cat_zona";
  protected $fillable = [
    "id",
    "nombre",
  ];


}
