<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class EstatusRecibo extends Model{
  protected $table = "cat_estatus";
  protected $fillable = [
    "id",
    "nombre",
  ];


}
