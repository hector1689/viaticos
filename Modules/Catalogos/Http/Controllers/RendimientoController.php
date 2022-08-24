<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\Rendimiento;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \DB;
class RendimientoController extends Controller
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
        return view('catalogos::rendimiento.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      if (Auth::user()->tipo_usuario == 4) {
        $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
        return view('catalogos::rendimiento.create')->with($data);
      }else{
        return view('catalogos::rendimiento.create');
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

        $rendimiento = new Rendimiento();
        $rendimiento->tarifa = $request->tarifa;
        $rendimiento->kilometros_litros = $request->kilometros_litros;
        $rendimiento->descripcion = $request->descripcion;
        $rendimiento->id_dependencia = $area;
        $rendimiento->cve_usuario = Auth::user()->id;
        $rendimiento->save();

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
        return view('catalogos::rendimiento.show');
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
        $data['rendimiento'] = Rendimiento::find($id);
        return view('catalogos::rendimiento.create')->with($data);
      }else{
        $data['rendimiento'] = Rendimiento::find($id);
        return view('catalogos::rendimiento.create')->with($data);
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



        $rendimiento = Rendimiento::find($request->id);
        $rendimiento->tarifa = $request->tarifa;
        $rendimiento->kilometros_litros = $request->kilometros_litros;
        $rendimiento->descripcion = $request->descripcion;
        $rendimiento->id_dependencia = $area;
        $rendimiento->cve_usuario = Auth::user()->id;
        $rendimiento->save();

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
           $rendimiento = Rendimiento::find($request->id);
           $rendimiento->activo = 0;
           $rendimiento->save();
           return response()->json(['success'=>'Eliminado exitosamente']);
         } catch (\Exception $e) {
           dd($e->getMessage());
         }
     }

     public function tabla(){
     setlocale(LC_TIME, 'es_ES');
     \DB::statement("SET lc_time_names = 'es_ES'");
     //dd('entro');
     // if (Auth::user()->tipo_usuario == 4) {
     //   $registros = Rendimiento::where([['activo', 1]]);
     // }else{
     //   $usuario = Auth::user()->id;
     //   $asociar = Asociar::where('id_usuario',$usuario)->first();
     //
     //   $registros = Rendimiento::where([['activo', 1],['id_dependencia',$asociar->id_dependencia]]);
     // }

      $registros = Rendimiento::where([['activo', 1]]);
     //$registros = Rendimiento::where('activo', 1); //Conocenos es la entidad
     $datatable = DataTables::of($registros)
     // ->editColumn('cve_tipo_gasolina', function ($registros) {
     //
     //   return $registros->obteneGasolina->nombre;
     // })

     ->make(true);
     //Cueri
     $data = $datatable->getData();
     foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar rendimiento','eliminar rendimiento'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/rendimiento/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];

      }else if(Auth::user()->can('eliminar rendimiento')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];

      }else if(Auth::user()->can('editar rendimiento')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/rendimiento/$value->id/edit"
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
