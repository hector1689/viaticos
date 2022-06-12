<?php

namespace Modules\Recibos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\Catalogos\Entities\Personal_Departamento;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Catalogos\Entities\Departamento_Firmantes;
use \Modules\Catalogos\Entities\Personal_Siti;
use \Modules\Catalogos\Entities\Kilometraje;
use \Modules\Catalogos\Entities\Gasolina;
use \Modules\Catalogos\Entities\Localidad;
use \Modules\Catalogos\Entities\Taxi;
use \Modules\Catalogos\Entities\Peaje;
use \Modules\Catalogos\Entities\Rendimiento;
use \Modules\Catalogos\Entities\Programa;
use \Modules\Catalogos\Entities\Alimentos;
use \Modules\Catalogos\Entities\Hospedaje;
use \Modules\Recibos\Entities\Comprobaciones;
use Illuminate\Support\Facades\Storage;
use \Modules\Recibos\Entities\Recibos;
use \Modules\Recibos\Entities\EstatusRecibo;
use \Modules\Recibos\Entities\ComisionEspecificar;
use \Modules\Recibos\Entities\ComisionAcreditados;
use \Modules\Recibos\Entities\ComisionPersonal;
use \Modules\Recibos\Entities\ComisionTelefono;
use \Modules\Recibos\Entities\ReciboFirmantes;
use \Modules\Recibos\Entities\Bitacora;
use \Modules\Recibos\Entities\DatosPago;
use \Modules\Recibos\Entities\Avion;
use \Modules\Recibos\Entities\Autobus;
use \Modules\Recibos\Entities\PeajeTransporte;
use \Modules\Recibos\Entities\TaxiTransporte;
use \Modules\Recibos\Entities\Transporte;
use \Modules\Recibos\Entities\Vehiculo;
use \Modules\Recibos\Entities\VehiculoOficial;
use \Modules\Recibos\Entities\Lugares;
use \Modules\Usuarios\Entities\Asociar;
/////////////////////////////////////////////////////////////////
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Luecano\NumeroALetras\NumeroALetras;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \DB;
use Auth;

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
        $data['peajes'] = Peaje::where('activo',1)->get();
        $data['gasolina'] = Gasolina::where('activo',1)->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where('activo',1)->get();
        $data['taxi'] = Taxi::where('activo',1)->get();
        $data['lacalidad1'] = Localidad::where('activo',1)->get();
        $data['lacalidad2'] = Localidad::where('activo',1)->get();

        return view('recibos::create')->with($data);
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
        $recibo->id_dependencia = $request->area_id;
        $recibo->num_dias_inhabiles = $request->n_dias_ina;
        $recibo->descripcion_comision = $request->descripcion;
        $recibo->importe =$request->total_extraer;
        $recibo->cve_usuario = Auth::user()->id;
        $recibo->save();


        $firmantes = new ReciboFirmantes();
        $firmantes->cve_t_viaticos = $recibo->id;
        $firmantes->director_area = $request->director_area_firma;
        $firmantes->organo_control = $request->organo_control_firma;
        $firmantes->director_administrativo = $request->director_administrativo_firma;
        $firmantes->recibi_cheque = $request->cheque_firma;
        $firmantes->superior_inmediato = $request->jefe_firma;
        $firmantes->cve_usuario = Auth::user()->id;
        $firmantes->save();

        list($dia,$mes,$anio) = explode('/',$request->fecha_pago);
        $fecha_pago = $anio.'-'.$mes.'-'.$dia;

        $datospago = new DatosPago();
        $datospago->cve_t_viatico = $recibo->id;
        $datospago->secretaria = $request->secretaria_pago;
        $datospago->num_cheque = $request->cheque;
        $datospago->fehca_inicia = $fecha_pago;
        $datospago->cantidad = $request->cantidad;
        $datospago->cantidad_letra = $request->letras_cantidad;
        $datospago->favor_cargo_banco = 'banco de mexico';
        $datospago->cve_usuario = Auth::user()->id;
        $datospago->save();


        $transporte = new Transporte();
        $transporte->kilometro_interno = $request->kilometrorecorrido;
        $transporte->cve_t_viatico = $recibo->id;
        $transporte->especificar_recorrido = $request->especificarcomision;
        $transporte->total_km_recorrido = $request->totalkm;
        $transporte->cve_usuario = Auth::user()->id;
        $transporte->save();




        $bitacora = new Bitacora();
        $bitacora->cve_t_viatico = $recibo->id;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->tarea = 'Alta Registro';
        $bitacora->cve_usuario = Auth::user()->id;
        $bitacora->save();

        //dd($request->tablalugares);
        foreach ($request->tablalugares as $key => $value) {

            $lugares = new Lugares();
            $lugares->remoto = 0;
            $lugares->cve_t_viatico = $recibo->id;
            $lugares->cve_localidad_origen = $value['lugar'][0]['origen'];
            $lugares->cve_localidad_destino = $value['lugar'][1]['destino'];
            $lugares->dias = $value['lugar'][6]['dias'];
            $lugares->cve_zona = $value['lugar'][4]['zona'];
            $lugares->kilometros = $value['lugar'][7]['kilometraje'];
            $lugares->cve_programa = $request->programalugar;
            $lugares->total_recibido = $request->total_extraer;
            $lugares->cve_usuario =Auth::user()->id;
            $lugares->save();






            if (isset($value['lugar'][8]['gasolina'])) {
              $existe_lugar = Lugares::find($lugares->id);
              $existe_lugar->combustible = $value['lugar'][8]['gasolina'];
              $existe_lugar->save();
            }

            if (isset($value['lugar'][9]['hospedaje'])) {
              $existe_lugar = Lugares::find($lugares->id);
              $existe_lugar->hospedaje = $value['lugar'][9]['hospedaje'];
              $existe_lugar->save();
            }

            if (isset($value['lugar'][11]['comida'])) {
              $existe_lugar = Lugares::find($lugares->id);
              $existe_lugar->comida = $value['lugar'][11]['comida'];
              $existe_lugar->save();
            }


            if (isset($value['lugar'][10]['desayuno'])) {
              //dd('entro');
              $existe_lugar = Lugares::find($lugares->id);
              $existe_lugar->desayuno = $value['lugar'][10]['desayuno'];
              $existe_lugar->save();
            }

            if (isset($value['lugar'][12]['cena'])) {
              $existe_lugar = Lugares::find($lugares->id);
              $existe_lugar->cena = $value['lugar'][12]['cena'];
              $existe_lugar->save();
            }






        }




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

    public function oficio($id){
      $data['id'] = $id;
      $data['recibos'] = Recibos::find($id);
      $data['firmantes'] =   ReciboFirmantes::where([
                            ['activo',1],
                            ['cve_t_viaticos',$id],
                          ])->first();
      $data['lugares'] = Lugares::where([
                            ['activo',1],
                            ['cve_t_viatico',$id],
                          ])->get();
      // return view('recibos::oficio')->with($data);

      $fechaEmision = Carbon::parse($data['recibos']->fecha_hora_salida);
      $fechaExpiracion = Carbon::parse($data['recibos']->fecha_hora_recibio);

      $diasDiferencia = $fechaExpiracion->diffInDays($fechaEmision);
      //dd($diasDiferencia);
      $bitacora = new Bitacora();
      $bitacora->cve_t_viatico = $id;
      $bitacora->fecha = date('Y-m-d H:i:s');
      $bitacora->tarea = 'Impresión Oficio';
      $bitacora->cve_usuario = Auth::user()->id;
      $bitacora->save();

      $pdf = PDF::loadView('recibos::oficio', $data);
      $pdf->setPaper(array(0,0,612.00, 790.00), 'portrait');
      $pdf->setOptions(['enable_php' => true,'isHtml5ParserEnabled' => true,'isRemoteEnabled' => true]);

      $pdf->output();

      $namePdf = 'Oficio de Comisión.pdf';
      return $pdf->download($namePdf);
      return $pdf->stream();


    }

    public function especificacion(){
      return view('recibos::especificacion');

    }

    public function imprimir(){
      return view('recibos::imprimir');

    }
    public function especificacioncomision($id){
      $data['id'] = $id;
      $data['personal_comisionado'] = Personal_Departamento::where('activo',1)->get();
      $data['localidades'] = Kilometraje::where('activo',1)->get();
      return view('recibos::especificarcomision')->with($data);
    }

    public function comprobantes($id){
      $data['recibos'] = Recibos::find($id);
      $data['estatus'] = EstatusRecibo::all();
      return view('recibos::comprobacion')->with($data);

    }

    public function AlimentacionTime(Request $request){

      // list($dias,$mes,$anio) = explode('/',$request->fecha);
      // $fechaActual = $anio.'-'.$mes.'-'.$dias;
      //dd($request->fecha);

      $array_todo = [];
      $dato = $request->nivel;
      //////////////////////// ALIMENTOS ///////////////////////////////////////
      $alimentos = Alimentos::orderBy('vigencia_final','Asc')->first();
      $array = [];
      $array_alimentos = [];
      foreach (range($alimentos->rango_inicia, $alimentos->rango_final) as $numero) {
        array_push($array,$numero);
      }

      if (array_search($dato,$array)) {
        $epale = 'existe';
        $alimentos = Alimentos::find($alimentos->id);
        array_push($array_alimentos,$alimentos);
      }else{
        $epale = 'no existe';
        $alimentos = 0;
        array_push($array_alimentos,$alimentos);
      }


      ///////////////////////// HOSPEDAJE /////////////////////////////////////
      $hospedaje = Hospedaje::orderBy('vigencia_final','Asc')->first();
      $arrays = [];
      $array_hospedaje = [];

      foreach (range($hospedaje->rango_inicia, $hospedaje->rango_final) as $numeroh) {
        array_push($arrays,$numeroh);
      }

      if (array_search($dato,$arrays)) {
        $epale = 'existe';
        $hospedaje = Hospedaje::find($hospedaje->id);
        array_push($array_hospedaje,$hospedaje);
      }else{
        $epale = 'no existe';
        $hospedaje = 0;
        array_push($array_hospedaje,$hospedaje);
      }
      ///////////////////////// GASOLINA //////////////////////////////////////
      $gasolina = Gasolina::orderBy('vigencia','Asc')->first();


      /////////////////////////////////////////////////////////////////////////

      $array_todo = ['alimentos' => $array_alimentos,'gasolina' => $gasolina,'hospedaje' => $array_hospedaje];

      return $array_todo;
      // $now = new Carbon();
      // $days = $now->diffInDays($request->fecha);
      // //dd($days);
      // return $days;
    }


    public function especificaciones($id,$especificacion,$comisionado,$telefono,$especificar,$recorrido,$municipio,$direccion){

      $datosacredita = explode(',', $especificacion);
      $datoscomisionado = explode(',', $comisionado);
      $datostelefono = explode(',', $telefono);

      $existe_comision = ComisionEspecificar::where([
        ['activo',1],
        ['cve_t_viaticos',$id],
      ])->first();

      if (isset($existe_comision)) {

        $comision = ComisionEspecificar::find($existe_comision->id);
        $comision->cve_t_viaticos = $id;
        $comision->especificar_comision = $especificar;
        $comision->recorrido_interno = $recorrido;
        $comision->cve_kilometraje = $municipio;
        $comision->direccion = $direccion;
        $comision->cve_usuario = Auth::user()->id;
        $comision->save();

        ComisionAcreditados::where([
          ['activo',1],
          ['cve_t_viatico',$id],
        ])->delete();

        foreach ($datosacredita as $key => $value) {
          $acreditados = new ComisionAcreditados();
          $acreditados->cve_t_viatico = $id;
          $acreditados->acreditado = $value;
          $acreditados->cve_usuario = Auth::user()->id;
          $acreditados->save();
        }

        ComisionPersonal::where([
          ['activo',1],
          ['cve_t_viatico',$id],
        ])->delete();

        foreach ($datoscomisionado as $key => $valuepersonal) {
          $personal = new ComisionPersonal();
          $personal->cve_t_viatico = $id;
          $personal->id_personal = $valuepersonal;
          $personal->cve_usuario = Auth::user()->id;
          $personal->save();
        }

        ComisionTelefono::where([
          ['activo',1],
          ['cve_t_viatico',$id],
        ])->delete();

        foreach ($datostelefono as $key => $valuetelefono) {
          $telefonos = new ComisionTelefono();
          $telefonos->cve_t_viatico = $id;
          $telefonos->telefono = $valuetelefono;
          $telefonos->cve_usuario = Auth::user()->id;
          $telefonos->save();
        }



      }else{
        $comision = new ComisionEspecificar();
        $comision->cve_t_viaticos = $id;
        $comision->especificar_comision = $especificar;
        $comision->recorrido_interno = $recorrido;
        $comision->cve_kilometraje = $municipio;
        $comision->direccion = $direccion;
        $comision->cve_usuario = Auth::user()->id;
        $comision->save();


        foreach ($datosacredita as $key => $value) {
          $acreditados = new ComisionAcreditados();
          $acreditados->cve_t_viatico = $id;
          $acreditados->acreditado = $value;
          $acreditados->cve_usuario = Auth::user()->id;
          $acreditados->save();
        }

        foreach ($datoscomisionado as $key => $valuepersonal) {
          $personal = new ComisionPersonal();
          $personal->cve_t_viatico = $id;
          $personal->id_personal = $valuepersonal;
          $personal->cve_usuario = Auth::user()->id;
          $personal->save();
        }

        foreach ($datostelefono as $key => $valuetelefono) {
          $telefonos = new ComisionTelefono();
          $telefonos->cve_t_viatico = $id;
          $telefonos->telefono = $valuetelefono;
          $telefonos->cve_usuario = Auth::user()->id;
          $telefonos->save();
        }
      }


      $bitacora = new Bitacora();
      $bitacora->cve_t_viatico = $id;
      $bitacora->fecha = date('Y-m-d H:i:s');
      $bitacora->tarea = 'Impresión Especificación de Comisición';
      $bitacora->cve_usuario = Auth::user()->id;
      $bitacora->save();

      $comision = ComisionEspecificar::find($comision->id);
      $data['comision'] = ComisionEspecificar::find($comision->id);
      //dd($data['comision']);

      $data['acreditados'] = ComisionAcreditados::where([['activo',1],['cve_t_viatico',$id]])->get();
      $data['Personal'] = ComisionPersonal::where([['activo',1],['cve_t_viatico',$id]])->get();
      $data['telefonos'] = ComisionTelefono::where([['activo',1],['cve_t_viatico',$id]])->get();


        $pdf = PDF::loadView('recibos::especificacion', $data);
        $pdf->setPaper(array(0,0,612.00, 790.00), 'portrait');
        $pdf->setOptions(['enable_php' => true,'isHtml5ParserEnabled' => true,'isRemoteEnabled' => true]);

        $pdf->output();

        $namePdf = 'Especificación Comisión - '.$comision->id.'.pdf';
        return $pdf->download($namePdf);
        return $pdf->stream();



      //dd($id,$datosacredita,$datoscomisionado,$datostelefono,$especificar,$recorrido,$municipio,$direccion);

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
        $data['firmantes'] =   ReciboFirmantes::where([
                              ['activo',1],
                              ['cve_t_viaticos',$id],
                            ])->first();

        $data['bitacora'] =  Bitacora::where([
                                          ['activo',1],
                                          ['cve_t_viatico',$id],
                                        ])->get();
        $data['pagos'] =   DatosPago::where([
                              ['activo',1],
                              ['cve_t_viatico',$id],
                            ])->first();
        $data['peajes'] = Peaje::where('activo',1)->get();
        $data['gasolina'] = Gasolina::where('activo',1)->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where('activo',1)->get();
        $data['taxi'] = Taxi::where('activo',1)->get();
        $data['transporte'] = Transporte::where([['activo',1],['cve_t_viatico',$id]])->first();
        $data['lacalidad1'] = Localidad::where('activo',1)->get();
        $data['lacalidad2'] = Localidad::where('activo',1)->get();
        $data['lugares'] = Lugares::where([
                              ['activo',1],
                              ['cve_t_viatico',$id],
                            ])->get();
        return view('recibos::create')->with($data);
    }


    public function TraerGasolina(Request $request){
      $gasolina =  Gasolina::find($request->id_gasolina);
      return $gasolina;
    }

    public function traerCuotaVehiculo(Request $request){

      $rendimiento = Rendimiento::find($request->cuota);
      return $rendimiento;
    }

    public function TraerPeaje(Request $request){
      $peaje = Peaje::find($request->id);
      return $peaje;
    }

    public function TraerRecorrido(Request $request){
      //dd($request->ids);
      $taxi = Taxi::where('activo',1)->whereIN('id',$request->ids)->get();
      return $taxi;
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
          $recibo->id_dependencia = $request->area_id;
          $recibo->importe =$request->total_extraer;
          $recibo->cve_usuario = Auth::user()->id;
          $recibo->save();


          $firmantes = ReciboFirmantes::find($request->id_firmante);
          $firmantes->director_area = $request->director_area_firma;
          $firmantes->organo_control = $request->organo_control_firma;
          $firmantes->director_administrativo = $request->director_administrativo_firma;
          $firmantes->recibi_cheque = $request->cheque_firma;
          $firmantes->superior_inmediato = $request->jefe_firma;
          $firmantes->cve_usuario = Auth::user()->id;
          $firmantes->save();

          list($dia,$mes,$anio) = explode('/',$request->fecha_pago);
          $fecha_pago = $anio.'-'.$mes.'-'.$dia;


          $datospago = DatosPago::find($request->id_pagos);
          $datospago->secretaria = $request->secretaria_pago;
          $datospago->num_cheque = $request->cheque;
          $datospago->fehca_inicia = $fecha_pago;
          $datospago->cantidad = $request->cantidad;
          $datospago->cantidad_letra = $request->letras_cantidad;
          $datospago->favor_cargo_banco = 'banco de mexico';
          $datospago->cve_usuario = Auth::user()->id;
          $datospago->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $recibo->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Editar Registro';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();


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

    public function cancelar(Request $request){
      try {
          $recibos = Recibos::find($request->id);
          $recibos->cve_estatus = 7;
          $recibos->motivo = $request->motivo;
          $recibos->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $request->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Cancelo Registro';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          return response()->json(['success'=>'Cancelado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    public function finiquitar(Request $request){
      try {
          $recibos = Recibos::find($request->id);
          $recibos->cve_estatus = 4;
          $recibos->motivo = $request->motivo;
          $recibos->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $request->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Finiquito Registro';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          return response()->json(['success'=>'Finiquitado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    public function finiquitarP(Request $request){
      try {
          $recibos = Recibos::find($request->id);
          $recibos->cve_estatus = 5;
          $recibos->motivo = $request->motivo;
          $recibos->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $request->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Finiquito Provicionalmente Registro';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          return response()->json(['success'=>'Finiquitado Provicionalmente exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }


    public function comprobar(Request $request){
      try {
        //dd($request->all());

        $archivo  = $request->file('archivos');
        $nombre_archivo = time().$archivo->getClientOriginalName();
        $archivo->move(public_path().'/storage/',$nombre_archivo);

        $comprobacion = new Comprobaciones();
        $comprobacion->cve_t_viatico = $request->id;
        $comprobacion->archivo = $nombre_archivo;
        $comprobacion->cve_usuario = Auth::user()->id;
        $comprobacion->save();

        $bitacora = new Bitacora();
        $bitacora->cve_t_viatico = $request->id;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->tarea = 'Agrego Comprobante';
        $bitacora->cve_usuario = Auth::user()->id;
        $bitacora->save();

        return response()->json(['success'=>'Archivo Agregado Exitosamente']);

      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }

    public function download($name){
      //dd($request->all());
      return response()->download(public_path('/storage/'.$name.''));
    }

    public function borrarComprobante(Request $request){
      try {
        $comprobacion = Comprobaciones::find($request->id);
        $comprobacion->activo = 0;
        $comprobacion->save();

        $bitacora = new Bitacora();
        $bitacora->cve_t_viatico = $request->id;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->tarea = 'Elimino Comprobante';
        $bitacora->cve_usuario = Auth::user()->id;
        $bitacora->save();

        return response()->json(['success'=>'Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
    }


    public function ConvertirLetras(Request $request){
      $formatter = new NumeroALetras();
      $formatter->conector = 'Y';
      return $formatter->toMoney($request->cantidad, 2, 'pesos', 'centavos');
    }

    public function tablaComprobacion(Request $request){
      setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");
      //dd('entro');
      $registros = Comprobaciones::where([['activo', 1],['cve_t_viatico',$request->id]]); //Conocenos es la entidad
      $datatable = DataTables::of($registros)
      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) {

        $acciones = [
          "Descargar" => [
            "icon" => "fas fa-circle",
            "href" => "/recibos/descargar/$value->archivo"
          ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];



        $value->acciones = generarDropdown($acciones);

      }
      $datatable->setData($data);
      return $datatable;
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');

    $tipo_usuario = Auth::user()->tipo_usuario;

    if($tipo_usuario == 1){
      $registros = Recibos::where('activo', 1);
    }else{
      $id = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$id)->first();

      $registros = Recibos::where([
        ['activo', 1],
        ['id_dependencia',$asociar->id_dependencia]
      ])->get();
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
}
