<?php
namespace Modules\Catalogos\Entities;

use Illuminate\Database\Eloquent\Model;



class Departamento_Firmantes extends Model{
  protected $table = "firmantes_departamentos";
  protected $primaryKey = "id";
  protected $fillable = [
    "cve_area_departamentos",
    "cve_empleado",
    'cve_cargo',
    "numero_empleado",
    "puesto",
    "nombre",
    "apellido_paterno",
    "apellido_materno",
    "activo",
    "correo",
  ];

  public function obtCargo(){
     return $this->hasOne('\Modules\Catalogos\Entities\CargoFirmante', 'id', 'cve_cargo');
  }
  //
  // const CREATED_AT = "created_at";
  // const UPDATED_AT = "updated_at";
}
