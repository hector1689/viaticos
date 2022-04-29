<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \Modules\Catalogos\Entities\Alimentos;


use \DB;
class AlimentacionController extends Controller
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
        return view('catalogos::alimentacion.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('catalogos::alimentacion.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {
        //dd($request->all());
        list($dia,$mes,$anio)=explode('/',$request->inicia);
          $fecha1 = $anio.'-'.$mes.'-'.$dia;

        list($dia2,$mes2,$anio2)=explode('/',$request->final);
          $fecha2 = $anio2.'-'.$mes2.'-'.$dia2;

        $alimentos = new Alimentos();
        $alimentos->rango_inicia = $request->rango_inicia;
        $alimentos->rango_final = $request->rango_final;
        $alimentos->importe_desayuno = $request->desayuno;
        $alimentos->importe_comida = $request->comida;
        $alimentos->importe_cena = $request->cena;
        $alimentos->vigencia_inicia = $fecha1;
        $alimentos->vigencia_final = $fecha2;
        $alimentos->cve_usuario = Auth::user()->id;
        $alimentos->save();

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
        return view('catalogos::alimentacion.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['alimentacion'] = Alimentos::find($id);
        return view('catalogos::alimentacion.create')->with($data);
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

          $alimentos =  Alimentos::find($request->id);
          $alimentos->rango_inicia = $request->rango_inicia;
          $alimentos->rango_final = $request->rango_final;
          $alimentos->importe_desayuno = $request->desayuno;
          $alimentos->importe_comida = $request->comida;
          $alimentos->importe_cena = $request->cena;
          $alimentos->vigencia_inicia = $fecha1;
          $alimentos->vigencia_final = $fecha2;
          $alimentos->cve_usuario = Auth::user()->id;
          $alimentos->save();
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
          $alimentos = Alimentos::find($request->id);
          $alimentos->activo = 0;
          $alimentos->save();
          return response()->json(['success'=>'Eliminado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Alimentos::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      $acciones = [
         "Editar" => [
           "icon" => "edit blue",
           "href" => "/catalogos/alimentacion/$value->id/edit"
         ],
        // "Ver" => [
        //   "icon" => "fas fa-circle",
        //   "href" => "/guardianes/conocenos/$value->id/show"
        // ],

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
}
