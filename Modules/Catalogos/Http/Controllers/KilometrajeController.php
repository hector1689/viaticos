<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Localidad;
use \Modules\Catalogos\Entities\Kilometraje;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \DB;
class KilometrajeController extends Controller
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
        return view('catalogos::kilometraje.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      if (Auth::user()->tipo_usuario == 4) {
        $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
        $data['localidades'] = Localidad::where('activo',1)->get();
        return view('catalogos::kilometraje.create')->with($data);
      }else{
        $data['localidades'] = Localidad::where('activo',1)->get();
        return view('catalogos::kilometraje.create')->with($data);
      }

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
      //dd($request->all());

      if(isset($request->area)){
        $area = $request->area;
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
      }


      try {
        $kilometraje = new Kilometraje();
        $kilometraje->cve_localidad_origen = $request->origen;
        $kilometraje->cve_localidad_destino = $request->destino;
        $kilometraje->distancia_kilometros = $request->distancia;
        $kilometraje->id_dependencia = $area;
        $kilometraje->cve_usuario = Auth::user()->id;
        $kilometraje->save();

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
        return view('catalogos::kilometraje.show');
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
        $data['localidades'] = Localidad::where('activo',1)->get();
        $data['kilometraje'] = Kilometraje::find($id);
        return view('catalogos::kilometraje.create')->with($data);
      }else{
        $data['localidades'] = Localidad::where('activo',1)->get();
        $data['kilometraje'] = Kilometraje::find($id);
        return view('catalogos::kilometraje.create')->with($data);
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
        if(isset($request->area)){
          $area = $request->area;
        }else{
          $usuario = Auth::user()->id;
          $asociar = Asociar::where('id_usuario',$usuario)->first();
          $area = $asociar->id_dependencia;
        }

        $kilometraje = Kilometraje::find($request->id);
        $kilometraje->cve_localidad_origen = $request->origen;
        $kilometraje->cve_localidad_destino = $request->destino;
        $kilometraje->distancia_kilometros = $request->distancia;
        $kilometraje->id_dependencia = $area;
        $kilometraje->cve_usuario = Auth::user()->id;
        $kilometraje->save();

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
           $kilometraje = Kilometraje::find($request->id);
           $kilometraje->activo = 0;
           $kilometraje->save();
           return response()->json(['success'=>'Eliminado exitosamente']);
         } catch (\Exception $e) {
           dd($e->getMessage());
         }
     }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');
    if (Auth::user()->tipo_usuario == 4) {
      $registros = Kilometraje::where('activo', 1);
    }else{
      $usuario = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$usuario)->first();

      $registros = Kilometraje::where([['activo', 1],['id_dependencia',$asociar->id_dependencia]]);
    }

    $datatable = DataTables::of($registros)
    ->editColumn('cve_localidad_origen', function ($registros) {

      return $registros->obteneLocalidad->localidad.'-'.$registros->obteneLocalidad->obteneMunicipio->nombre.'-'.$registros->obteneLocalidad->obteneEstado->nombre.'-'.$registros->obteneLocalidad->obtenePais->nombre;
    })
    ->editColumn('cve_localidad_destino', function ($registros) {

      return $registros->obteneLocalidad2->localidad.'-'.$registros->obteneLocalidad2->obteneMunicipio->nombre.'-'.$registros->obteneLocalidad2->obteneEstado->nombre.'-'.$registros->obteneLocalidad2->obtenePais->nombre;
    })
    // ->editColumn('cve_pais', function ($registros) {
    //   $pais = Pais::find($registros->cve_pais);
    //   return $pais->nombre;
    // })
    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar kilometraje','eliminar kilometraje'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/kilometraje/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('eliminar kilometraje')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('editar kilometraje')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/kilometraje/$value->id/edit"
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
