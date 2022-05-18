<?php

namespace Modules\Recibos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use \Modules\Catalogos\Entities\Personal_Departamento;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Catalogos\Entities\Departamento_Firmantes;
use \Modules\Catalogos\Entities\Personal_Siti;

use \Modules\Recibos\Entities\Recibos;
use \Modules\Recibos\Entities\EstatusRecibo;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \DB;
class RecibosController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        return view('recibos::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('recibos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      //dd($request->all());

    try {
      list($fecha1,$hora1) = explode(" ",$request->inicia);
      list($dia,$mes,$anio) = explode('/',$fecha1);
      $fecha_incio = $anio.'-'.$mes.'-'.$dia.' '.$hora1;

      list($fecha2,$hora2) = explode(" ",$request->final);
      list($dia2,$mes2,$anio2) = explode('/',$fecha2);
      $fecha_final = $anio2.'-'.$mes2.'-'.$dia2.' '.$hora2;


      $existe_folio = Recibos::where([['activo',1],['folio','!=','NULL']])->first();

        if (isset($existe_folio)) {
          $numero = $existe_folio->folio;

          $folio = $numero + 1;
        }else{
          $numero = 1;
          $folio = $numero;
        }


        $recibo = new Recibos();
        $recibo->cve_estatus = 1;
        $recibo->folio = $folio;
        $recibo->num_empleado = $request->n_empleado;
        $recibo->nombre = $request->nombre_empleado;
        $recibo->rfc = $request->rfc;
        $recibo->nivel = $request->nivel;
        $recibo->clave_departamental = $request->clave_departamental;
        $recibo->dependencia = $request->dependencia;
        $recibo->direccion = $request->direccion;
        $recibo->fecha_hora_salida = $fecha_incio;
        $recibo->fecha_hora_recibio = $fecha_final;
        $recibo->departamentos = $request->departamento;
        $recibo->lugar_adscripcion = $request->lugar_adscripcion;
        $recibo->num_dias = $request->n_dias;
        $recibo->num_dias_inhabiles = $request->n_dias_ina;
        $recibo->descripcion_comision = $request->descripcion;
        $recibo->cve_usuario = Auth::user()->id;
        $recibo->save();
        return response()->json(['success'=>'Registro agregado satisfactoriamente']);

      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show()
    {
        return view('recibos::show');
    }

    public function recibo()
    {
        return view('recibos::recibo');
    }

    public function oficio(){
      return view('recibos::oficio');

    }

    public function especificacion(){
      return view('recibos::especificacion');

    }

    public function imprimir(){
      return view('recibos::imprimir');

    }
    public function especificacioncomision(){
      return view('recibos::especificarcomision');

    }

    public function comprobantes(){
      return view('recibos::comprobacion');

    }

    public function TraerEmpleado(Request $request){
      $personal = Personal_Departamento::where([
        ['activo',1],
        ['numero_empleado',$request->n_empleado]
      ])->first();
      return $personal;
    }

    public function TraerNombreDependencia(Request $request) {
      $soloNiv2 = false; $tabla = 0;
        $reg = Areas::find($request->id);

        $id_reg = 0;
        $id_est = 0;
        $nivel1 = [];
        $nivel2 = [];
        $nivel3 = [];
        $nivel4 = [];
        $nivel5 = [];

        $data = null;
        if($reg) {
            $nivel  = $reg->nivel;


            $id_reg = ($tabla == 1) ? $reg->id : $reg->id_padre;   // cve_t_estructura;
            $id_est = $reg->id;
            //dd($id_reg,$id_est);
            if ($nivel == 1) {
                $id_reg = $reg->id;
                // $id_est = $reg->id;
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];
                    array_push($nivel1,$value->id);
                }
            }
            if($nivel == 2) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                    array_push($nivel1,$value->id);
                }
            }
            if($nivel == 3) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                    array_push($nivel1,$value->id);
                }
            }
            if($nivel == 4) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                    array_push($nivel1,$value->id);
                }
            }
            if($nivel == 5) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                    array_push($nivel1,$value->id);
                }
            }
        }
        //dd($data);
        if (isset($data)) {
          if ($data != '[]') {
            $datos = [];
            foreach ($data as $key => $values) {

              $regs = Areas::where([ ['activo', 1], ['id', $values['valor']] ])->get();

              foreach ($regs as $key => $valuets) {
                  // dd($regs,$values['valor'],$valuets->id);
                  $datos [] = [ 'id' => $valuets->id, 'valor' => $valuets->id_padre, 'tipo' => $valuets->id_tipo ];
                  array_push($nivel1,$values['valor']);
              }
            }
          }
        }


        if (isset($datos)) {
          if ($datos != '[]') {
            $dates = [];
            foreach ($datos as $key => $values) {

              $regs = Areas::where([ ['activo', 1], ['id', $values['valor']] ])->get();

              foreach ($regs as $key => $valuets) {
                  $dates [] = [ 'id' => $valuets->id, 'valor' => $valuets->id_padre , 'tipo' => $valuets->id_tipo];

                  array_push($nivel1,$valuets->id);
              }
            }
          }
        }

        if (isset($dates)) {
          if ($dates != '[]') {
            $datis = [];
            foreach ($dates as $key => $values) {

              $regs = Areas::where([ ['activo', 1], ['id', $values['valor']] ])->get();
              foreach ($regs as $key => $valuets) {
                  $datis [] = [ 'id' => $valuets->id, 'valor' => $valuets->id_padre , 'tipo' => $valuets->id_tipo ];
                  array_push($nivel1,$valuets->id);
              }
            }
          }
        }

        if (isset($datis)) {
          if ($datis != '[]') {
            $datus = [];
            foreach ($datis as $key => $values) {

              $regs = Areas::where([ ['activo', 1], ['id', $values['valor']] ])->get();
              foreach ($regs as $key => $valuets) {
                  $datus [] = [ 'id' => $valuets->id, 'valor' => $valuets->id_padre , 'tipo' => $valuets->id_tipo ];
                  array_push($nivel1,$valuets->id);
              }
            }
          }
        }


        //$epale = ['nivel1' => $nivel1];
        //var_dump($epale);
        //dd($data,$datos,$dates,$datis,$datus,$nivel1);
        //$epale = ['nivel1' => $nivel1];


        return $areas = Areas::select('id','nombre','id_tipo')->where('activo',1)->whereIN('id',$nivel1)->get();

        //dd($areas);
        //return array($id_reg, $id_est, $data);
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['recibos'] = Recibos::find($id);
        $data['estatus'] = EstatusRecibo::all();

        return view('recibos::create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
      try {
        list($fecha1,$hora1) = explode(" ",$request->inicia);
        list($dia,$mes,$anio) = explode('/',$fecha1);
        $fecha_incio = $anio.'-'.$mes.'-'.$dia.' '.$hora1;

        list($fecha2,$hora2) = explode(" ",$request->final);
        list($dia2,$mes2,$anio2) = explode('/',$fecha2);
        $fecha_final = $anio2.'-'.$mes2.'-'.$dia2.' '.$hora2;


        // $existe_folio = Recibos::where([['activo',1],['folio','!=','NULL']])->first();
        //
        //   if (isset($existe_folio)) {
        //     $numero = $existe_folio->folio;
        //
        //     $folio = $numero + 1;
        //   }else{
        //     $numero = 1;
        //     $folio = $numero;
        //   }
        //

          $recibo = Recibos::find($request->id);
          // $recibo->cve_estatus = 1;
          // $recibo->folio = $folio;
          $recibo->num_empleado = $request->n_empleado;
          $recibo->nombre = $request->nombre_empleado;
          $recibo->rfc = $request->rfc;
          $recibo->nivel = $request->nivel;
          $recibo->clave_departamental = $request->clave_departamental;
          $recibo->dependencia = $request->dependencia;
          $recibo->direccion = $request->direccion;
          $recibo->fecha_hora_salida = $fecha_incio;
          $recibo->fecha_hora_recibio = $fecha_final;
          $recibo->departamentos = $request->departamento;
          $recibo->lugar_adscripcion = $request->lugar_adscripcion;
          $recibo->num_dias = $request->n_dias;
          $recibo->num_dias_inhabiles = $request->n_dias_ina;
          $recibo->descripcion_comision = $request->descripcion;
          $recibo->cve_usuario = Auth::user()->id;
          $recibo->save();
          return response()->json(['success'=>'Registro agregado satisfactoriamente']);

        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function TraerFirmaJefes(Request $request){
      $firmantes = Departamento_Firmantes::where([
        ['activo',1],
        ['cve_area_departamentos',$request->id]
      ])->get();
      return $firmantes;
    }

    public function TraerJefe(Request $request){
      $jefe = Personal_Siti::where([
        ['activo',1],
        ['cve_cat_deptos_siti',$request->id]
      ])->first();
      return $jefe;
    }

    public function TraerJefeDirector(Request $request){
      $jefe = Personal_Siti::where([
        ['activo',1],
        ['id',$request->id]
      ])->first();
      return $jefe;
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Recibos::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)
    ->editColumn('cve_estatus', function ($registros) {

      return $registros->obtenerEstatus->nombre;
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


        // "Cancelar" => [
        //   "icon" => "edit blue",
        //   "onclick" => "eliminar($value->id)"
        // ],
      ];



      $value->acciones = generarDropdown($acciones);

    }
    $datatable->setData($data);
    return $datatable;
  }
}
