<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use \Modules\Catalogos\Entities\Folios;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Catalogos\Entities\Personal_Siti;
use \Modules\Catalogos\Entities\TablaFolios;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use \DB;
use \App\Models\User;
class FolioController extends Controller
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

        return view('catalogos::folios.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {


      $data['usuarios'] = User::where([['activo',1]])->get();
      $data['areas'] = Areas::where([['activo',1],['id_tipo',1]])->get();
        return view('catalogos::folios.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      try {
        $folios = new Folios();
        $folios->dependencia = $request->dependencia;
        $folios->direccion_area = $request->direccion_area;
        $folios->director_administrativo = $request->director_administrativo;
        $folios->comisario = $request->comisario;
        $folios->superior_inmediato = $request->superior_inmediato;
        $folios->cve_usuario_inmediato = $request->usuarios;
        $folios->cve_usuario = Auth::user()->id;
        $folios->save();

        if(isset($request->array_table)){
          foreach ($request->array_table as $key => $value) {
            $foliost = new TablaFolios();
            $foliost->cve_folio = $folios->id;
            $foliost->tipo_folio = $value['tipo'];
            $foliost->foliador = $value['folio'];
            $foliost->cve_usuario = Auth::user()->id;
            $foliost->save();
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
    public function show($id)
    {
        return view('catalogos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
      $data['folios'] = Folios::find($id);
      $data['usuarios'] = User::where([['activo',1]])->get();
      $data['areas'] = Areas::where([['activo',1],['id_tipo',1]])->get();

      $data['tabla_folios'] = TablaFolios::where('cve_folio',$id)->get();

        return view('catalogos::folios.create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
      //dd($request->all());
      try {
        $folios = Folios::find($request->id);
        $folios->dependencia = $request->dependencia;
        $folios->direccion_area = $request->direccion_area;
        $folios->director_administrativo = $request->director_administrativo;
        $folios->comisario = $request->comisario;
        $folios->superior_inmediato = $request->superior_inmediato;
        $folios->cve_usuario_inmediato = $request->usuarios;
        $folios->cve_usuario = Auth::user()->id;
        $folios->save();

        if(isset($request->array_table)){
          foreach ($request->array_table as $key => $value) {
            $foliost = new TablaFolios();
            $foliost->cve_folio = $folios->id;
            $foliost->tipo_folio = $value['tipo'];
            $foliost->foliador = $value['folio'];
            $foliost->cve_usuario = Auth::user()->id;
            $foliost->save();
          }
        }

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
    public function destroy($id)
    {
        //
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    $registros = Folios::where('activo', 1); //Conocenos es la entidad
    $datatable = DataTables::of($registros)
    // ->editColumn('cve_tipo_gasolina', function ($registros) {
    //
    //   return $registros->obteneGasolina->nombre;
    // })

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      $acciones = [
         "Editar" => [
           "icon" => "edit blue",
           "href" => "/catalogos/folios/$value->id/edit"
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

  public function TraerEncargado(Request $request){
    $personal = Personal_Siti::where([
      ['activo',1],
      ['cve_cat_deptos_siti',$request->dependencia],
    ])->first();
    return $personal;
  }
}
