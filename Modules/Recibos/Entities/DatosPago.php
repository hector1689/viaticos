<?php

namespace Modules\Recibos\Entities;

use Illuminate\Database\Eloquent\Model;

class DatosPago extends Model{
  protected $table = "t_dato_pago";
  protected $fillable = [
    "id",
    "cve_t_viatico",
    "secretaria",
    "num_cheque",
    "fehca_inicia",
    "cantidad",
    "cantidad_letra",
    "favor_cargo_banco",
    "activo",
    "cve_usuario",
  ];



}
