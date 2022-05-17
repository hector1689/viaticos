<?php

namespace Modules\Recibos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use \Modules\Catalogos\Entities\Personal_Departamento;
use \Modules\Catalogos\Entities\Areas;

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
        //
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
                $id_est = $reg->id;
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

                }
            }
            if($nivel == 3) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                }
            }
            if($nivel == 4) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];
                }
            }
            if($nivel == 5) {
                $data = [];
                $regs = Areas::where([ ['activo', 1], ['id', $reg->id] ])->get();
                foreach ($regs as $key => $value) {
                    $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre, 'tipo' => $value->id_tipo ];

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
                  $datos [] = [ 'id' => $valuets->id, 'valor' => $valuets->id_padre, 'tipo' => $valuets->id_tipo ];
                  array_push($nivel1,$value->id);
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


        // $epale = ['nivel1' => $nivel1,'nivel2' => $nivel2,'nivel3'=> $nivel3,'nivel4'=> $nivel4];
        //$epale = ['nivel1' => $nivel1];


        return $areas = Areas::select('nombre','id_tipo')->where('activo',1)->whereIN('id',$nivel1)->get();

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
        return view('recibos::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
}
