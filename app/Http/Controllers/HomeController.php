<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Modules\Usuarios\Entities\Roles;
use \Modules\Usuarios\Entities\RolesPermisos;
use \Modules\Usuarios\Entities\ModeloRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use \DB;
use \Modules\Recibos\Entities\Recibos;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $data['capturados'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',1]
        ])->count();
        $data['proceso'] = Recibos::where([
          ['activo',1],
          ['cve_estatus',2]
          ])->count();
          $data['finiquitado'] = Recibos::where([
            ['activo',1],
            ['cve_estatus',4]
            ])->count();
            $data['pendiente'] = Recibos::where([
              ['activo',1],
              ['cve_estatus',7]
              ])->count();
      return view('dashboard')->with($data);
    }

    public function actualizar(Request $request){
      //dd('entro');

      $roles_permisos = RolesPermisos::where('role_id',Auth::user()->tipo_usuario)->get();
       ModeloRoles::where('model_id',Auth::user()->id)->delete();
       foreach ($roles_permisos as $key => $value) {
         $modelo = new ModeloRoles();
         $modelo->permission_id = $value['permission_id'];
         $modelo->model_type = 'App\Models\User';
         $modelo->model_id = Auth::user()->id;
         $modelo->save();
       }

       return 1;
    }
}
