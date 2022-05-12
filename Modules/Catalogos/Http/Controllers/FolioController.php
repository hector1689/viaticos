<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use \Modules\Catalogos\Entities\Folios;
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

        $data['folios'] = Folios::where('activo',1)->first();
        $data['usuarios'] = User::where([['activo',1]])->get();


        $existe = TablaFolios::where('cve_folio',$data['folios']->id)->first();

        if (isset($existe)) {
          $data['tabla_folios'] = TablaFolios::where('cve_folio',$data['folios']->id)->get();
        }else{
          $data['tabla_folios'] = 0;
        }


        return view('catalogos::folios.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('catalogos::create');
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
            $folios = new TablaFolios();
            $folios->cve_folio = $folios->id;
            $folios->tipo_folio = $value['tipo'];
            $folios->foliador = $value['folio'];
            $folios->save();
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
        return view('catalogos::edit');
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
            $folios = new TablaFolios();
            $folios->cve_folio = $folios->id;
            $folios->tipo_folio = $value['tipo'];
            $folios->foliador = $value['folio'];
            $folios->save();
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
}
