<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \Modules\Catalogos\Entities\Hospedaje;
use \Modules\Catalogos\Entities\Zona;
use \DB;
class HospedajeController extends Controller
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
        return view('catalogos::hospedaje.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['zonas'] = Zona::all();
        return view('catalogos::hospedaje.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {

          list($dia,$mes,$anio)=explode('/',$request->inicia);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;

          list($dia2,$mes2,$anio2)=explode('/',$request->final);
            $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

          $hospedaje = new Hospedaje();
          $hospedaje->rango_inicial = $request->rango_inicia;
          $hospedaje->rango_final = $request->rango_final;
          $hospedaje->cve_zona = $request->zona;
          $hospedaje->importe = $request->importe;
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
        return view('catalogos::hospedaje.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['zonas'] = Zona::all();
        $data['hospedaje'] = Hospedaje::find($id);
        return view('catalogos::hospedaje.create')->with($data);
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
        list($dia,$mes,$anio)=explode('/',$request->inicia);
          $fecha1 = $anio.'-'.$mes.'-'.$dia;

        list($dia2,$mes2,$anio2)=explode('/',$request->final);
          $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

        $hospedaje = Hospedaje::find($request->id);
        $hospedaje->rango_inicial = $request->rango_inicia;
        $hospedaje->rango_final = $request->rango_final;
        $hospedaje->cve_zona = $request->zona;
        $hospedaje->importe = $request->importe;
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
        $hospedaje = Hospedaje::find($request->id);
        $hospedaje->activo = 0;
        $hospedaje->save();
        return response()->json(['success'=>'Registro Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Hospedaje::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)
    ->editColumn('cve_zona', function ($registros) {

      return $registros->obtenerZona->nombre;
      })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      $tipo_usuario = Auth::user()->tipo_usuario;

      if($tipo_usuario == 4){
        if(Auth::user()->can(['editar hospedaje','eliminar hospedaje'])){
          $acciones = [
             "Editar" => [
               "icon" => "edit blue",
               "href" => "/catalogos/hospedaje/$value->id/edit"
             ],
            "Eliminar" => [
              "icon" => "edit blue",
              "onclick" => "eliminar($value->id)"
            ],
          ];
        }else if(Auth::user()->can('eliminar hospedaje')){
          $acciones = [
            "Eliminar" => [
              "icon" => "edit blue",
              "onclick" => "eliminar($value->id)"
            ],
          ];
        }else if(Auth::user()->can('editar hospedaje')){
          $acciones = [
             // "Editar" => [
             //   "icon" => "edit blue",
             //   "href" => "/catalogos/hospedaje/$value->id/edit"
             // ],
          ];
        }else{
          $acciones = [

          ];
        }
      }else{

        if(Auth::user()->can('editar hospedaje')){
          $acciones = [
             // "Editar" => [
             //   "icon" => "edit blue",
             //   "href" => "/catalogos/hospedaje/$value->id/edit"
             // ],
          ];
        }else{
          $acciones = [

          ];
        }
      }







      $value->acciones = generarDropdown($acciones);

    }
    $datatable->setData($data);
    return $datatable;
  }
}
