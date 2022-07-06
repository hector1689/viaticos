<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Modules\Catalogos\Entities\TipoGasolina;
use \Modules\Catalogos\Entities\Gasolina;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use Yajra\Datatables\Datatables;
use \DB;
class GasolinaController extends Controller
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
        return view('catalogos::gasolina.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      if (Auth::user()->tipo_usuario == 4) {
        $data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
        $data['tipos_gasolina'] = TipoGasolina::all();
        return view('catalogos::gasolina.create')->with($data);
      }else{
        $data['tipos_gasolina'] = TipoGasolina::all();
        return view('catalogos::gasolina.create')->with($data);
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

          $existe = Gasolina::where([['activo',1],['cve_tipo_gasolina',$request->cve_tipo_gasolina],['id_dependencia',$area]])->orderBy('id','DESC')->first();

          if(isset($existe)){

            $gasolina = Gasolina::find($existe->id);
            $gasolina->activo = 0;
            $gasolina->save();

            list($dia,$mes,$anio)=explode('/',$request->vigencia);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;



            $gasolina = new Gasolina();
            $gasolina->cve_tipo_gasolina = $request->cve_tipo_gasolina;
            $gasolina->anio = $request->anio;
            $gasolina->mes = $request->mes;
            $gasolina->precio_litro = $request->precio_litro;
            $gasolina->id_dependencia = $area;
            $gasolina->vigencia = $fecha1;
            $gasolina->cve_usuario = Auth::user()->id;
            $gasolina->save();

          }else{
            list($dia,$mes,$anio)=explode('/',$request->vigencia);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;

            if(isset($request->area)){
              $area = $request->area;
            }else{
              $usuario = Auth::user()->id;
              $asociar = Asociar::where('id_usuario',$usuario)->first();
              $area = $asociar->id_dependencia;
            }

            $gasolina = new Gasolina();
            $gasolina->cve_tipo_gasolina = $request->cve_tipo_gasolina;
            $gasolina->anio = $request->anio;
            $gasolina->mes = $request->mes;
            $gasolina->id_dependencia = $area;
            $gasolina->precio_litro = $request->precio_litro;
            $gasolina->vigencia = $fecha1;
            $gasolina->cve_usuario = Auth::user()->id;
            $gasolina->save();
          }

        }else{
          $usuario = Auth::user()->id;
          $asociar = Asociar::where('id_usuario',$usuario)->first();
          $area = $asociar->id_dependencia;

          $existe = Gasolina::where([['activo',1],['cve_tipo_gasolina',$request->cve_tipo_gasolina],['id_dependencia',$area]])->orderBy('id','DESC')->first();

          if(isset($existe)){

            $gasolina = Gasolina::find($existe->id);
            $gasolina->activo = 0;
            $gasolina->save();

            list($dia,$mes,$anio)=explode('/',$request->vigencia);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;



            $gasolina = new Gasolina();
            $gasolina->cve_tipo_gasolina = $request->cve_tipo_gasolina;
            $gasolina->anio = $request->anio;
            $gasolina->mes = $request->mes;
            $gasolina->precio_litro = $request->precio_litro;
            $gasolina->id_dependencia = $area;
            $gasolina->vigencia = $fecha1;
            $gasolina->cve_usuario = Auth::user()->id;
            $gasolina->save();

          }else{
            list($dia,$mes,$anio)=explode('/',$request->vigencia);
            $fecha1 = $anio.'-'.$mes.'-'.$dia;

            if(isset($request->area)){
              $area = $request->area;
            }else{
              $usuario = Auth::user()->id;
              $asociar = Asociar::where('id_usuario',$usuario)->first();
              $area = $asociar->id_dependencia;
            }

            $gasolina = new Gasolina();
            $gasolina->cve_tipo_gasolina = $request->cve_tipo_gasolina;
            $gasolina->anio = $request->anio;
            $gasolina->mes = $request->mes;
            $gasolina->id_dependencia = $area;
            $gasolina->precio_litro = $request->precio_litro;
            $gasolina->vigencia = $fecha1;
            $gasolina->cve_usuario = Auth::user()->id;
            $gasolina->save();
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
    public function show()
    {
        return view('catalogos::gasolina.show');
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
        $data['tipos_gasolina'] = TipoGasolina::all();
        $data['gasolina'] = Gasolina::find($id);
        return view('catalogos::gasolina.create')->with($data);
      }else{
        $data['tipos_gasolina'] = TipoGasolina::all();
        $data['gasolina'] = Gasolina::find($id);
        return view('catalogos::gasolina.create')->with($data);
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

          $gasolina = Gasolina::find($request->id);
          $gasolina->cve_tipo_gasolina = $request->cve_tipo_gasolina;
          $gasolina->anio = $request->anio;
          $gasolina->mes = $request->mes;
          $gasolina->id_dependencia = $area;
          $gasolina->precio_litro = $request->precio_litro;
          $gasolina->vigencia = $fecha1;
          $gasolina->cve_usuario = Auth::user()->id;
          $gasolina->save();

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
           $gasolina = Gasolina::find($request->id);
           $gasolina->activo = 0;
           $gasolina->save();
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
      $registros = Gasolina::where([['activo', 1]]);
    }else{
      $usuario = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$usuario)->first();

      $registros = Gasolina::where([['activo', 1],['id_dependencia',$asociar->id_dependencia]]);
    }

    $datatable = DataTables::of($registros)
    ->editColumn('cve_tipo_gasolina', function ($registros) {

      return $registros->obteneGasolina->nombre;
    })

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar gasolina','eliminar gasolina'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/gasolina/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];
      }else if(Auth::user()->can('eliminar gasolina')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ],
        ];
      }else if(Auth::user()->can('editar gasolina')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/gasolina/$value->id/edit"
           ],
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
