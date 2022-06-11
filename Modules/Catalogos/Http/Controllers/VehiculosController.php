<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \Modules\Catalogos\Entities\Vehiculos;


use \DB;
class VehiculosController extends Controller
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
        return view('catalogos::vehiculos.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('catalogos::vehiculos.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {


        $vehiculos = new Vehiculos();
        $vehiculos->num_oficial = $request->num_oficial;
        $vehiculos->marca = $request->marca;
        $vehiculos->modelo = $request->modelo;
        $vehiculos->tipo = $request->tipo;
        $vehiculos->placas = $request->placas;
        $vehiculos->cilindraje = $request->cilindraje;
        $vehiculos->cve_usuario = Auth::user()->id;
        $vehiculos->save();

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
        return view('catalogos::vehiculos.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['vehiculos'] = Vehiculos::find($id);
        return view('catalogos::vehiculos.create')->with($data);
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

          $vehiculos =  Vehiculos::find($request->id);
          $vehiculos->num_oficial = $request->num_oficial;
          $vehiculos->marca = $request->marca;
          $vehiculos->modelo = $request->modelo;
          $vehiculos->tipo = $request->tipo;
          $vehiculos->placas = $request->placas;
          $vehiculos->cilindraje = $request->cilindraje;
          $vehiculos->cve_usuario = Auth::user()->id;
          $vehiculos->save();
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
          $vehiculos = Vehiculos::find($request->id);
          $vehiculos->activo = 0;
          $vehiculos->save();
          return response()->json(['success'=>'Eliminado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    public function ExisteVehiculo(Request $request){
      $vehiculos = Vehiculos::where([['activo',1],['num_oficial',$request->numero]])->first();

      return $vehiculos;
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Vehiculos::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar vehiculos','eliminar vehiculos'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/vehiculos/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];
      }else if(Auth::user()->can('eliminar vehiculos')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('editar vehiculos')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/vehiculos/$value->id/edit"
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
