<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class ReciboFirmantes extends Model{
  protected $table = "t_firmas";
  protected $fillable = [
    "id",
    "cve_t_viaticos",
    "director_area",
    "organo_control",
    "director_administrativo",
    "recibi_cheque",
    "superior_inmediato",
    "activo",
    "cve_usuario",
  ];


}
