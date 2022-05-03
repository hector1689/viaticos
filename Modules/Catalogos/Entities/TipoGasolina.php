<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoGasolina extends Model{
  protected $table = "cat_tipo_gasolina";
  protected $fillable = [
    "id",
    "nombre",
  ];


}
