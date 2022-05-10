<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;

use Modules\Catalagos\Entities\Tipo_Responsable;
use Modules\Catalagos\Entities\Tipo_Autorizacion;




use \Modules\Catalogos\Entities\CargoFirmante;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Catalogos\Entities\Personal_Siti;
use \Modules\Catalogos\Entities\Siti;
use \Modules\Catalogos\Entities\Personal_Departamento;
use \DB;
class ComisionadosController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware(function ($request, $next) {
        $this->user = Auth::user();
        return $next($request);
    });
  }
  /**
 * Display a listing of the resource.
 * @return Response
 */


   protected $entorno;
   protected $BDSITAM;
   protected $BD035;
   protected $catalog;
   protected $rolAdmin;
   protected $rolAdminDependencia;
   protected $rolesUser;

   // public function __construct()
   // {
   //   $this->BDSITAM = getenv('PREFIJO_AMBIENTE')."sitam";
   //   $this->BD037 = getenv('PREFIJO_AMBIENTE') . "ms042";
   //   $this->rolAdmin  = Rol::where('moduloCreador', 'ms042')->where('nombre', 'Administrador')->first();
   //   $this->rolAdminDependencia  = Rol::where('moduloCreador', 'ms042')->where('nombre', 'Administrador Dependencia')->first();
   //   $this->entorno =  getenv('PREFIJO_AMBIENTE');
   //
   //   $this->middleware(function ($request, $next) {
   //     $this->rolesUser = json_decode(Auth::user()->roles);//Los roles asignados al usuario logueado;
   //     return $next($request);
   //   });
   // }

public function index()
{
    $data['cargo'] = CargoFirmante::all();
    return view('catalogos::comisionados.index')->with($data);
}

