<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Peaje;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \DB;
class PeajeController extends Controller
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
        return view('catalogos::peaje.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        if (Auth::user()->tipo_usuario == 4) {
          $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
          return view('catalogos::peaje.create')->with($data);
        }else{
          return view('catalogos::peaje.create');
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
        list($dia,$mes,$anio)=explode('/',$request->vigencia);
        $fecha1 = $anio.'-'.$mes.'-'.$dia;

        if(isset($request->area)){
          $area = $request->area;
        }else{
          $usuario = Auth::user()->id;
          $asociar = Asociar::where('id_usuario',$usuario)->first();
          $area = $asociar->id_dependencia;
        }


        $peaje = new Peaje();
        $peaje->ubicacion_peaje = $request->ubicacion_peaje;
        $peaje->costo = $request->costo;
        $peaje->vigencia = $fecha1;
        $peaje->id_dependencia = $area;
        $peaje->cve_usuario = Auth::user()->id;
        $peaje->save();

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
        return view('catalogos::peaje.show');
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
        $data['peaje'] = Peaje::find($id);
        return view('catalogos::peaje.create')->with($data);
      }else{
        $data['peaje'] = Peaje::find($id);
        return view('catalogos::peaje.create')->with($data);
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
        list($dia,$mes,$anio)=explode('/',$request->vigencia);
        $fecha1 = $anio.'-'.$mes.'-'.$dia;

        if(isset($request->area)){
          $area = $request->area;
        }else{
          $usuario = Auth::user()->id;
          $asociar = Asociar::where('id_usuario',$usuario)->first();
          $area = $asociar->id_dependencia;
        }

        $peaje = Peaje::find($request->id);
        $peaje->ubicacion_peaje = $request->ubicacion_peaje;
        $peaje->costo = $request->costo;
        $peaje->vigencia = $fecha1;
        $peaje->id_dependencia = $area;
        $peaje->cve_usuario = Auth::user()->id;
        $peaje->save();

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
           $peaje = Peaje::find($request->id);
           $peaje->activo = 0;
           $peaje->save();
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
       $registros = Peaje::where([['activo', 1]]);
     }else{
       $usuario = Auth::user()->id;
       $asociar = Asociar::where('id_usuario',$usuario)->first();

       $registros = Peaje::where([['activo', 1],['id_dependencia',$asociar->id_dependencia]]);
     }
     //$registros = Peaje::where('activo', 1); //Conocenos es la entidad
     $datatable = DataTables::of($registros)
     // ->editColumn('cve_tipo_gasolina', function ($registros) {
     //
     //   return $registros->obteneGasolina->nombre;
     // })

     ->make(true);
     //Cueri
     $data = $datatable->getData();
     foreach ($data->data as $key => $value) {

       if(Auth::user()->can(['editar peaje','eliminar peaje'])){
         $acciones = [
            "Editar" => [
              "icon" => "edit blue",
              "href" => "/catalogos/peaje/$value->id/edit"
            ],

           "Eliminar" => [
             "icon" => "edit blue",
             "onclick" => "eliminar($value->id)"
           ],
         ];
      }else if(Auth::user()->can('eliminar peaje')){
        $acciones = [

          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('editar peaje')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/peaje/$value->id/edit"
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
