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
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \Modules\Recibos\Entities\Lugares;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $tipo_usuario = Auth::user()->tipo_usuario;

      if($tipo_usuario == 1){
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
        ////////////////////////////////////////////////////////////////
        $query ="
        SELECT
        *
        FROM cat_area_departamentos where activo = 1 ";
        $cursoss = DB::select($query);

        $nombre_cursos = [];
        $numero_cursos = [];

        $data1 = array();
        $data2 = array();


        foreach ($cursoss as $key => $value) {

          //$value->nombre_curso;

          $data1[] = $value->nombre;
          $data2[] = $key;
          array_push($nombre_cursos,$value->nombre.',');
          array_push($numero_cursos,$key.',');
        }
          $data['data1'] = $data1;
          $data['id_cursos'] = Recibos::where([['activo',1]])->select('id_dependencia')->orderby('id','asc')->get();
      }else{
        $id = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$id)->first();

        $data['capturados'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',1],
        ['id_dependencia',$asociar->id_dependencia]
        ])->count();
        $data['proceso'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',2],
        ['id_dependencia',$asociar->id_dependencia]
        ])->count();
        $data['finiquitado'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',4],
        ['id_dependencia',$asociar->id_dependencia]
        ])->count();
        $data['pendiente'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',7],
        ['id_dependencia',$asociar->id_dependencia]
        ])->count();

        ////////////////////////////////////////////////////////////////
        $query ="
        SELECT
        *
        FROM cat_area_departamentos where activo = 1 ";
        $cursoss = DB::select($query);

        $nombre_cursos = [];
        $numero_cursos = [];

        $data1 = array();
        $data2 = array();


        foreach ($cursoss as $key => $value) {

          //$value->nombre_curso;

          $data1[] = $value->nombre;
          $data2[] = $key;
          array_push($nombre_cursos,$value->nombre.',');
          array_push($numero_cursos,$key.',');
        }
          $data['data1'] = $data1;
          $data['id_cursos'] = Recibos::where([['activo',1],['id_dependencia',$asociar->id_dependencia]])->select('id_dependencia')->orderby('id','asc')->get();

      }



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

    public function tabla(){

      setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");
      //dd('entro');

      $tipo_usuario = Auth::user()->tipo_usuario;

      if($tipo_usuario == 1){
        $registros = Recibos::where('activo', 1)->take(5)->orderBy('id','ASC')->get();
      }else{
        $id = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$id)->first();

        $registros = Recibos::where([
          ['activo', 1],
          ['id_dependencia',$asociar->id_dependencia]
        ])->take(5)->orderBy('id','ASC')->get();
      }



      $datatable = DataTables::of($registros)
      ->editColumn('cve_estatus', function ($registros) {

        return $registros->obtenerEstatus->nombre;
      })
      ->editColumn('num_dias', function ($registros) {

        $lugarest = Lugares::where([
          ['activo',1],
          ['cve_t_viatico',$registros->id],
          ])->first();

        return '$'.$lugarest->total_recibido;
      })



      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) {

          $acciones = [
             "Editar" => [
               "icon" => "edit blue",
               "href" => "/recibos/$value->id/edit"
             ],

            "Ver" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/show"
            ],
            "Finiquitar Provisional" => [
              "icon" => "fas fa-circle",
              "onclick" => "finiquitarP($value->id)"
            ],
            "Finiquitar" => [
              "icon" => "fas fa-circle",
              "onclick" => "finiquitar($value->id)"
            ],
            "Cancelar" => [
              "icon" => "fas fa-circle",
              "onclick" => "baja($value->id)"
            ],
            "Recibo Complementario" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/recibo"
            ],
            "Comprobaciones" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/comprobantes"
            ],
            "Imprimir Recibo" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/imprimir"
            ],
            "Oficio de Comisión" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/oficio"
            ],
            "Especificación de Comisión" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/especificacioncomision"
            ],

          ];

        $value->acciones = generarDropdown($acciones);

      }
      $datatable->setData($data);
      return $datatable;

    }

    public function TraerDatosCursos(Request $request){
      //dd($request->all());

      $estudiante_inscrito = Recibos::where([
        ['activo',1],
        ['id_dependencia',$request->id_curso]
      ])->select(DB::raw('count(id) as total_incritos'))->get();
      //dd($estudiante_inscrito);
      return $estudiante_inscrito;
    }
}