/**
 * Show the form for creating a new resource.
 * @return Response
 */
 ////////////////////// NUEVO CODIGO ////////////////////////////////////
 public function buscaAreas($id = 0, $filtra_roles = 0, $cve_cat_tipo, $permitidas = 0) {

     $usuario    = Auth::user();
     $id_usuario = $usuario->id;

     $lista_areas = [];


       // $itemUser  = Usuario::where('cve_usuario_unico',Auth::user()->id)->where('activo',1)->first();

         // if($cve_cat_tipo!='' && $cve_cat_tipo !='0'){
         //   $arrayTipos = explode(",", $cve_cat_tipo);
         //   //dd($arrayTipos);
         //   $registros = Areas::where('activo', 1)
         //                         ->where('id_rama','=', $itemUser->cve_cat_dependencia)
         //                         ->whereIn('id_tipo','=', $arrayTipos)
         //                         ->get();
         //                         dd($registros);
         //
         // }else{
           //dd('entro');
           // $table = getenv('PREFIJO_AMBIENTE') . "ms036";
           // $tables = getenv('PREFIJO_AMBIENTE') . "ms011";
           $registros = Areas::leftjoin('cat_personal_jefes','cat_personal_jefes.cve_cat_deptos_siti','=','cat_area_departamentos.id')->
           select(
             'cat_area_departamentos.id',
             'cat_area_departamentos.id_padre',
             'cat_area_departamentos.nivel',
             'cat_area_departamentos.nombre',
             'cat_area_departamentos.corto',
             'cat_area_departamentos.clave',
             'cat_area_departamentos.centro_gestor',
             'cat_area_departamentos.activo',
             'cat_area_departamentos.id_tipo',
             'cat_personal_jefes.nombre_empleado',
             'cat_personal_jefes.apellido_p_empleado',
             'cat_personal_jefes.apellido_m_empleado'
             )->
           where([['cat_area_departamentos.activo', 1],['cat_area_departamentos.id_rama','=', 1],['cat_personal_jefes.activo','=', 1]])->get();

           //dd($registros);
         // }

       $data['rol'] = 'ADMINDEPENDENCIA';
     $id_padre = null;
     //dd($registros);
     foreach ($registros as $key => $value) {

         $id_padre = $value->id_padre;
                 $areas [] = $this->crea_arreglo($value, 0);

     }
     //dd($areas);
     if(isset($areas)){
       return array($areas, '');
     } else {
       $areas = [];
       return array($areas,'');
     }


 }

 public function datos_area ($id) {
     // $table = getenv('PREFIJO_AMBIENTE') . "ms036";
     // $tables = getenv('PREFIJO_AMBIENTE') . "ms011";
     $registros = Areas::leftjoin('cat_personal_jefes','cat_personal_jefes.cve_cat_deptos_siti','=','cat_area_departamentos.id')->
     //rightjoin($tables.'.'.'t_empleado','t_empleado.cve_t_empleado','=','cat_personal_siti.cve_t_empleado')->
     select(
       'cat_area_departamentos.id',
       'cat_area_departamentos.id_padre',
       'cat_area_departamentos.nivel',
       'cat_area_departamentos.nombre',
       'cat_area_departamentos.corto',
       'cat_area_departamentos.clave',
       'cat_area_departamentos.centro_gestor',
       'cat_area_departamentos.activo',
       'cat_area_departamentos.id_tipo',
       'cat_personal_jefes.nombre_empleado',
       'cat_personal_jefes.apellido_p_empleado',
       'cat_personal_jefes.apellido_m_empleado',
       'cat_personal_jefes.puesto_empleado',

       'cat_personal_jefes.telefono',
       'cat_personal_jefes.extension',
       'cat_personal_jefes.correo_empleado'
       )->
     where([ ['cat_area_departamentos.activo', 1], ['cat_area_departamentos.id', $id] ])
     ->get();

     $areas = [];

     foreach ($registros as $key => $value) {
         $areas  = $this->crea_arreglo($value, '');
     }

       $data['rol'] = 'ADMINDEPENDENCIA';

     array_push($areas,$data['rol']);
     //dd($areas);
     return $areas;
 }

 public function crea_arreglo ($value) {
   //dd("entro");
    //dd($value);
     $valor  = array('id' => $value["id"],
                 'id_padre' => $value["id_padre"],
                 'nivel' => $value["nivel"],
                 'nombre' => $value["nombre"],
                 'corto' => $value["corto"],
                 'clave' => $value["clave"],
                 'centro_gestor' => $value["centro_gestor"],
                 'activo' => $value["activo"],
                 'id_tipo' => $value['id_tipo'],
                 'cve_t_empleado' => $value['nombre_empleado'].' '.$value['apellido_p_empleado'].' '.$value['apellido_m_empleado'],
                 'nombre_us' => $value['nombre_empleado'],
                 'ap_us' =>$value['apellido_p_empleado'],
                 'am_us' =>$value['apellido_m_empleado'],
                 'puesto' => $value['puesto_empleado'],
                 'telefono' => $value['telefono'],
                 'extension' => $value['extension'],
                 'correo' => $value['correo_empleado'],
              );

     return $valor;
 }

 public function create_area (Request $request) {
     $datos = $request->all();
     $id_usuario = Auth::user()->id;
     try {

         $datos ['cve_usuario'] = $id_usuario;
         $datos ['id_padre'] = (int) $datos['id_padre'];

         if($datos ['id_padre'] == 0){

           $id_rama1 = Areas::where('activo',1)->orderBy('id', 'DESC')->get();

           if(count($id_rama1)>0){
             $rama = $id_rama1[0]->id + 1;
           } else {
             $rama = 1;
           }

         } else{
           $rama = $this->buscaRama($datos ['id_padre']);
         }

         $datos['id_rama'] = $rama;

         $registros = new Areas();
         $registros->id_padre = $datos ['id_padre'];
         $registros->nivel = $datos['nivel'];
         $registros->nombre = $datos['nombre'];
         $registros->id_tipo = $datos['id_tipo'];
         $registros->id_rama = 1;
         $registros->cve_usuario = Auth::user()->id;
         $registros->save();


          $reponsable_area = new Personal_Siti();
          $reponsable_area->cve_cat_deptos_siti = $registros->id;
          $reponsable_area->nombre_empleado = $request->nombre_empleado;
          $reponsable_area->apellido_p_empleado = $request->apellido_p_empleado;
          $reponsable_area->apellido_m_empleado = $request->apellido_m_empleado;
          $reponsable_area->puesto_empleado = $request->puesto_empleado;
          $reponsable_area->telefono = $request->telefono_empleado;
          $reponsable_area->extension = $request->extension;
          $reponsable_area->correo_empleado = $request->correo;
          $reponsable_area->cve_usuario = Auth::user()->id;
          $reponsable_area->save();






         return response()->json(['success'=>'área creada con éxito']);

     } catch (\Exception $e) {
         dd($e->getMessage());
     }
 }

 public function update_area (Request $request, $id) {
     //dd($request->all());
     $datos = $request->all();
     //dd("entro update");
     $id_usuario = Auth::user()->id;
   //  dd($datos);
     try {
       //
         if ($id > 0) {

            $area = Areas::find($id);
            $area->nombre = $request->nombre;
            $area->cve_usuario_empleado = $request->cve_usuario_empleado;
            $area->cve_usuario = $id_usuario;
            $area->save();

             $responsable_siti = Personal_Siti::where([
               ['cve_cat_deptos_siti',$area->id],
               ['activo',1]
             ])->update([
              'nombre_empleado' => $request->nombre_empleado,
              'apellido_p_empleado' => $request->apellido_p_empleado,
              'apellido_m_empleado' => $request->apellido_m_empleado,
              'cve_usuario_empleado' => $request->cve_usuario_empleado,
              'cve_t_empleado' => $request->id_empleado,
              'telefono' => $request->telefono_empleado,
              'extension' => $request->extension,
              'correo_empleado' => $request->correo,
              'puesto_empleado' => $request->puesto_empleado,
              'cve_usuario' => Auth::user()->id,
             ]);

             // $reponsable_compras = new Personal_Siti();
             // $reponsable_compras->cve_t_empleado = $request->id_empleado;
             // $reponsable_compras->cve_cat_deptos_siti = $registros->id;
             // $reponsable_compras->cve_cat_tipo_resp = $request->cve_cat_tipo_resp;
             // $reponsable_compras->cve_cat_tipo_aut = $request->cve_cat_tipo_aut;
             // // $reponsable_compras->telefono = $request->telefono;
             // $reponsable_compras->puesto_empleado = $request->puesto_empleado;
             // // $reponsable_compras->correo_empleado = $request->correo_empleado;
             // $reponsable_compras->cve_usuario = Auth::user()->id;
             // $reponsable_compras->save();

             //dd($area);
         }



         return response()->json(['success'=>'área actualizada con éxito']);

     } catch (\Exception $e) {
        dd($e->getMessage());
     }
 }

 public function delete_area (Request $request) {

     try {
         $area = Areas::find($request->id);
         $area->activo = 0;
         $area->save();

         // id_padre en areas
         $registros = Areas::where([ ['activo', 1], ['id_padre', $request->id] ])->get();
         foreach ($registros as $key => $value) {
             $clave = $value["id"];

             $query   = "UPDATE " .$this->base ."cat_entidades2 SET activo = 0 ";
             $query  .= "WHERE id = " .$clave;
             $area = DB::select($query);

         }

         // return $this->respuestaCor("área eliminada con éxito", '');
         return response()->json(['success'=>'Área Eliminada exitosamente']);

     } catch (\Exception $e) {
         return $this->respuestaErr("Ocurrió un error al eliminar el área", "", [
             "e" => $e->getMessage()
         ]);
     }
 }



 public function buscaRama($id) {
     $rama = Areas::where([ ['activo', 1], ['id', $id] ])->value('id_rama');
     return $rama;

 }


 public function TraerPersonal(Request $request){

   $responsable = Personal_Siti::find($request->id);

   return $responsable;
 }




 public function buscarPersonas($_query){

   $table = getenv('PREFIJO_AMBIENTE') . "ms011";
   $tables = getenv('PREFIJO_AMBIENTE') . "sitam";

   $numero_registro ="";

   if($this->entorno == 'dev'){
     $tableGral = 'devsitam';
   }else if($this->entorno == 'test'){
     $tableGral = 'testsitam';
   }

   $query = DB::select("
   SELECT
   t_empleado_rup.cve_t_empleado as id,
   ".$tables.".users.nombres,
   ".$tables.".users.apellidos,
   ".$tables.".users.email,
   ".$tables.".users.id as cve_usuario,
   t_empleado_rup.secretaria,
   t_empleado_rup.cve_empleado,
   cat_gobtam_puestos.puesto
   FROM ".$tables.".users
   INNER JOIN ".$table.".t_empleado_correo ON t_empleado_correo.correo_electronico =  ".$tables.".users.email
   INNER JOIN ".$table.".t_empleado_rup ON t_empleado_rup.cve_t_empleado = t_empleado_correo.cve_t_empleado
   LEFT JOIN ".$table.".t_empleado_rup_opd ON t_empleado_rup_opd.cve_t_empleado = t_empleado_correo.cve_t_empleado
   INNER JOIN ".$table.".cat_gobtam_puestos ON cat_gobtam_puestos.cve_cat_gobtam_puestos = t_empleado_rup.cve_cat_gobtam_puestos
   WHERE CONCAT_WS(' ',".$tables.".users.nombres,".$tables.".users.apellidos) LIKE '%".$_query."%'
   ");

   //dd($query);
   return ['datos'=>$query];
}

public function NivelEstructura(Request $request){
 ///dd($request->all());

 // $table = getenv('PREFIJO_AMBIENTE') . "ms036";
 // $tables = getenv('PREFIJO_AMBIENTE') . "ms011";
 // $registros = Areas::leftjoin($table.'.'.'cat_personal_siti','cat_personal_siti.cve_cat_deptos_siti','=','cat_area_departamentos.id')->
 // // rightjoin($tables.'.'.'t_empleado','t_empleado.cve_t_empleado','=','cat_personal_siti.cve_t_empleado')->
 // select(
 //   'cat_area_departamentos.id',
 //   'cat_area_departamentos.id_padre',
 //   'cat_area_departamentos.nivel',
 //   'cat_area_departamentos.nombre',
 //   'cat_area_departamentos.corto',
 //   'cat_area_departamentos.clave',
 //   'cat_area_departamentos.centro_gestor',
 //   'cat_area_departamentos.activo',
 //   'cat_area_departamentos.id_tipo',
 //   't_empleado.nombre as EmpNom',
 //   't_empleado.paterno as EmpAp',
 //   't_empleado.materno as EmpAm',
 //   'cat_personal_siti.puesto_empleado'
 //   )->
 // where([ ['cat_area_departamentos.activo', 1], ['cat_area_departamentos.id', $request->id] ])
 // ->get();


 $registros = Areas::leftjoin('cat_personal_jefes','cat_personal_jefes.cve_cat_deptos_siti','=','cat_area_departamentos.id')->
 //rightjoin($tables.'.'.'t_empleado','t_empleado.cve_t_empleado','=','cat_personal_siti.cve_t_empleado')->
 select(
   'cat_area_departamentos.id',
   'cat_area_departamentos.id_padre',
   'cat_area_departamentos.nivel',
   'cat_area_departamentos.nombre',
   'cat_area_departamentos.corto',
   'cat_area_departamentos.clave',
   'cat_area_departamentos.centro_gestor',
   'cat_area_departamentos.activo',
   'cat_area_departamentos.id_tipo',
   'cat_personal_jefes.nombre_empleado',
   'cat_personal_jefes.apellido_p_empleado',
   'cat_personal_jefes.apellido_m_empleado',
   'cat_personal_jefes.puesto_empleado',
   'cat_personal_jefes.telefono',
   'cat_personal_jefes.extension',
   'cat_personal_jefes.correo_empleado'
   )->
 where([ ['cat_area_departamentos.activo', 1], ['cat_area_departamentos.id', $request->id] ])
 ->get();

 $areas = [];

 foreach ($registros as $key => $value) {
     $areas  = $this->crea_arreglo($value, '');
 }

 //   $data['rol'] = 'ADMINDEPENDENCIA';
 //
 // array_push($areas,$data['rol']);
 //dd($areas);
 return $registros;

 // $registros = Areas::where([ ['activo', 1], ['id', $request->id] ])->get();
 //
 // return $registros;
}

public function BuscarAreaExistente(Request $request){
  $area = Areas::where([
    ['activo',1],
    ['nombre',$request->nombre_area]
  ])->first();
  return $area;
}

public function tablaPersonal(Request $request){
 setlocale(LC_TIME, 'es_MX.UTF-8');
 // \DB::statement("SET lc_time_names = 'es_ES'");
 $registros = Personal_Departamento::where([
   ['activo',1],
   ['cve_area_departamentos',$request->id]
   ])->get();

 // dd($firmas);
 $datatable = DataTables::of($registros)
 ->editColumn('nombre', function ($registros) {

    return $registros->nombre.' '.$registros->apellido_paterno.' '.$registros->apellido_materno;
   })
 ->make(true);

 //Cueri
 $data = $datatable->getData();
 foreach ($data->data as $key => $value) {
   $acciones = [

     "Eliminar" => [
       "icon" => "trash red",
       "onclick" => "eliminar('$value->id')"
     ]
   ];

   $value->acciones = ( count($acciones) == 0 ) ? "" : generarDropdown($acciones);
 }
 $datatable->setData($data);
 return $datatable;
}

public function destroy(Request $request){
 try {
   $estatus = Personal_Departamento::find($request->id);
   $estatus->activo = 0;
   $estatus->save();

   return response()->json(['success'=>'Personal eliminado del departamento con éxito']);

 } catch (\Exception $e) {
   dd($e->getMessage());
 }


}

public function ExistePersonal(Request $request){
   try {


     $existe_personal = Personal_Departamento::where([
       ['activo',1],
       ['nombre',$request->nombre_empleados],
       ['apellido_paterno',$request->apellido_p_empleados],
       ['apellido_materno',$request->apellido_m_empleados],
     ])->first();

     return $existe_personal;

   } catch (\Exception $e) {
    dd($e->getMessage());

  }
}


public function AltaPersonal(Request $request){
 //dd($request->all());
 try {

   $personal = new Personal_Departamento();
   $personal->cve_area_departamentos = $request->id_area_alta;
   // $personal->cve_empleado = $request->id_empleado;
   $personal->numero_empleado = $request->numero_empleados;
   $personal->puesto = $request->puesto_empleados;
   $personal->nombre = $request->nombre_empleados;
   $personal->apellido_paterno = $request->apellido_p_empleados;
   $personal->apellido_materno = $request->apellido_m_empleados;
   $personal->nivel = $request->nivel_empleados;
   $personal->cve_usuario = Auth::user()->id;
   $personal->save();


   return response()->json(['success'=>'Registro Agregado con éxito']);
 } catch (\Exception $e) {
   dd($e->getMessage());
 }

}

 ///////////////////////////////////////////////////////////////////////
// public function create()
// {
//     return view('sitiservicios::catalogos.motorbd.create');
// }
//
// /**
//  * Store a newly created resource in storage.
//  * @param  Request $request
//  * @return Response
//  */
// public function store(Request $request)
// {
//   try {
//
//      $estatus =  new MotorBD();
//      $estatus->nombre = $request->nombre;
//      $estatus->cve_usuario = Auth::user()->id;
//      $estatus->save();
//
//
//     return array(
//       "exito" => true,
//       "titulo" => "Motor BD Agregado con éxito",
//       "mensaje" => "",
//       "style" => "success",
//       "icon" => "check"
//     );
//
//   } catch (\Exception $e) {
//     $mensaje = "Lo sentimos, ha ocurrido un error al registrar la nueva Motor BD";
//     return array(
//       "exito" => false,
//       "mensaje" => $mensaje,
//       "style" => "warning",
//       "titulo" => "Ocurrió un problema al registrar el Estatus",
//       "icon" => 'info',
//         "e" => $e->getMessage()
//     );
//   }
//
// }
//
// /**
//  * Show the specified resource.
//  * @return Response
//  */
// public function show($id)
// {
//
// }
//
// /**
//  * Show the form for editing the specified resource.
//  * @return Response
//  */
// public function edit($id)
// {
//     $data['motorbd'] = MotorBD::find($id);
//     return view('sitiservicios::catalogos.motorbd.create')->with($data);
//
// }
//
// /**
//  * Update the specified resource in storage.
//  * @param  Request $request
//  * @return Response
//  */
// public function update(Request $request,$id)
// {
//
//
//   try {
//     $estatus = MotorBD::find($id);
//     $estatus->fill($request->all());
//     $estatus->save();
//
//     return array(
//       "exito" => true,
//       "titulo" => "Motor BD Actualizado con éxito",
//       "mensaje" => "",
//       "style" => "success",
//       "icon" => "check"
//     );
//
//   } catch (\Exception $e) {
//     $mensaje = "Lo sentimos, ha ocurrido un error al actualizar  Motor BD";
//     return array(
//       "exito" => false,
//       "mensaje" => $mensaje,
//       "style" => "warning",
//       "titulo" => "Ocurrió un problema al actualizar el Estatus",
//       "icon" => 'info',
//         "e" => $e->getMessage()
//     );
//   }
//
//
//
//
// }
//
// /**
// * Remove the specified resource from storage.
// * @return Response
// */
// public function destroy($id)
// {
//   try {
//     $estatus = MotorBD::find($id);
//     $estatus->activo = 0;
//     $estatus->save();
//     return array(
//       "exito" => true,
//       "titulo" => "Motor BD eliminado con éxito",
//       "mensaje" => "",
//       "style" => "success",
//       "icon" => "check"
//     );
//   } catch (\Exception $e) {
//     return array(
//       "exito" => false,
//       "mensaje" => "Ha ocurrido un error al eliminar Motor BD",
//       "style" => "warning",
//       "titulo" => "Ocurrió un problema al crear  Motor BD",
//       "icon" => 'info',
//       "e" => $e->getMessage()
//     );
//   }
//
//
// }
//
//
// public function tablaMotorBD(){
//   //dd('enteo');
//   setlocale(LC_TIME, 'es_MX.UTF-8');
//   // \DB::statement("SET lc_time_names = 'es_ES'");
//   $estatus = MotorBD::where('activo',1)->get();
//   //$estatus = Estatus::all();
//
//   // dd($firmas);
//   $datatable = DataTables::of($estatus)
//
//   ->make(true);
//
//   //Cueri
//   $data = $datatable->getData();
//   foreach ($data->data as $key => $value) {
//     $acciones = [
//       "Editar" => [
//         "icon" => "edit blue",
//         "href" => "/sitiservicios/catalogos/motorbd/$value->cve_motor_bd/edit"
//       ],
//
//       /*"Ver detalles" => [
//         "icon" => "eye teal",
//         "href" => "/sitiservicios/catalogos/laboral/$value->cve_cat_modulo/show"
//       ],*/
//       "Eliminar" => [
//         "icon" => "trash red",
//         "onclick" => "eliminar('$value->cve_motor_bd')"
//       ],
//       // "Reactivar" => [
//       //   "icon" => "trash red",
//       //   "onclick" => "reactivar('$value->cve_estatus')"
//       // ]
//     ];
//     // if ($value->status == 2) {
//     //   unset($acciones['Prestar']);
//     // }
//     //
//     /*
//     if ( !permiso('ms021', 'Editar Firma') ) {
//       unset($acciones['Editar']);
//     }
//     if ( !permiso('ms021', 'Detalle Firma') ) {
//       unset($acciones['Ver detalles']);
//     }
//     if ( !permiso('ms021', 'Eliminar Firma') ) {
//       unset($acciones['Eliminar']);
//     }*/
//     $value->acciones = ( count($acciones) == 0 ) ? "" : generarDropdown($acciones);
//   }
//   $datatable->setData($data);
//   return $datatable;
// }
}
