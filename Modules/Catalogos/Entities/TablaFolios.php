<?php

namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;

class TablaFolios extends Model{
  protected $table = "cat_t_folios";
  protected $fillable = [
    "id",
    "cve_folio",
    "genera_folio",
    "tipo_folio",
    "foliador",
    "folio_actual",
    "activo",
    "cve_usuario",
  ];


}
