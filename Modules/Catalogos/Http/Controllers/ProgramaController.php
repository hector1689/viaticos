<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \Modules\Catalogos\Entities\Programa;


use \DB;
class ProgramaController extends Controller
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
        return view('catalogos::programa.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        return view('catalogos::programa.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {

        $programa = new Programa();
        $programa->nombre = $request->nombre;
        $programa->cve_usuario = Auth::user()->id;
        $programa->save();

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
        return view('catalogos::programa.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $data['programas'] = Programa::find($id);
        return view('catalogos::programa.create')->with($data);
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

          $programa =  Programa::find($request->id);
          $programa->nombre = $request->nombre;
          $programa->cve_usuario = Auth::user()->id;
          $programa->save();
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
          $programa = Programa::find($request->id);
          $programa->activo = 0;
          $programa->save();
          return response()->json(['success'=>'Eliminado exitosamente']);
        } catch (\Exception $e) {
          dd($e->getMessage());
        }
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Programa::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      $acciones = [
         "Editar" => [
           "icon" => "edit blue",
           "href" => "/catalogos/programa/$value->id/edit"
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
