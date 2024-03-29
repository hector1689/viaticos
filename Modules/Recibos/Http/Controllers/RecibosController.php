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
use \Modules\Catalogos\Entities\Folios;
use \Modules\Catalogos\Entities\Zona;
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

      if (Auth::user()->tipo_usuario == 4) {
        $data['peajes'] = Peaje::where('activo',1)->get();
        $data['gasolina'] = Gasolina::where('activo',1)->orderBy('id','DESC')->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where('activo',1)->get();
        $data['taxi'] = Taxi::where('activo',1)->get();
        $data['lacalidad1'] = Kilometraje::select('cve_localidad_origen')->where('activo',1)->get();
        $data['lacalidad2'] = Kilometraje::where('activo',1)->get();
        $data['alimentos'] =  Alimentos::where('activo',1)->get();

        return view('recibos::create')->with($data);
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
        $data['alimentos'] =  Alimentos::where('activo',1)->get();
        $data['peajes'] = Peaje::where([['activo',1],['id_dependencia',$area]])->get();
        $data['gasolina'] = Gasolina::where([['activo',1],['id_dependencia',$area]])->orderBy('id','DESC')->get();
        //$data['rendimiento'] = Rendimiento::where([['activo',1],['id_dependencia',$area]])->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where([['activo',1],['id_dependencia',$area]])->get();
        $data['taxi'] = Taxi::where([['activo',1],['id_dependencia',$area]])->get();
        $data['lacalidad1'] = Kilometraje::where([['activo',1],['id_dependencia',$area]])->get();
        $data['lacalidad2'] = Kilometraje::where([['activo',1],['id_dependencia',$area]])->get();
        return view('recibos::create')->with($data);

      }

    }

    public function Destino(Request $request){
      //dd($request->all());

      $destino = Kilometraje::find($request->origen);

      $localidad = Localidad::where('id',$destino->cve_localidad_destino)->with('obtenePais','obteneEstado','obteneMunicipio')->first();
      return $localidad;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
    //dd($request->all());

    date_default_timezone_set('America/Mexico_city');

    try {
      list($fecha1,$hora1) = explode(" ",$request->inicia);
      list($dia,$mes,$anio) = explode('/',$fecha1);
      $fecha_incio = $anio.'-'.$mes.'-'.$dia.' '.$hora1;

      list($fecha2,$hora2) = explode(" ",$request->final);
      list($dia2,$mes2,$anio2) = explode('/',$fecha2);
      $fecha_final = $anio2.'-'.$mes2.'-'.$dia2.' '.$hora2;

      /////////////////////////////////////////////////////////////////////////

      $soloNiv2 = false; $tabla = 0;
        $reg = Areas::find($request->area_id);

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

        // $nieveles = sort($nivel1);
        //dd($nivel1);
      /////////////////////////////////////////////////////////////////////////
      $folio_comision ='';
      $folio ='';

      $existe_folio = Recibos::where([['activo',1],['folio','!=','NULL']])->orderBy('id','DESC')->first();
      //dd($existe_folio);
        if (isset($existe_folio)) {

          $existe_folio_ultimos = Recibos::where([['activo',1],['folio','!=','NULL']])->orderBy('id','ASC')->first();

          $existe_folio_ultimo = Recibos::where([['activo',1],['oficio_comision','!=','NULL']])->orderBy('id','ASC')->first();

          // dd($existe_folio_ultimos,$existe_folio_ultimo);
          if(isset($existe_folio_ultimo)){

            $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
            ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',1]])->first();
            //->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',1]])->whereIN('cat_folios.dependencia',$nivel1)->first();


            if ($folio_existes == null) {
              $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
              ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',1]])->whereIN('cat_folios.dependencia',$nivel1)->first();
              //dd('entro a buscar el primero que encuentre');

              if ($existe_folio_ultimos->folio != $folio_existes->foliador) {
                $foliots = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                //->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.foliador',$existe_folio_ultimos->folio]])->first();
                ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',1]])->whereIN('cat_folios.dependencia',$nivel1)->first();

                //dd($foliots);
                if (isset($foliots)) {
                  list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio->folio);
                  $sumafolio = $paso4 + 1;
                  $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                  $folio = $folio_completo;

                }else{
                  $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                  //->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',1]])->first();
                  ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',1]])->whereIN('cat_folios.dependencia',$nivel1)->first();

                    $existe_folio_existente = Recibos::where([['activo',1],['folio',$folio_existes->foliador]])->orderBy('id','ASC')->first();
                  //list($paso1,$paso2,$paso3,$paso4) = explode('/',$folio_existes->foliador);
                  // $sumafolio = $paso4 + 1;
                  // $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                  // dd($folio_existes,$existe_folio_existente);
                  if (isset($existe_folio_existente)) {
                    //dd($existe_folio_existente->folio);
                    list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio_existente->folio);
                    $sumafolio = $paso4 + 1;
                    $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                    $folio = $folio_completo;
                    //dd($folio);

                  }else{
                    $folio = $folio_existes->foliador;
                  }
                }

              }else{
                list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio->folio);
                $sumafolio = $paso4 + 1;
                $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                $folio = $folio_completo;
              }
            }else{
              //dd('entro a donde si hay');
              $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
              ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',1]])->first();

              if ($existe_folio_ultimos->folio != $folio_existes->foliador) {
                $foliots = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.foliador',$existe_folio_ultimos->folio]])->first();
                //dd(isset($foliots));
                if (isset($foliots)) {
                  list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio->folio);
                  $sumafolio = $paso4 + 1;
                  $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                  $folio = $folio_completo;

                }else{
                  $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                  ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',1]])->first();

                    $existe_folio_existente = Recibos::where([['activo',1],['folio',$folio_existes->foliador]])->orderBy('id','ASC')->first();
                  //list($paso1,$paso2,$paso3,$paso4) = explode('/',$folio_existes->foliador);
                  // $sumafolio = $paso4 + 1;
                  // $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                  // dd($folio_existes,$existe_folio_existente);
                  if (isset($existe_folio_existente)) {
                    //dd($existe_folio_existente->folio);
                    list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio_existente->folio);
                    $sumafolio = $paso4 + 1;
                    $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                    $folio = $folio_completo;
                    //dd($folio);

                  }else{
                    $folio = $folio_existes->foliador;
                  }
                }

              }else{
                list($paso1,$paso2,$paso3,$paso4) = explode('/',$existe_folio->folio);
                $sumafolio = $paso4 + 1;
                $folio_completo = $paso1.'/'.$paso2.'/'.$paso3.'/'.$sumafolio;
                $folio = $folio_completo;
              }
            }

            //////////////////////// FOLIO RECIBO /////////////////////////////////////////////////////////////////////
            //dd($existe_folio_ultimos->folio,$folio_existes->foliador);

          }
          /////////////////////////////////////////////////////////////////////
        //  dd(isset($existe_folio_ultimo));
          if(isset($existe_folio_ultimo)){

            $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
            ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',2]])->first();

            //dd($folio_existes2 == null);


            if ($folio_existes2 == null) {
              $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
              ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',2]])->whereIN('cat_folios.dependencia',$nivel1)->first();

              /////////////////////// FOLIO COMISION ////////////////////////////////////////////////////////
              //dd($request->area_id,$folio_existes2);
              //dd($existe_folio_ultimo->oficio_comision != $folio_existes2->foliador);
              if ($existe_folio_ultimo->oficio_comision != $folio_existes2->foliador) {
                //dd($existe_folio_ultimo->oficio_comision);
                $foliots2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                //->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.foliador',$folio_existes2->oficio_comision]])->first();
                ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',2]])->whereIN('cat_folios.dependencia',$nivel1)->first();

                //dd($foliots2);
                if (isset($foliots2)) {
                  //dd('ENTRO');
                  list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio->oficio_comision);
                  $sumafolio2 = $paso8 + 1;
                  $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                  $folio_comision = $folio_completo2;

                }else{
                //dd('ENTRO AQUI');
                  $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                  //->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',2]])->first();
                  ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_t_folios.tipo_folio',2]])->whereIN('cat_folios.dependencia',$nivel1)->first();

                  $existe_folio_existente2 = Recibos::where([['activo',1],['oficio_comision',$folio_existes2->foliador]])->orderBy('id','ASC')->first();
                  //dd($existe_folio_existente2);
                  if(isset($existe_folio_existente2)){

                    list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio_existente2->oficio_comision);
                    $sumafolio2 = $paso8 + 1;
                    $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                    $folio_comision = $folio_completo2;
                  }else{
                    $folio_comision = $folio_existes2->foliador;
                  }
                  // list($paso5,$paso6,$paso7,$paso8) = explode('/',$folio_existes2->foliador);
                  // $sumafolio2 = $paso8 + 1;
                  // $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;

                }
              }else{
                list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio->oficio_comision);
                $sumafolio2 = $paso8 + 1;
                $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                $folio_comision = $folio_completo2;
              }
            }else{
              $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
              ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',2]])->first();

              /////////////////////// FOLIO COMISION ////////////////////////////////////////////////////////
              //dd($request->area_id,$folio_existes2);
              //dd($existe_folio_ultimo->oficio_comision != $folio_existes2->foliador);
              if ($existe_folio_ultimo->oficio_comision != $folio_existes2->foliador) {
                //dd($existe_folio_ultimo->oficio_comision);
                $foliots2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.foliador',$folio_existes2->oficio_comision]])->first();
                //dd($foliots2);
                if (isset($foliots2)) {
                  //dd('ENTRO');
                  list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio->oficio_comision);
                  $sumafolio2 = $paso8 + 1;
                  $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                  $folio_comision = $folio_completo2;

                }else{
                //dd('ENTRO AQUI');
                  $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
                  ->where([['cat_folios.activo',1],['cat_t_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',2]])->first();

                  $existe_folio_existente2 = Recibos::where([['activo',1],['oficio_comision',$folio_existes2->foliador]])->orderBy('id','ASC')->first();
                  //dd($existe_folio_existente2);
                  if(isset($existe_folio_existente2)){

                    list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio_existente2->oficio_comision);
                    $sumafolio2 = $paso8 + 1;
                    $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                    $folio_comision = $folio_completo2;
                  }else{
                    $folio_comision = $folio_existes2->foliador;
                  }
                  // list($paso5,$paso6,$paso7,$paso8) = explode('/',$folio_existes2->foliador);
                  // $sumafolio2 = $paso8 + 1;
                  // $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;

                }
              }else{
                list($paso5,$paso6,$paso7,$paso8) = explode('/',$existe_folio->oficio_comision);
                $sumafolio2 = $paso8 + 1;
                $folio_completo2 = $paso5.'/'.$paso6.'/'.$paso7.'/'.$sumafolio2;
                $folio_comision = $folio_completo2;
              }
            }

          }


        //  dd($folio,$numero);
        }else{
          //dd('existe');
          $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
          ->where([['cat_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',1]])->first();


          $folio_existes2 = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
          ->where([['cat_folios.activo',1],['cat_folios.dependencia',$request->area_id],['cat_t_folios.tipo_folio',2]])->first();

          //dd($folio_existes,$folio_existes2,$request->area_id);

          $folio_comision = $folio_existes2->foliador;
          $numero = 1;
          $folio = $folio_existes->foliador;
        }



      //  dd($folio_comision,$folio);


        $recibo = new Recibos();
        $recibo->cve_estatus = 1;
        $recibo->folio = $folio;
        $recibo->oficio_comision = $folio_comision;
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



        if (isset($request->fecha_pago)) {
          list($dia,$mes,$anio) = explode('/',$request->fecha_pago);
          $fecha_pago = $anio.'-'.$mes.'-'.$dia;
          $datospago = new DatosPago();
          $datospago->cve_t_viatico = $recibo->id;
          $datospago->secretaria = $request->secretaria_pago;
          $datospago->num_cheque = $request->cheque;
          $datospago->fehca_inicia = $fecha_pago;
          $datospago->cantidad = $request->cantidad;
          $datospago->cantidad_letra = $request->letras_cantidad;
          $datospago->favor_cargo_banco = $request->banco;
          $datospago->cve_usuario = Auth::user()->id;
          $datospago->save();
        }else{

          $datospago = new DatosPago();
          $datospago->cve_t_viatico = $recibo->id;
          $datospago->secretaria = $request->secretaria_pago;
          $datospago->num_cheque = $request->cheque;
          //$datospago->fehca_inicia = $fecha_pago;
          $datospago->cantidad = $request->cantidad;
          $datospago->cantidad_letra = $request->letras_cantidad;
          $datospago->favor_cargo_banco = $request->banco;
          $datospago->cve_usuario = Auth::user()->id;
          $datospago->save();
        }


        //dd($request->VehiculoOficial[0]);
        $transporte = new Transporte();
        $transporte->kilometro_interno = $request->kilometrorecorrido;
        $transporte->cve_t_viatico = $recibo->id;
        $transporte->especificar_recorrido = $request->especificarcomision;
        $transporte->total_km_recorrido = $request->totalkm;
        $transporte->programavehiculo = $request->programavehiculof;
        $transporte->total_transporte = $request->total_transporte_vehiculof;
        $transporte->cve_usuario = Auth::user()->id;
        $transporte->save();



        if (isset($request->VehiculoOficial)) {
          foreach ($request->VehiculoOficial as $key => $value) {
            $vhof = new VehiculoOficial();
            $vhof->cve_t_transporte = $transporte->id;
            $vhof->numero_oficial = $value['num_oficial'];
            $vhof->tipo_transporte = $value['tipotransporte'];
            $vhof->tipo_viaje = $value['tipo_viaje'];
            $vhof->marca = $value['marca'];
            $vhof->modelo = $value['modelo'];
            $vhof->tipo = $value['tipo'];
            $vhof->placas = $value['placas'];
            $vhof->cilindraje = $value['cilindraje'];
            $vhof->cuota = $value['cuota'];
            $vhof->gasolina = $value['gasolina'];
            $vhof->mes_gasolina = $value['mes_gasolina'];
            $vhof->gasolina_vh_oficial = $value['gasolina_vehiculo'];
            $vhof->total_transporte = $value['total'];
            $vhof->cve_usuario = Auth::user()->id;
            $vhof->save();
          }
        }

        if (isset($request->Vehiculo)) {
          foreach ($request->Vehiculo as $key => $value) {
            $vh = new Vehiculo();
            $vh->cve_t_transporte = $transporte->id;
            $vh->tipo_transporte = $value['tipotransporte'];
            $vh->tipo_viaje = $value['tipo_viaje'];
            $vh->marca = $value['marca'];
            $vh->modelo = $value['modelo'];
            $vh->tipo = $value['tipo'];
            $vh->placas = $value['placas'];
            $vh->cilindraje = $value['cilindraje'];
            $vh->cuota = $value['cuota'];
            $vh->gasolina = $value['gasolina'];
            $vh->mes_gasolina = $value['mes_gasolina'];
            $vh->gasolina_vh_oficial = $value['gasolina_vehiculo'];
            $vh->total_transporte = $value['total'];
            $vh->cve_usuario = Auth::user()->id;
            $vh->save();
          }
        }

        //dd($request->Autobus,$request->Avion);

        if(isset($request->Autobus)){
          foreach ($request->Autobus as $key => $value) {

            $autobus = new Autobus();
            $autobus->cve_t_transporte = $transporte->id;
            $autobus->tipo_transporte = $value['tipotransporte'];
            $autobus->tipo_viaje = $value['tipo_viaje'];
            $autobus->costo_total = $value['costoAutobus'];
            $autobus->cve_usuario = Auth::user()->id;
            $autobus->save();
          }
        }

        if (isset($request->Avion)) {
          foreach ($request->Avion as $key => $value) {
            $avion = new Avion();
            $avion->cve_t_transporte = $transporte->id;
            $avion->tipo_viaje = $value['tipo_viaje'];
            $avion->costo_total = $value['costoAvion'];
            $avion->cve_usuario = Auth::user()->id;
            $avion->save();
          }
        }

        //dd($request->Peaje);
        if (isset($request->Peaje)) {
          foreach ($request->Peaje as $key => $value) {
            $peaje = new PeajeTransporte();
            $peaje->cve_peaje = $transporte->id;
            $peaje->cve_t_transporte = $value['tipotransporte'];
            $peaje->nombre = $value['peaje'];
            $peaje->costo = $value['costo'];
            $peaje->cve_usuario = Auth::user()->id;
            $peaje->save();
          }
        }

        if (isset($request->Recorrido)) {
          foreach ($request->Recorrido as $key => $value) {

            //dd($value);
            $taxi = new TaxiTransporte();
            $taxi->cve_t_transporte = $transporte->id;
            $taxi->clasificacion_recorrido = $value['region'];
            $taxi->name_calsificacion = $value['region_name'];
            $taxi->cve_kilometraje_origen = $value['recorrido1'];
            $taxi->name_kilometraje_origen = $value['name_recorrido'];
            $taxi->cve_kilometraje_destino = $value['recorrido2'];
            $taxi->name_kilometraje_destino = $value['name_recorrido2'];
            $taxi->dia_adicional = $value['dia_adicional'];
            $taxi->tarifa_evento = $value['tarifa_evento'];
            $taxi->terifa_evento2 = $value['tarifa_evento2'];
            $taxi->tarifa_adicional = $value['tarifa_adicional'];
            $taxi->tarifa_adicional2 = $value['tarifa_adicional2'];
            $taxi->cve_usuario = Auth::user()->id;
            $taxi->save();
          }
        }

        if (isset($request->valeCombustible)) {

          $transportex = Transporte::find($transporte->id);
          $transportex->valeCombustible = $request->valeCombustible[0];
          $transportex->save();
        }else{
          $transportex = Transporte::find($transporte->id);
          $transportex->valeCombustible = 0;
          $transportex->save();
        }

        if (isset($request->recibo_complentario_ticket)) {
          $recibox = Recibos::find($recibo->id);
          $recibox->recibo_complentario =$request->recibo_complentario_ticket[0];
          $recibox->cve_usuario = Auth::user()->id;
          $recibox->save();
        }


        //dd($request->tablalugares);
        foreach ($request->tablalugares as $key => $value) {

            $lugares = new Lugares();
            $lugares->remoto = 0;
            $lugares->cve_t_viatico = $recibo->id;
            $lugares->cve_localidad_origen = $value['lugar'][0]['origen'];
            $lugares->cve_localidad_destino = $value['lugar'][0]['origen'];
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


        $bitacora = new Bitacora();
        $bitacora->cve_t_viatico = $recibo->id;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->tarea = 'Alta Registro';
        $bitacora->cve_usuario = Auth::user()->id;
        $bitacora->save();



        return response()->json(['success'=>'Registro agregado satisfactoriamente']);

      } catch (\Exception $e) {
        dd($e->getMessage());
      }

    }

    public function edit($id)
    {

      if (Auth::user()->tipo_usuario == 4) {
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
        $data['gasolina'] = Gasolina::where('activo',1)->orderBy('id','DESC')->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where('activo',1)->get();
        $data['taxi'] = Taxi::where('activo',1)->get();
        $data['transporte'] = Transporte::where([['activo',1],['cve_t_viatico',$id]])->first();
        $data['vhoficial'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
        $data['vhoficialtabla'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
        $data['lacalidad1'] = Kilometraje::select('cve_localidad_origen')->where('activo',1)->get();
        $data['lacalidad2'] = Kilometraje::select('cve_localidad_destino')->where('activo',1)->get();
        $data['autobus'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
        $data['autobustabla'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
        $data['Vehiculo'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
        $data['Vehiculotabla'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
        $data['lugares'] = Lugares::where([
                              ['activo',1],
                              ['cve_t_viatico',$id],
                            ])->get();
        $data['lugares2'] = Lugares::where([
                              ['activo',1],
                              ['cve_t_viatico',$id],
                            ])->first();
        $data['taxi_t'] = TaxiTransporte::where([
                              ['activo',1],
                              ['cve_t_transporte',$data['transporte']->id],
                            ])->first();
        $data['taxi_t_tabla'] = TaxiTransporte::where([
                              ['activo',1],
                              ['cve_t_transporte',$data['transporte']->id],
                            ])->get();
        $data['peaje_t_tabla'] = PeajeTransporte::where([
                              ['activo',1],
                              ['cve_peaje',$data['transporte']->id],
                            ])->get();
        $data['avion_t_tabla'] = Avion::where([
                              ['activo',1],
                              ['cve_t_transporte',$data['transporte']->id],
                            ])->get();
                          //dd($data['peaje_t_tabla']);
        return view('recibos::create')->with($data);
      }else{
            $usuario = Auth::user()->id;
            $asociar = Asociar::where('id_usuario',$usuario)->first();
            $area = $asociar->id_dependencia;

            ///////////////////////////////////////////////////////////////////
            $data['recibos'] = Recibos::find($id);
            $data['estatus'] = EstatusRecibo::whereIN('id',[1])->get();


            $data['peajes'] = Peaje::where([['activo',1],['id_dependencia',$area]])->get();
            $data['gasolina'] = Gasolina::where([['activo',1],['id_dependencia',$area]])->orderBy('id','DESC')->get();
            //Rendimiento::where([['activo',1],['id_dependencia',$area]])->get();
            $data['rendimiento'] = Rendimiento::where('activo',1)->get();
            $data['programa'] = Programa::where([['activo',1],['id_dependencia',$area]])->get();
            $data['taxi'] = Taxi::where([['activo',1],['id_dependencia',$area]])->get();
            $data['lacalidad1'] = Kilometraje::where([['activo',1],['id_dependencia',$area]])->get();
            $data['lacalidad2'] = Kilometraje::where([['activo',1],['id_dependencia',$area]])->get();


            ///////////////////////////////////////////////////////////////////
            $data['pagos'] =   DatosPago::where([
                                  ['activo',1],
                                  ['cve_t_viatico',$id],
                                ])->first();
            $data['firmantes'] =   ReciboFirmantes::where([
                                  ['activo',1],
                                  ['cve_t_viaticos',$id],
                                ])->first();

            $data['bitacora'] =  Bitacora::where([
                                              ['activo',1],
                                              ['cve_t_viatico',$id],
                                            ])->get();
            $data['lugares'] = Lugares::where([
                                  ['activo',1],
                                  ['cve_t_viatico',$id],
                                ])->get();
            $data['lugares2'] = Lugares::where([
                                  ['activo',1],
                                  ['cve_t_viatico',$id],
                                ])->first();
            $data['transporte'] = Transporte::where([['activo',1],['cve_t_viatico',$id]])->first();
            $data['vhoficial'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
            $data['vhoficialtabla'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
            $data['autobus'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
            $data['autobustabla'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
            $data['Vehiculo'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
            $data['Vehiculotabla'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
            $data['taxi_t'] = TaxiTransporte::where([
                                  ['activo',1],
                                  ['cve_t_transporte',$data['transporte']->id],
                                ])->first();
            $data['taxi_t_tabla'] = TaxiTransporte::where([
                                  ['activo',1],
                                  ['cve_t_transporte',$data['transporte']->id],
                                ])->get();
            $data['peaje_t_tabla'] = PeajeTransporte::where([
                                  ['activo',1],
                                  ['cve_peaje',$data['transporte']->id],
                                ])->get();
            $data['avion_t_tabla'] = Avion::where([
                                  ['activo',1],
                                  ['cve_t_transporte',$data['transporte']->id],
                                ])->get();
                              //dd($data['peaje_t_tabla']);
            return view('recibos::create')->with($data);
      }

    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
      date_default_timezone_set('America/Mexico_city');
      try {
        list($fecha1,$hora1) = explode(" ",$request->inicia);
        list($dia,$mes,$anio) = explode('/',$fecha1);
        $fecha_incio = $anio.'-'.$mes.'-'.$dia.' '.$hora1;

        list($fecha2,$hora2) = explode(" ",$request->final);
        list($dia2,$mes2,$anio2) = explode('/',$fecha2);
        $fecha_final = $anio2.'-'.$mes2.'-'.$dia2.' '.$hora2;


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

          if (isset($request->fecha_pago)) {
            list($dia,$mes,$anio) = explode('/',$request->fecha_pago);
            $fecha_pago = $anio.'-'.$mes.'-'.$dia;
            $datospago = DatosPago::find($request->id_pagos);
            $datospago->secretaria = $request->secretaria_pago;
            $datospago->num_cheque = $request->cheque;
            $datospago->fehca_inicia = $fecha_pago;
            $datospago->cantidad = $request->cantidad;
            $datospago->cantidad_letra = $request->letras_cantidad;
            $datospago->favor_cargo_banco = $request->banco;
            $datospago->cve_usuario = Auth::user()->id;
            $datospago->save();
          }else{

          $datospago = DatosPago::find($request->id_pagos);
          $datospago->secretaria = $request->secretaria_pago;
          $datospago->num_cheque = $request->cheque;
          //$datospago->fehca_inicia = $fecha_pago;
          $datospago->cantidad = $request->cantidad;
          $datospago->cantidad_letra = $request->letras_cantidad;
          $datospago->favor_cargo_banco = $request->banco;
          $datospago->cve_usuario = Auth::user()->id;
          $datospago->save();

          }
          // if (isset($request->fecha_pago)) {
          //   // code...
          // }else{
          //   list($dia,$mes,$anio) = explode('/',$request->fecha_pago);
          //   $fecha_pago = $anio.'-'.$mes.'-'.$dia;
          //   $datospago = new DatosPago();
          //   $datospago->cve_t_viatico = $recibo->id;
          //   $datospago->secretaria = $request->secretaria_pago;
          //   $datospago->num_cheque = $request->cheque;
          //   $datospago->fehca_inicia = $fecha_pago;
          //   $datospago->cantidad = $request->cantidad;
          //   $datospago->cantidad_letra = $request->letras_cantidad;
          //   $datospago->favor_cargo_banco = $request->banco;
          //   $datospago->cve_usuario = Auth::user()->id;
          //   $datospago->save();
          // }

          $transporte = Transporte::find($request->id_transporte);
          $transporte->kilometro_interno = $request->kilometrorecorrido;
          $transporte->cve_t_viatico = $recibo->id;
          $transporte->especificar_recorrido = $request->especificarcomision;
          $transporte->total_km_recorrido = $request->totalkm;
          $transporte->programavehiculo = $request->programavehiculof;
          $transporte->total_transporte = $request->total_transporte_vehiculof;
          $transporte->cve_usuario = Auth::user()->id;
          $transporte->save();

          //total_extraer


          //dd($request->tablalugares);
          if (isset($request->tablalugares)) {
            foreach ($request->tablalugares as $key => $value) {

                $lugares = new Lugares();
                $lugares->remoto = 0;
                $lugares->cve_t_viatico = $recibo->id;
                $lugares->cve_localidad_origen = $value['lugar'][0]['origen'];
                $lugares->cve_localidad_destino = $value['lugar'][0]['origen'];
                $lugares->dias = $value['lugar'][6]['dias'];
                $lugares->cve_zona = $value['lugar'][4]['zona'];
                $lugares->kilometros = $value['lugar'][7]['kilometraje'];
                $lugares->cve_programa = $request->programalugar;
                $lugares->total_recibido = $request->total_extraer;
                $lugares->cve_usuario =Auth::user()->id;
                $lugares->save();

               Lugares::where([
                  ['activo',1],
                  ['cve_t_viatico',$recibo->id]
                ])->update([
                  'total_recibido' => $request->total_extraer,
                ]);
                //////////////// GASOLINA /////////////////////////////////
                if (isset($value['lugar'][8]['gasolina'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->combustible = $value['lugar'][8]['gasolina'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][9]['gasolina'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->combustible = $value['lugar'][9]['gasolina'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][10]['gasolina'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->combustible = $value['lugar'][10]['gasolina'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][11]['gasolina'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->combustible = $value['lugar'][11]['gasolina'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][12]['gasolina'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->combustible = $value['lugar'][12]['gasolina'];
                  $existe_lugar->save();
                }
                /////////////// HOSPEDAJE ///////////////////////////////////
                if (isset($value['lugar'][8]['hospedaje'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->hospedaje = $value['lugar'][8]['hospedaje'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][9]['hospedaje'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->hospedaje = $value['lugar'][9]['hospedaje'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][10]['hospedaje'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->hospedaje = $value['lugar'][10]['hospedaje'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][11]['hospedaje'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->hospedaje = $value['lugar'][11]['hospedaje'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][12]['hospedaje'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->hospedaje = $value['lugar'][12]['hospedaje'];
                  $existe_lugar->save();
                }

                ////////////////// COMIDA //////////////////////////////////
                if (isset($value['lugar'][8]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][8]['comida'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][9]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][9]['comida'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][10]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][10]['comida'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][11]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][11]['comida'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][10]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][10]['comida'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][12]['comida'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->comida = $value['lugar'][12]['comida'];
                  $existe_lugar->save();
                }

                /////////////////////// DESAYUNO ////////////////////
                if (isset($value['lugar'][8]['desayuno'])) {
                  //dd('entro');
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->desayuno = $value['lugar'][8]['desayuno'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][9]['desayuno'])) {
                  //dd('entro');
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->desayuno = $value['lugar'][9]['desayuno'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][10]['desayuno'])) {
                  //dd('entro');
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->desayuno = $value['lugar'][10]['desayuno'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][11]['desayuno'])) {
                  //dd('entro');
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->desayuno = $value['lugar'][11]['desayuno'];
                  $existe_lugar->save();
                }

                if (isset($value['lugar'][12]['desayuno'])) {
                  //dd('entro');
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->desayuno = $value['lugar'][12]['desayuno'];
                  $existe_lugar->save();
                }
                ////////////////// CENA //////////////////////////////////////
                if (isset($value['lugar'][8]['cena'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->cena = $value['lugar'][8]['cena'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][9]['cena'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->cena = $value['lugar'][9]['cena'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][10]['cena'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->cena = $value['lugar'][10]['cena'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][11]['cena'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->cena = $value['lugar'][11]['cena'];
                  $existe_lugar->save();
                }
                if (isset($value['lugar'][12]['cena'])) {
                  $existe_lugar = Lugares::find($lugares->id);
                  $existe_lugar->cena = $value['lugar'][12]['cena'];
                  $existe_lugar->save();
                }

            }
          }else{
            Lugares::where([
               ['activo',1],
               ['cve_t_viatico',$recibo->id]
             ])->update([
               'total_recibido' => $request->total_extraer,
             ]);
          }



          if (isset($request->VehiculoOficial)) {
            foreach ($request->VehiculoOficial as $key => $value) {
              $vhof = new VehiculoOficial();
              $vhof->cve_t_transporte = $transporte->id;
              $vhof->numero_oficial = $value['num_oficial'];
              $vhof->tipo_transporte = $value['tipotransporte'];
              $vhof->tipo_viaje = $value['tipo_viaje'];
              $vhof->marca = $value['marca'];
              $vhof->modelo = $value['modelo'];
              $vhof->tipo = $value['tipo'];
              $vhof->placas = $value['placas'];
              $vhof->cilindraje = $value['cilindraje'];
              $vhof->cuota = $value['cuota'];
              $vhof->gasolina = $value['gasolina'];
              $vhof->mes_gasolina = $value['mes_gasolina'];
              $vhof->gasolina_vh_oficial = $value['gasolina_vehiculo'];
              $vhof->cve_usuario = Auth::user()->id;
              $vhof->save();
            }
          }

          if (isset($request->Vehiculo)) {
            foreach ($request->Vehiculo as $key => $value) {
              $vh = new Vehiculo();
              $vh->cve_t_transporte = $transporte->id;
              $vh->tipo_transporte = $value['tipotransporte'];
              $vh->tipo_viaje = $value['tipo_viaje'];
              $vh->marca = $value['marca'];
              $vh->modelo = $value['modelo'];
              $vh->tipo = $value['tipo'];
              $vh->placas = $value['placas'];
              $vh->cilindraje = $value['cilindraje'];
              $vh->cuota = $value['cuota'];
              $vh->gasolina = $value['gasolina'];
              $vh->mes_gasolina = $value['mes_gasolina'];
              $vh->gasolina_vh_oficial = $value['gasolina_vehiculo'];
              $vh->cve_usuario = Auth::user()->id;
              $vh->save();
            }
          }

          //dd($request->Autobus,$request->Avion);

          if(isset($request->Autobus)){
            foreach ($request->Autobus as $key => $value) {

              $autobus = new Autobus();
              $autobus->cve_t_transporte = $transporte->id;
              $autobus->tipo_transporte = $value['tipotransporte'];
              $autobus->tipo_viaje = $value['tipo_viaje'];
              $autobus->costo_total = $value['costoAutobus'];
              $autobus->cve_usuario = Auth::user()->id;
              $autobus->save();
            }
          }

          if (isset($request->Avion)) {
            foreach ($request->Avion as $key => $value) {
              $avion = new Avion();
              $avion->cve_t_transporte = $transporte->id;
              $avion->tipo_viaje = $value['tipo_viaje'];
              $avion->costo_total = $value['costoAvion'];
              $avion->cve_usuario = Auth::user()->id;
              $avion->save();
            }
          }


          if (isset($request->Peaje)) {
            foreach ($request->Peaje as $key => $value) {
              $peaje = new PeajeTransporte();
              $peaje->cve_peaje = $transporte->id;
              $peaje->cve_t_transporte = $value['tipotransporte'];
              $peaje->nombre = $value['peaje'];
              $peaje->costo = $value['costo'];
              $peaje->cve_usuario = Auth::user()->id;
              $peaje->save();
            }
          }

          if (isset($request->Recorrido)) {
            foreach ($request->Recorrido as $key => $value) {

              $taxi = new TaxiTransporte();
              $taxi->cve_t_transporte = $transporte->id;
              $taxi->clasificacion_recorrido = $value['region'];
              $taxi->name_calsificacion = $value['region_name'];
              $taxi->cve_kilometraje_origen = $value['recorrido1'];
              $taxi->name_kilometraje_origen = $value['name_recorrido'];
              $taxi->cve_kilometraje_destino = $value['recorrido2'];
              $taxi->name_kilometraje_destino = $value['name_recorrido2'];
              $taxi->dia_adicional = $value['dia_adicional'];
              $taxi->tarifa_evento = $value['tarifa_evento'];
              $taxi->terifa_evento2 = $value['tarifa_evento2'];
              $taxi->tarifa_adicional = $value['tarifa_adicional'];
              $taxi->tarifa_adicional2 = $value['tarifa_adicional2'];
              $taxi->cve_usuario = Auth::user()->id;
              $taxi->save();
            }
          }

          if (isset($request->valeCombustible)) {

            $transportex = Transporte::find($transporte->id);
            $transportex->valeCombustible = $request->valeCombustible[0];
            $transportex->save();
          }else{
            $transportex = Transporte::find($transporte->id);
            $transportex->valeCombustible = 0;
            $transportex->save();
          }


          if (isset($request->recibo_complentario_ticket)) {
            $recibox = Recibos::find($recibo->id);
            $recibox->recibo_complentario =$request->recibo_complentario_ticket[0];
            $recibox->cve_usuario = Auth::user()->id;
            $recibox->save();
          }






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
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function CambioDias(Request $request)
    {
      $lugares = Lugares::find($request->id);
      $lugares->dias = $request->dias;
      $lugares->save();

      return $lugares;
    }

    public function CambioKilometraje(Request $request)
    {
      $lugares = Lugares::find($request->id);
      $lugares->kilometros = $request->kilometraje;
      $lugares->save();

      return $lugares;
    }


    public function TresZonas(Request $request){


      if ($request->zona == 'C') {
        $zonita = 1;
      }else if($request->zona == 'E'){
        $zonita = 2;
      }else if($request->zona == 'M'){
        $zonita = 3;
      }

      $query  =  ("
      SELECT
      cat_kilometraje.id,
      cat_localidad.localidad,
      cat_municipios.nombre AS municipio,
      cat_estados.nombre AS estado,
      cat_paises.nombre AS pais
      FROM cat_kilometraje
      INNER JOIN cat_localidad ON cat_localidad.id = cat_kilometraje.cve_localidad_origen
      INNER JOIN cat_paises ON cat_paises.id = cat_localidad.cve_pais
      INNER JOIN cat_estados ON cat_estados.id = cat_localidad.cve_estado
      INNER JOIN cat_municipios ON cat_municipios.id = cat_localidad.cve_municipio
      WHERE cat_kilometraje.activo = 1 AND cat_localidad.activo = 1 AND cat_kilometraje.id_zona = $zonita
      ");

      $zonas = DB::select($query);


      //$zonas = kilometraje::where([['activo',1],['id_zona',$zonita]])->with('obteneLocalidad','obteneLocalidad2','obtenerZona','obtenerDependencia')->get();



      return $zonas;
    }

    public function traerZonaNombre(Request $request){

    }


    public function TraerDatosViaticoLugar(Request $request){
      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id]])->get();


      return $lugares;
    }

    public function TraerBorrarDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->activo = 0;
      $lugar->save();



      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerGasolinaDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->combustible = $request->gasolina;
      $lugar->save();

      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerHospedajeDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->hospedaje = $request->hospedaje;
      $lugar->save();

      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerDesayunoDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->desayuno = $request->desayuno;
      $lugar->save();

      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerComidaDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->comida = $request->comida;
      $lugar->save();

      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerCenaDatosViaticoLugar(Request $request){
      $lugar = Lugares::find($request->id);
      $lugar->cena = $request->cena;
      $lugar->save();

      $lugares = Lugares::where([['activo',1],['cve_t_viatico',$request->id_recibo]])->get();
      return $lugares;
    }

    public function TraerGasolinaL(Request $request){

      if (Auth::user()->tipo_usuario == 4) {
        $gasolina = Gasolina::where('activo',1)->orderBy('id','DESC')->first();
        return $gasolina;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
        $gasolina = Gasolina::where([['activo',1],['id_dependencia',$area]])->orderBy('id','DESC')->first();
        return $gasolina;
      }


    }

    public function TraerHospedajeL(Request $request){
      if (Auth::user()->tipo_usuario == 4) {
        $hospedaje = Hospedaje::orderBy('vigencia_final','DESC')->first();
        return $hospedaje;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        $hospedaje = Hospedaje::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia_final','DESC')->first();
        return $hospedaje;
      }

    }

    public function TraerDesayunoL(Request $request){
      if (Auth::user()->tipo_usuario == 4) {
        $alimentos = Alimentos::orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
        $alimentos = Alimentos::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }

    }

    public function TraerComidaL(Request $request){
      if (Auth::user()->tipo_usuario == 4) {
        $alimentos = Alimentos::orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        $alimentos = Alimentos::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }

    }

    public function TraerCenaL(Request $request){
      if (Auth::user()->tipo_usuario == 4) {
        $alimentos = Alimentos::orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        $alimentos = Alimentos::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia_final','DESC')->first();
        return $alimentos;
      }

    }



    public function recibo($id)
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

      if (Auth::user()->tipo_usuario == 4) {
        $data['peajes'] = Peaje::where('activo',1)->get();
        $data['gasolina'] = Gasolina::where('activo',1)->orderBy('id','DESC')->get();
        $data['rendimiento'] = Rendimiento::where('activo',1)->get();
        $data['programa'] = Programa::where('activo',1)->get();
        $data['taxi'] = Taxi::where('activo',1)->get();
      }else{
      $usuario = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$usuario)->first();
      $area = $asociar->id_dependencia;

      $data['peajes'] = Peaje::where([['activo',1],['id_dependencia',$area]])->get();
      $data['gasolina'] = Gasolina::where([['activo',1],['id_dependencia',$area]])->orderBy('id','DESC')->get();
      $data['rendimiento'] = Rendimiento::where([['activo',1],['id_dependencia',$area]])->get();
      $data['programa'] = Programa::where([['activo',1],['id_dependencia',$area]])->get();
      $data['taxi'] = Taxi::where([['activo',1],['id_dependencia',$area]])->get();

      }


      $data['transporte'] = Transporte::where([['activo',1],['cve_t_viatico',$id]])->first();
      $data['vhoficial'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['vhoficialtabla'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
      $data['lacalidad1'] = kilometraje::where('activo',1)->get();
      $data['lacalidad2'] = kilometraje::where('activo',1)->get();
      $data['autobus'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['autobustabla'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
      $data['Vehiculo'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['Vehiculotabla'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->get();
      $data['lugares'] = Lugares::where([
                            ['activo',1],
                            ['cve_t_viatico',$id],
                          ])->get();
      return view('recibos::recibo')->with($data);

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
      /////////////////////////////////////////////////////////////////////////



      // dd($data['recibos']->id_dependencia);
      // $folio_existes = Folios::join('cat_t_folios','cat_t_folios.cve_folio','cat_folios.id')
      // ->where([['cat_folios.activo',1],['cat_folios.dependencia',$data['recibos']->id_dependencia],['cat_t_folios.tipo_folio',1]])->first();
      //
      // $data['folio_oficio'] = $folio_existes->foliador;
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

      // $pdf = PDF::loadView('recibos::oficio', $data);
      // $pdf->setPaper(array(0,0,612.00, 790.00), 'portrait');
      // $pdf->setOptions(['enable_php' => true,'isHtml5ParserEnabled' => true,'isRemoteEnabled' => true]);
      //
      // $pdf->output();
      //
      // $namePdf = 'Oficio de Comisión.pdf';
      // return $pdf->download($namePdf);
      // return $pdf->stream();

      return view('recibos::oficio')->with($data);


    }

    public function especificacion(){
      return view('recibos::especificacion');

    }

    public function imprimir($id){
      $data['id'] = $id;
      $data['recibos'] = Recibos::find($id);
      $data['firmantes'] =   ReciboFirmantes::where([
                                  ['activo',1],
                                  ['cve_t_viaticos',$id],
                                ])->first();
      $data['pagos'] =   DatosPago::where([
                            ['activo',1],
                            ['cve_t_viatico',$id],
                          ])->first();
      $data['lugares'] = Lugares::where([
                            ['activo',1],
                            ['cve_t_viatico',$id],
                          ])->get();
      $data['rendimiento'] = Rendimiento::where('activo',1)->get();

      $data['transporte'] = Transporte::where([['activo',1],['cve_t_viatico',$id]])->first();
      $data['Vehiculoficial'] = VehiculoOficial::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['autobus'] = Autobus::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['vehiculo'] = Vehiculo::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['avion'] = Avion::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['taxi'] = TaxiTransporte::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      $data['peaje'] = PeajeTransporte::where([['activo',1],['cve_t_transporte',$data['transporte']->id]])->first();
      //dd($diasDiferencia);
      $bitacora = new Bitacora();
      $bitacora->cve_t_viatico = $id;
      $bitacora->fecha = date('Y-m-d H:i:s');
      $bitacora->tarea = 'Impresión Recibo';
      $bitacora->cve_usuario = Auth::user()->id;
      $bitacora->save();

      //$pdf = PDF::loadView('recibos::imprimir', $data);
      // $pdf->setPaper(array(0,0,612.00, 790.00), 'portrait');
      // $pdf->setOptions(['enable_php' => true,'isHtml5ParserEnabled' => true,'isRemoteEnabled' => true]);
      //
      // $pdf->output();
      //
      // $namePdf = 'Oficio de Comisión.pdf';
      // return $pdf->download($namePdf);
      // return $pdf->stream();
      return view('recibos::imprimir')->with($data);
    }
    public function especificacioncomision($id){
      $data['id'] = $id;
      $data['personal_comisionado'] = Personal_Departamento::where('activo',1)->get();

      if (Auth::user()->tipo_usuario == 4) {
        $data['localidades'] = Kilometraje::where([['activo',1]])->get();
      }else{
            $usuario = Auth::user()->id;
            $asociar = Asociar::where('id_usuario',$usuario)->first();
            $area = $asociar->id_dependencia;

            $data['localidades'] = Kilometraje::where([['activo',1],['id_dependencia',$area]])->get();
        }


      return view('recibos::especificarcomision')->with($data);
    }

    public function comprobantes($id){
      $data['recibos'] = Recibos::find($id);
      $data['estatus'] = EstatusRecibo::all();
      return view('recibos::comprobacion')->with($data);

    }

    // public function NivelAlimentacion(Request $request){
    //   $array_todo = [];
    //   $dato = $request->nivel;
    //
    //   $alimentoss = Alimentos::where('zona',$request->zona_trayectoria)->get();
    //   $array = [];
    //   $arrayid = [];
    //   $array2 = [];
    //   $arrayid2 = [];
    //   $array3 = [];
    //   $arrayid3 = [];
    //   $array_alimentos = [];
    //   foreach ($alimentoss as $key => $value) {
    //     //dd($value);
    //     array_push($arrayid,$value['id']);
    //
    //     foreach (range(1, 159) as $numero) {
    //       array_push($array,$numero);
    //     }
    //
    //     foreach (range(160, 189) as $numero) {
    //       array_push($array2,$numero);
    //     }
    //
    //     foreach (range(190, 199) as $numero) {
    //       array_push($array3,$numero);
    //     }
    //
    //
    //
    //   }
    //   //dd($array);
    //   if (array_search($dato,$array)) {
    //     $epale = 'existe';
    //     //dd($epale,$arrayid[0]);
    //     $alimentos = Alimentos::find($arrayid[0]);
    //     array_push($array_alimentos,$alimentos);
    //   }elseif(array_search($dato,$array2)){
    //     $epale = 'existe 2';
    //     //dd($epale);
    //
    //     $alimentos = Alimentos::find($arrayid[1]);
    //     array_push($array_alimentos,$alimentos);
    //   }elseif(array_search($dato,$array3)){
    //     $epale = 'existe 3';
    //     //dd($epale);
    //
    //     $alimentos = Alimentos::find($arrayid[2]);
    //     array_push($array_alimentos,$alimentos);
    //   }
    //
    //   dd($array_alimentos);
    //
    //
    //
    //
    // }

    public function AlimentacionTime(Request $request){

      // list($dias,$mes,$anio) = explode('/',$request->fecha);
      // $fechaActual = $anio.'-'.$mes.'-'.$dias;
      //dd($request->fecha);

      $array_todo = [];
      $dato = $request->nivel;

      $alimentoss = Alimentos::where('zona',$request->zona_trayectoria)->get();
      $array = [];
      $arrayid = [];
      $array2 = [];
      $arrayid2 = [];
      $array3 = [];
      $arrayid3 = [];
      $array_alimentos = [];
      foreach ($alimentoss as $key => $value) {
        //dd($value);
        array_push($arrayid,$value['id']);

        foreach (range(1, 159) as $numero) {
          array_push($array,$numero);
        }

        foreach (range(160, 189) as $numero) {
          array_push($array2,$numero);
        }

        foreach (range(190, 199) as $numero) {
          array_push($array3,$numero);
        }



      }
      //dd($array);
      if (array_search($dato,$array)) {
        //$epale = 'existe';
        //dd($epale,$arrayid[0]);
        $alimentos = Alimentos::find($arrayid[0]);
        array_push($array_alimentos,$alimentos);
      }elseif(array_search($dato,$array2)){
        //$epale = 'existe 2';
        //dd($epale);

        $alimentos = Alimentos::find($arrayid[1]);
        array_push($array_alimentos,$alimentos);
      }elseif(array_search($dato,$array3)){
        //$epale = 'existe 3';
        //dd($epale);

        $alimentos = Alimentos::find($arrayid[2]);
        array_push($array_alimentos,$alimentos);
      }

      ///////////////////////// HOSPEDAJE /////////////////////////////////////
      // if (Auth::user()->tipo_usuario == 4) {
      //   $hospedaje = Hospedaje::orderBy('vigencia_final','DESC')->first();
      // }else{
      //   $usuario = Auth::user()->id;
      //   $asociar = Asociar::where('id_usuario',$usuario)->first();
      //   $area = $asociar->id_dependencia;
      //   $hospedaje = Hospedaje::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia_final','DESC')->first();
      // }
      //dd($request->zona_trayectoria);
      // if ($request->zona_trayectoria == 'M') {
      //   $hospedaje = Hospedaje::where('activo',1)->get();
      // }else{
        $hospedaje = Hospedaje::where('zona',$request->zona_trayectoria)->get();
      // }

      //$hospedaje = Hospedaje::where('activo',1)->get();

      $array4 = [];
      $array5 = [];
      $array6 = [];
      $array_hospedaje = [];
      // foreach (range($hospedaje->rango_inicia, $hospedaje->rango_final) as $numeroh) {
      //   array_push($arrays,$numeroh);
      // }
      foreach ($hospedaje as $key => $valueh) {
        //dd($value);
        array_push($arrayid2,$valueh['id']);

        foreach (range(1, 159) as $numero2) {
          array_push($array4,$numero2);
        }

        foreach (range(160, 189) as $numero2) {
          array_push($array5,$numero2);
        }

        foreach (range(190, 199) as $numero2) {
          array_push($array6,$numero2);
        }

      }

      if (array_search($dato,$array4)) {
        $hospedaje = Hospedaje::find($arrayid2[0]);
        array_push($array_hospedaje,$hospedaje);
      }elseif(array_search($dato,$array5)){

        $hospedaje = Hospedaje::find($arrayid2[1]);
        array_push($array_hospedaje,$hospedaje);
      }elseif(array_search($dato,$array6)){

        $hospedaje = Hospedaje::find($arrayid2[2]);
        array_push($array_hospedaje,$hospedaje);
      }

      // if (array_search($dato,$arrays)) {
      //   $epale = 'existe';
      //   $hospedaje = Hospedaje::find($hospedaje->id);
      //   array_push($array_hospedaje,$hospedaje);
      // }else{
      //   $epale = 'no existe';
      //   $hospedaje = 0;
      //   array_push($array_hospedaje,$hospedaje);
      // }
      ///////////////////////// GASOLINA //////////////////////////////////////
      if (Auth::user()->tipo_usuario == 4) {
        $gasolina = Gasolina::orderBy('vigencia','DESC')->first();
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
        $gasolina = Gasolina::where([['activo',1],['id_dependencia',$area]])->orderBy('vigencia','DESC')->first();
      }
      /////////////////////////////////////////////////////////////////////////


      $kilometraje1 = kilometraje::find($request->origen_lugar);
      //$kilometraje2 = kilometraje::find($request->destino_lugar);

      /////////////////////////////////////////////////////////////////////////
      //dd($array_hospedaje);
      //$array_todo = ['alimentos' => $array_alimentos,'gasolina' => $gasolina,'hospedaje' => $array_hospedaje,'total_kilometraje1' => $kilometraje1->distancia_kilometros,'total_kilometraje2' => $kilometraje2->distancia_kilometros];
      $array_todo = ['alimentos' => $array_alimentos,'gasolina' => $gasolina,'hospedaje' => $array_hospedaje,'total_kilometraje1' => $kilometraje1->distancia_kilometros];

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

    public function borrarVHf(Request $request){
      $vhof = VehiculoOficial::find($request->id);
      $vhof->activo = 0;
      $vhof->save();

      $transporte = Transporte::find($vhof->cve_t_transporte);

      $resta_total = $transporte->total_transporte - $vhof->gasolina_vh_oficial;

      $transportes = Transporte::find($vhof->cve_t_transporte);
      $transportes->total_transporte = $resta_total;
      $transportes->save();

      return $transportes->total_transporte;
    }

    public function borrarVH(Request $request){
      $vh = Vehiculo::find($request->id);
      $vh->activo = 0;
      $vh->save();

      $transporte = Transporte::find($vh->cve_t_transporte);

      $resta_total = $transporte->total_transporte - $vh->gasolina_vh_oficial;

      $transportes = Transporte::find($vh->cve_t_transporte);
      $transportes->total_transporte = $resta_total;
      $transportes->save();

      return $transportes->total_transporte;
    }

    public function borrarAutob(Request $request){
      $autobs = Autobus::find($request->id);
      $autobs->activo = 0;
      $autobs->save();

      $transporte = Transporte::find($autobs->cve_t_transporte);

      $resta_total = $transporte->total_transporte - $autobs->costo_total;

      $transportes = Transporte::find($autobs->cve_t_transporte);
      $transportes->total_transporte = $resta_total;
      $transportes->save();

      return $transportes->total_transporte;
    }

    public function borrarAvion(Request $request){
      $avion = Avion::find($request->id);
      $avion->activo = 0;
      $avion->save();

      $transporte = Transporte::find($avion->cve_t_transporte);

      $resta_total = $transporte->total_transporte - $avion->costo_total;

      $transportes = Transporte::find($avion->cve_t_transporte);
      $transportes->total_transporte = $resta_total;
      $transportes->save();

      return $transportes->total_transporte;
    }

    public function borrarTaxi(Request $request){
      $taxi = TaxiTransporte::find($request->id);
      $taxi->activo = 0;
      $taxi->save();



      return response()->json(['success'=>'Registro eliminado satisfactoriamente']);
    }

    public function borrarPeaje(Request $request){
      $peaje = PeajeTransporte::find($request->id);
      $peaje->activo = 0;
      $peaje->save();

      $transporte = Transporte::find($peaje->cve_t_transporte);

      $resta_total = $transporte->total_transporte - $peaje->costo;

      $transportes = Transporte::find($peaje->cve_t_transporte);
      $transportes->total_transporte = $resta_total;
      $transportes->save();

      return $transportes->total_transporte;
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
      try {
        $folios = Recibos::find($request->id);
        $folios->activo = 0;
        $folios->save();

        return response()->json(['success'=>'Registro Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
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

    public function Turnar(Request $request){
      try {
          $recibos = Recibos::find($request->id);
          $recibos->cve_estatus = 8;
          $recibos->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $request->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Turnar Registro a Organo de Control';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          return response()->json(['success'=>'Turnado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }


    public function autorizar(Request $request){
      try {
          $recibos = Recibos::find($request->id);
          $recibos->cve_estatus = 9;
          $recibos->save();

          $bitacora = new Bitacora();
          $bitacora->cve_t_viatico = $request->id;
          $bitacora->fecha = date('Y-m-d H:i:s');
          $bitacora->tarea = 'Autorizo Registro';
          $bitacora->cve_usuario = Auth::user()->id;
          $bitacora->save();

          return response()->json(['success'=>'Autorizado exitosamente']);
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
    if($tipo_usuario == 4){
      $registros = Recibos::where('activo', 1);
    }else if($tipo_usuario == 1){


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

      $registros = Recibos::where([['activo', 1]])->whereIN('id_dependencia',$nivel1)->get();
    }elseif($tipo_usuario == 2){

      $id = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$id)->first();

      $registros = Recibos::where([
        ['activo', 1],
        ['id_dependencia',$asociar->id_dependencia]
      ])->get();
    }elseif($tipo_usuario == 3){
      $registros = Recibos::where([
        ['activo', 1],
        ['cve_estatus',8]
      ])->get();
    }



    $datatable = DataTables::of($registros)
    ->editColumn('cve_estatus', function ($registros) {

      return $registros->obtenerEstatus->nombre;
    })

    ->editColumn('created_at', function ($registros) {
      list($fecha,$hora) = explode(' ',$registros->created_at);


      list($anio,$mes,$dia) = explode('-',$fecha);
      $mes_fecha="";

      if($mes== 0){
        $mes_fecha = '';
        $fecha_entrega_formato = 'Sin registro';
      }
      if ($mes == 1) {
        $mes_fecha = 'ENERO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 2){
        $mes_fecha = 'FEBRERO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 3){
        $mes_fecha = 'MARZO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 4){
        $mes_fecha = 'ABRIL';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 5){
        $mes_fecha = 'MAYO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 6){
        $mes_fecha = 'JUNIO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 7){
        $mes_fecha = 'JULIO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 8){
        $mes_fecha = 'AGOSTO';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 9){
        $mes_fecha = 'SEPTIEMBRE';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 10){
        $mes_fecha = 'OCTUBRE';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 11){
        $mes_fecha = 'NOVIEMBRE';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;

      }elseif($mes == 12){
        $mes_fecha = 'DICIEMBRE';
        $fecha_entrega_formato = $dia.' DE '.$mes_fecha.' DEL '.$anio;
      }

    return $fecha_entrega_formato.' '.$hora;


    })
    ->editColumn('num_dias', function ($registros) {

      $lugarest = Lugares::where([
        ['activo',1],
        ['cve_t_viatico',$registros->id],
        ])->first();

      //dd($lugarest);

      if (isset($lugarest)) {
        $numero = '$'.number_format($lugarest->total_recibido, 2, '.', ',');
      }else{
        $numero = 0;
      }

      return $numero;
    })



    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if (Auth::user()->tipo_usuario == 4) {
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/recibos/$value->id/edit"
           ],
          //
          // "Ver" => [
          //   "icon" => "fas fa-circle",
          //   "href" => "/recibos/$value->id/show"
          // ],
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
          // "Imprimir Recibo" => [
          //   "icon" => "fas fa-circle",
          //   "href" => "/recibos/$value->id/imprimir"
          // ],
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
          "Turnar" => [
            "icon" => "fas fa-circle",
            "onclick" => "turnar($value->id)"
          ],
          "Autorizar" => [
            "icon" => "fas fa-circle",
            "onclick" => "autorizar($value->id)"
          ],
          "Eliminar" => [
            "icon" => "fas fa-circle",
            "onclick" => "eliminar($value->id)"
          ],
        ];
      }else if (Auth::user()->tipo_usuario == 1) {

        $recibo_existe = Recibos::where([
          ['activo',1],
          ['id',$value->id]
        ])->first();

        if ($recibo_existe->recibo_complentario == 0) {
          $acciones = [
             "Editar" => [
               "icon" => "edit blue",
               "href" => "/recibos/$value->id/edit"
             ],
            //
            // "Ver" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/show"
            // ],
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
            // "Recibo Complementario" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/recibo"
            // ],
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
            "Turnar" => [
              "icon" => "fas fa-circle",
              "onclick" => "turnar($value->id)"
            ],
            "Autorizar" => [
              "icon" => "fas fa-circle",
              "onclick" => "autorizar($value->id)"
            ],
            "Eliminar" => [
              "icon" => "fas fa-circle",
              "onclick" => "eliminar($value->id)"
            ],
          ];
        }else{
          $acciones = [
             "Editar" => [
               "icon" => "edit blue",
               "href" => "/recibos/$value->id/edit"
             ],
            //
            // "Ver" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/show"
            // ],
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
            "Turnar" => [
              "icon" => "fas fa-circle",
              "onclick" => "turnar($value->id)"
            ],
            "Autorizar" => [
              "icon" => "fas fa-circle",
              "onclick" => "autorizar($value->id)"
            ],
            "Eliminar" => [
              "icon" => "fas fa-circle",
              "onclick" => "eliminar($value->id)"
            ],
          ];
        }


        }elseif(Auth::user()->tipo_usuario == 2){

          $recibo_existe = Recibos::where([
            ['activo',1],
            ['id',$value->id]
          ])->first();

          if ($recibo_existe->recibo_complentario == 0) {
            $acciones = [
               "Editar" => [
                 "icon" => "edit blue",
                 "href" => "/recibos/$value->id/edit"
               ],

              // "Ver" => [
              //   "icon" => "fas fa-circle",
              //   "href" => "/recibos/$value->id/show"
              // ],
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
              "Turnar" => [
                "icon" => "fas fa-circle",
                "onclick" => "turnar($value->id)"
              ],
              "Eliminar" => [
                "icon" => "fas fa-circle",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }else{
            $acciones = [
               "Editar" => [
                 "icon" => "edit blue",
                 "href" => "/recibos/$value->id/edit"
               ],

              // "Ver" => [
              //   "icon" => "fas fa-circle",
              //   "href" => "/recibos/$value->id/show"
              // ],
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
              "Turnar" => [
                "icon" => "fas fa-circle",
                "onclick" => "turnar($value->id)"
              ],
              "Eliminar" => [
                "icon" => "fas fa-circle",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }



        }elseif(Auth::user()->tipo_usuario == 3){
          $acciones = [
             // "Editar" => [
             //   "icon" => "edit blue",
             //   "href" => "/recibos/$value->id/edit"
             // ],

            "Ver" => [
              "icon" => "fas fa-circle",
              "href" => "/recibos/$value->id/recibo"
            ],
            "Autorizar" => [
              "icon" => "fas fa-circle",
              "onclick" => "autorizar($value->id)"
            ],

            // "Finiquitar Provisional" => [
            //   "icon" => "fas fa-circle",
            //   "onclick" => "finiquitarP($value->id)"
            // ],
            // "Finiquitar" => [
            //   "icon" => "fas fa-circle",
            //   "onclick" => "finiquitar($value->id)"
            // ],
            // "Cancelar" => [
            //   "icon" => "fas fa-circle",
            //   "onclick" => "baja($value->id)"
            // ],
            // "Recibo Complementario" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/recibo"
            // ],
            // "Comprobaciones" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/comprobantes"
            // ],
            // "Imprimir Recibo" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/imprimir"
            // ],
            // "Oficio de Comisión" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/oficio"
            // ],
            // "Especificación de Comisión" => [
            //   "icon" => "fas fa-circle",
            //   "href" => "/recibos/$value->id/especificacioncomision"
            // ],
            // "Turnar" => [
            //   "icon" => "fas fa-circle",
            //   "onclick" => "turnar($value->id)"
            // ],

          ];
        }








      $value->acciones = generarDropdown($acciones);

    }
    $datatable->setData($data);
    return $datatable;
  }
}
