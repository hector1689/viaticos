<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Taxi;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \DB;
class TaxiController extends Controller
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
        return view('catalogos::taxi.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (Auth::user()->tipo_usuario == 4) {
          $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
          return view('catalogos::taxi.create')->with($data);
        }else{
          return view('catalogos::taxi.create');
        }


    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {

        if(isset($request->area)){
          $area = $request->area;
        }else{
          $usuario = Auth::user()->id;
          $asociar = Asociar::where('id_usuario',$usuario)->first();
          $area = $asociar->id_dependencia;
        }

        list($dia,$mes,$anio)=explode('/',$request->vigencia_inicial);
          $fecha1 = $anio.'-'.$mes.'-'.$dia;

        list($dia2,$mes2,$anio2)=explode('/',$request->vigencia_final);
          $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

        $hospedaje = new Taxi();
        $hospedaje->descripcion = $request->descripcion;
        $hospedaje->tarifa_evento = $request->tarifa_evento;
        $hospedaje->tarifa_adicional = $request->tarifa_adicional;
        $hospedaje->id_dependencia = $area;
        $hospedaje->vigencia_inicial = $fecha1;
        $hospedaje->vigencia_final = $fecha2;
        $hospedaje->cve_usuario =  Auth::user()->id;
        $hospedaje->save();

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
        return view('catalogos::taxi.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
      if (Auth::user()->tipo_usuario == 4) {
        $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
        $data['taxi'] = Taxi::find($id);
        return view('catalogos::taxi.create')->with($data);
      }else{
        $data['taxi'] = Taxi::find($id);
        return view('catalogos::taxi.create')->with($data);
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
        try {
          list($dia,$mes,$anio)=explode('/',$request->vigencia_inicial);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;

          list($dia2,$mes2,$anio2)=explode('/',$request->vigencia_final);
            $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

            if(isset($request->area)){
              $area = $request->area;
            }else{
              $usuario = Auth::user()->id;
              $asociar = Asociar::where('id_usuario',$usuario)->first();
              $area = $asociar->id_dependencia;
            }

          $hospedaje = Taxi::find($request->id);
          $hospedaje->descripcion = $request->descripcion;
          $hospedaje->tarifa_evento = $request->tarifa_evento;
          $hospedaje->tarifa_adicional = $request->tarifa_adicional;
          $hospedaje->id_dependencia = $area;
          $hospedaje->vigencia_inicial = $fecha1;
          $hospedaje->vigencia_final = $fecha2;
          $hospedaje->cve_usuario =  Auth::user()->id;
          $hospedaje->save();

          return response()->json(['success'=>'Ha sido editado con éxito']);

        } catch (\Exception $e) {
          dd($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
      try {
        $taxi = Taxi::find($request->id);
        $taxi->activo = 0;
        $taxi->save();
        return response()->json(['success'=>'Registro Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');



    if (Auth::user()->tipo_usuario == 4) {
      $registros = Taxi::where([['activo', 1]]);
    }else{
      $usuario = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$usuario)->first();

      $registros = Taxi::where([['activo', 1],['id_dependencia',$asociar->id_dependencia]]);
    }

    $datatable = DataTables::of($registros)
    // ->editColumn('cve_zona', function ($registros) {
    //
    //   return $registros->obtenerZona->nombre;
    //   })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar taxi','eliminar taxi'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/taxi/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];
      }else if(Auth::user()->can('eliminar taxi')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('editar taxi')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/taxi/$value->id/edit"
           ]

        ];
      }else{
        $acciones = [

        ];
      }





      $value->acciones = generarDropdown($acciones);

    }
    $datatable->setData($data);
    return $datatable;
  }
}
