<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Pais;
use \Modules\Catalogos\Entities\Estado;
use \Modules\Catalogos\Entities\Municipio;
use \Modules\Catalogos\Entities\Localidad;

use Yajra\Datatables\Datatables;
use \DB;
class LocalidadesController extends Controller
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
        return view('catalogos::localidades.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $data['paises'] = Pais::all();
        return view('catalogos::localidades.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {
        $localidad = new Localidad();
        $localidad->cve_pais = $request->pais;
        $localidad->cve_estado = $request->estado;
        $localidad->cve_municipio = $request->municipio;
        $localidad->localidad = $request->localidad;
        $localidad->cve_usuario = Auth::user()->id;
        $localidad->save();

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
        return view('catalogos::localidades.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['localidad'] = Localidad::find($id);
        $data['paises'] = Pais::all();
        return view('catalogos::localidades.create')->with($data);
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
        $localidad = Localidad::find($request->id);
        $localidad->cve_pais = $request->pais;
        $localidad->cve_estado = $request->estado;
        $localidad->cve_municipio = $request->municipio;
        $localidad->localidad = $request->localidad;
        $localidad->cve_usuario = Auth::user()->id;
        $localidad->save();

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
           $alimentos = Localidad::find($request->id);
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
    $registros = Localidad::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)
    ->editColumn('cve_municipio', function ($registros) {
        $municipio = Municipio::find($registros->cve_municipio);
      return $municipio->nombre;
    })
    ->editColumn('cve_estado', function ($registros) {
      $estado = Estado::find($registros->cve_estado);
      return $estado->nombre;
    })
    ->editColumn('cve_pais', function ($registros) {
      $pais = Pais::find($registros->cve_pais);
      return $pais->nombre;
    })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      $acciones = [
         "Editar" => [
           "icon" => "edit blue",
           "href" => "/catalogos/localidades/$value->id/edit"
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


    public function Estado(Request $request){
      $variable = Estado::where('id_pais',$request->pais)->get();
      return $variable;
    }


    public function Municipio(Request $request){
      $variable = Municipio::where('id_estado',$request->estado)->get();
      return $variable;
    }

    public function Estadoedit(Request $request){
      $variable = Estado::where('id',$request->estado)->first();
      return $variable;
    }


    public function Municipioedit(Request $request){
      $variable = Municipio::where('id',$request->municipio)->first();
      return $variable;
    }







}
