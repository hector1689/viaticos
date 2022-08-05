<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Modules\Usuarios\Entities\Roles;
use \Modules\Usuarios\Entities\RolesPermisos;
use \Modules\Usuarios\Entities\ModeloRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Areas;
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

      if($tipo_usuario == 4){
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
        $data['tipo_usuario'] = $tipo_usuario;
        ////////////////////////////////////////////////////////////////
        $query ="
        SELECT
        *
        FROM cat_area_departamentos where activo = 1 and id_padre = 0  ";
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
      }elseif($tipo_usuario == 1){

        $id = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$id)->first();
        $usuario = Auth::user()->id;


        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;


        $reg = Areas::find($area);

          $id_reg = 0;
          $id_est = 0;
          $nivel1 = [];
          if($reg) {
              $nivel  = $reg->nivel;


              $id_reg = $reg->id ;   // cve_t_estructura;
              $id_est = $reg->id;
              //dd($id_reg,$nivel);
              if ($nivel == 1) {
                  $id_reg = $reg->id;
                  // $id_est = $reg->id;
                  $data = [];
                  $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
                  foreach ($regs as $key => $value) {
                      $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];

                      array_push($nivel1,$value->id);
                  }

                  if (isset($reg->id)) {
                    $regs2 = Areas::where([ ['activo', 1], ['id_padre', $reg->id] , ['nivel', 2] ])->get();
                    foreach ($regs2 as $key => $value2) {
                        array_push($nivel1,$value2->id);
                    }
                  }



                    if (isset($value2->id)) {
                      $regs3 = Areas::where([ ['activo', 1], ['id_padre', $value2->id] , ['nivel', 3] ])->get();
                      foreach ($regs3 as $key => $value3) {
                          array_push($nivel1,$value3->id);
                      }
                    }


                    if (isset($value3->id)) {
                      $regs4 = Areas::where([ ['activo', 1], ['id_padre', $value3->id] , ['nivel', 4] ])->get();
                      foreach ($regs4 as $key => $value4) {
                          array_push($nivel1,$value4->id);
                      }
                    }

                    if (isset($value4->id)) {
                      $regs5 = Areas::where([ ['activo', 1], ['id_padre', $value4->id] , ['nivel', 5] ])->get();
                      foreach ($regs5 as $key => $value5) {
                          array_push($nivel1,$value5->id);
                      }
                    }
              }

        }
        //dd($nivel1);




        $data['capturados'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',1],
        //['id_dependencia',$asociar->id_dependencia]
        ])->whereIN('id_dependencia',$nivel1)->count();
        $data['proceso'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',2],
        //['id_dependencia',$asociar->id_dependencia]
        ])->whereIN('id_dependencia',$nivel1)->count();
        $data['finiquitado'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',4],
        //['id_dependencia',$asociar->id_dependencia]
        ])->whereIN('id_dependencia',$nivel1)->count();
        $data['pendiente'] = Recibos::where([
        ['activo',1],
        ['cve_estatus',7],
        //['id_dependencia',$asociar->id_dependencia]
        ])->whereIN('id_dependencia',$nivel1)->count();
        $data['tipo_usuario'] = $tipo_usuario;
        ////////////////////////////////////////////////////////////////

          $data['id_cursos'] = Recibos::where([['activo',1]])->whereIN('id_dependencia',$nivel1)->select('id_dependencia')->orderby('id','asc')->get();
        ////////////////////////////////////////////////////////////////////
      }elseif($tipo_usuario == 2){
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
          $data['tipo_usuario'] = $tipo_usuario;
          ////////////////////////////////////////////////////////////////
          $query ="
          SELECT
          *
          FROM cat_area_departamentos where activo = 1  ";
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
            //////////////////////////////////////////////////////////
            $usuario = Auth::user()->id;
            $asociar = Asociar::where('id_usuario',$usuario)->first();
            $area = $asociar->id_dependencia;
            $data['id_cursos'] = Recibos::where([['activo',1],['id_dependencia',$asociar->id_dependencia]])->select('id_dependencia')->orderby('id','asc')->get();

      }elseif($tipo_usuario == 3){
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
        $data['tipo_usuario'] = $tipo_usuario;
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

      if($tipo_usuario == 4){
        $registros = Recibos::where('activo', 1)->take(5)->orderBy('id','ASC')->get();
      }elseif($tipo_usuario == 1){

        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;


        $reg = Areas::find($area);

          $id_reg = 0;
          $id_est = 0;
          $nivel1 = [];
          if($reg) {
              $nivel  = $reg->nivel;


              $id_reg = $reg->id ;   // cve_t_estructura;
              $id_est = $reg->id;
              //dd($id_reg,$nivel);
              if ($nivel == 1) {
                  $id_reg = $reg->id;
                  // $id_est = $reg->id;
                  $data = [];
                  $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
                  foreach ($regs as $key => $value) {
                      $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];

                      array_push($nivel1,$value->id);
                  }

                  if (isset($reg->id)) {
                    $regs2 = Areas::where([ ['activo', 1], ['id_padre', $reg->id] , ['nivel', 2] ])->get();
                    foreach ($regs2 as $key => $value2) {
                        array_push($nivel1,$value2->id);
                    }
                  }



                    if (isset($value2->id)) {
                      $regs3 = Areas::where([ ['activo', 1], ['id_padre', $value2->id] , ['nivel', 3] ])->get();
                      foreach ($regs3 as $key => $value3) {
                          array_push($nivel1,$value3->id);
                      }
                    }


                    if (isset($value3->id)) {
                      $regs4 = Areas::where([ ['activo', 1], ['id_padre', $value3->id] , ['nivel', 4] ])->get();
                      foreach ($regs4 as $key => $value4) {
                          array_push($nivel1,$value4->id);
                      }
                    }

                    if (isset($value4->id)) {
                      $regs5 = Areas::where([ ['activo', 1], ['id_padre', $value4->id] , ['nivel', 5] ])->get();
                      foreach ($regs5 as $key => $value5) {
                          array_push($nivel1,$value5->id);
                      }
                    }
              }

        }
        //dd($nivel1);

        $registros = Recibos::where([['activo', 1]])->whereIN('id_dependencia',$nivel1)->take(5)->orderBy('id','ASC')->get();

      }elseif($tipo_usuario == 2){


        $id = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$id)->first();

        $registros = Recibos::where([
          ['activo', 1],
          ['id_dependencia',$asociar->id_dependencia]
        ])->take(5)->orderBy('id','ASC')->get();
      }elseif($tipo_usuario == 3){
        $registros = Recibos::where([
          ['activo', 1],
          ['cve_estatus',8]
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
     //dd($request->id_curso);

      $estudiante_inscrito = Recibos::join('cat_area_departamentos','cat_area_departamentos.id','=','t_viaticos.id_dependencia')->where([
        ['t_viaticos.activo',1],
        ['cat_area_departamentos.id',$request->id_curso]
      ])->select(DB::raw('count(t_viaticos.id) as total_incritos'))->groupBy('cat_area_departamentos.id')->get();
      //dd($estudiante_inscrito);
      return $estudiante_inscrito;
    }

    public function datos1(Request $request){

      $areas = Areas::where('activo',1)->whereIN('id',$request->array)->get();
        return $areas;
    }

    public function datos2(Request $request){
      //dd($request->arrays);
      $estudiante_inscrito = Recibos::join('cat_area_departamentos','cat_area_departamentos.id','=','t_viaticos.id_dependencia')->where('t_viaticos.activo',1
      )->whereIN('cat_area_departamentos.id',$request->arrays)->select(DB::raw('count(t_viaticos.id) as total_incritos'))->groupBy('cat_area_departamentos.id')->get();

      $nombre_cursos = [];
      foreach ($estudiante_inscrito as $key => $value) {

        $data1[] = $value->total_incritos;
        array_push($nombre_cursos,$value->total_incritos.',');

      }

      //dd($estudiante_inscrito);
        return $data1;
        //return $estudiante_inscrito;
    }
}
