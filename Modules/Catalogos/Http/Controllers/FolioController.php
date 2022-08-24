<?php

namespace Modules\Catalogos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use \Modules\Catalogos\Entities\Folios;
use \Modules\Catalogos\Entities\Areas;
use \Modules\Usuarios\Entities\Asociar;
use \Modules\Catalogos\Entities\Personal_Siti;
use \Modules\Catalogos\Entities\TablaFolios;
use \Modules\Catalogos\Entities\Departamento_Firmantes;

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
      if (Auth::user()->tipo_usuario == 4) {
        //$data['area'] = Areas::where([['activo',1],['id_padre',0]])->get();
        $data['usuarios'] = User::where([['activo',1]])->get();
        $data['areas'] = Areas::where([['activo',1]])->get();
          return view('catalogos::folios.create')->with($data);
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        ////////////////////////////////////////////////////////////////////
        $reg = Areas::find($area);

          $id_reg = 0;
          $id_est = 0;
          $nivel1 = [];
          if($reg) {
              $nivel  = $reg->nivel;


              $id_reg = $reg->id ;   // cve_t_estructura;
              $id_est = $reg->id;
              //dd($id_reg,$nivel);
              if ($nivel == 1) {
                  $id_reg = $reg->id;
                  // $id_est = $reg->id;
                  $data = [];
                  $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
                  foreach ($regs as $key => $value) {
                      $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];

                      array_push($nivel1,$value->id);
                  }

                  if (isset($reg->id)) {
                    $regs2 = Areas::where([ ['activo', 1], ['id_padre', $reg->id] , ['nivel', 2] ])->get();
                    foreach ($regs2 as $key => $value2) {
                        array_push($nivel1,$value2->id);
                    }
                  }



                    if (isset($value2->id)) {
                      $regs3 = Areas::where([ ['activo', 1], ['id_padre', $value2->id] , ['nivel', 3] ])->get();
                      foreach ($regs3 as $key => $value3) {
                          array_push($nivel1,$value3->id);
                      }
                    }


                    if (isset($value3->id)) {
                      $regs4 = Areas::where([ ['activo', 1], ['id_padre', $value3->id] , ['nivel', 4] ])->get();
                      foreach ($regs4 as $key => $value4) {
                          array_push($nivel1,$value4->id);
                      }
                    }

                    if (isset($value4->id)) {
                      $regs5 = Areas::where([ ['activo', 1], ['id_padre', $value4->id] , ['nivel', 5] ])->get();
                      foreach ($regs5 as $key => $value5) {
                          array_push($nivel1,$value5->id);
                      }
                    }
              }

        }

        //////////////////////////////////////////////////////////////////
        $data['areas'] = Areas::where([['activo',1]])->whereIN('id',$nivel1)->get();
        //$data['usuarios'] = User::where([['activo',1],['tipo_usuario','!=',4]])->get();


        $data['usuarios'] = User::leftjoin('t_usuarios','t_usuarios.id_usuario','=','users.id')->
        leftjoin('roles','roles.id','=','users.tipo_usuario')->
        select(
          'users.id',
          'users.nombre',
          'users.apellido_paterno',
          'users.apellido_materno',
          'roles.name'
          )->where([['users.activo', 1],['users.tipo_usuario','!=', 4],['t_usuarios.id_dependencia', $area]])->get();
          //dd($usuarios);

          return view('catalogos::folios.create')->with($data);
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

            $foliost->posicion1 = $value['posicion1'];
            $foliost->posicion2 = $value['posicion2'];
            $foliost->posicion3 = $value['posicion3'];
            $foliost->posicion4 = $value['posicion4'];
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


      if (Auth::user()->tipo_usuario == 4) {
        $data['folios'] = Folios::find($id);
        $data['usuarios'] = User::where([['activo',1]])->get();
        $data['areas'] = Areas::where([['activo',1]])->get();

        $data['tabla_folios'] = TablaFolios::where([['activo',1],['cve_folio',$id]])->get();
        return view('catalogos::folios.create')->with($data);
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        ////////////////////////////////////////////////////////////////////
        $reg = Areas::find($area);

          $id_reg = 0;
          $id_est = 0;
          $nivel1 = [];
          if($reg) {
              $nivel  = $reg->nivel;


              $id_reg = $reg->id ;   // cve_t_estructura;
              $id_est = $reg->id;
              //dd($id_reg,$nivel);
              if ($nivel == 1) {
                  $id_reg = $reg->id;
                  // $id_est = $reg->id;
                  $data = [];
                  $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
                  foreach ($regs as $key => $value) {
                      $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];

                      array_push($nivel1,$value->id);
                  }

                  if (isset($reg->id)) {
                    $regs2 = Areas::where([ ['activo', 1], ['id_padre', $reg->id] , ['nivel', 2] ])->get();
                    foreach ($regs2 as $key => $value2) {
                        array_push($nivel1,$value2->id);
                    }
                  }



                    if (isset($value2->id)) {
                      $regs3 = Areas::where([ ['activo', 1], ['id_padre', $value2->id] , ['nivel', 3] ])->get();
                      foreach ($regs3 as $key => $value3) {
                          array_push($nivel1,$value3->id);
                      }
                    }


                    if (isset($value3->id)) {
                      $regs4 = Areas::where([ ['activo', 1], ['id_padre', $value3->id] , ['nivel', 4] ])->get();
                      foreach ($regs4 as $key => $value4) {
                          array_push($nivel1,$value4->id);
                      }
                    }

                    if (isset($value4->id)) {
                      $regs5 = Areas::where([ ['activo', 1], ['id_padre', $value4->id] , ['nivel', 5] ])->get();
                      foreach ($regs5 as $key => $value5) {
                          array_push($nivel1,$value5->id);
                      }
                    }
              }

        }

        //////////////////////////////////////////////////////////////////
        $data['areas'] = Areas::where([['activo',1]])->whereIN('id',$nivel1)->get();
        //$data['usuarios'] = User::where([['activo',1],['tipo_usuario','!=',4]])->get();
        $data['folios'] = Folios::find($id);

        $data['tabla_folios'] = TablaFolios::where([['activo',1],['cve_folio',$id]])->get();


        $data['usuarios'] = User::leftjoin('t_usuarios','t_usuarios.id_usuario','=','users.id')->
        leftjoin('roles','roles.id','=','users.tipo_usuario')->
        select(
          'users.id',
          'users.nombre',
          'users.apellido_paterno',
          'users.apellido_materno',
          'roles.name'
          )->where([['users.activo', 1],['users.tipo_usuario','!=', 4],['t_usuarios.id_dependencia', $area]])->get();
          //dd($usuarios);

          return view('catalogos::folios.create')->with($data);
      }

      // $data['folios'] = Folios::find($id);
      // $data['usuarios'] = User::where([['activo',1]])->get();
      // $data['areas'] = Areas::where([['activo',1],['id_tipo',1]])->get();
      //
      // $data['tabla_folios'] = TablaFolios::where([['activo',1],['cve_folio',$id]])->get();
      //
      //   return view('catalogos::folios.create')->with($data);
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
            $foliost->posicion1 = $value['posicion1'];
            $foliost->posicion2 = $value['posicion2'];
            $foliost->posicion3 = $value['posicion3'];
            $foliost->posicion4 = $value['posicion4'];
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
    public function destroy(Request $request)
    {
      try {
        $folios = Folios::find($request->id);
        $folios->activo = 0;
        $folios->save();

        $folios = TablaFolios::where('cve_folio',$folios->id)->update([
          'activo' => 0
        ]);

        return response()->json(['success'=>'Registro Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
    }

    public function borrarFolio(Request $request){
      $folios = TablaFolios::find($request->id);
      $folios->activo = 0;
      $folios->save();
      return response()->json(['success'=>'Ha sido eliminado con éxito']);
    }

    public function tabla(){
    setlocale(LC_TIME, 'es_ES');
    \DB::statement("SET lc_time_names = 'es_ES'");
    //dd('entro');

    if (Auth::user()->tipo_usuario == 4) {
    $registros = Folios::where('activo', 1);
    }else{
      $usuario = Auth::user()->id;
      $asociar = Asociar::where('id_usuario',$usuario)->first();

      $registros = Folios::where([['activo', 1],['dependencia',$asociar->id_dependencia]]);
    }


     //Conocenos es la entidad
    $datatable = DataTables::of($registros)
    ->editColumn('dependencia', function ($registros) {

      return $registros->obtenerArea->nombre;
    })

    ->make(true);
    //Cueri
    $data = $datatable->getData();
    foreach ($data->data as $key => $value) {

      if(Auth::user()->can(['editar folio','eliminar folio'])){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/folios/$value->id/edit"
           ],
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('eliminar folio')){
        $acciones = [
          "Eliminar" => [
            "icon" => "edit blue",
            "onclick" => "eliminar($value->id)"
          ]
        ];
      }else if(Auth::user()->can('editar folio')){
        $acciones = [
           "Editar" => [
             "icon" => "edit blue",
             "href" => "/catalogos/folios/$value->id/edit"
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

  public function TraerEncargado(Request $request){
    $personal = Personal_Siti::where([
      ['activo',1],
      ['cve_cat_deptos_siti',$request->dependencia],
    ])->first();


    return $personal;
  }

  public function TraerFirmantes(Request $request){

      //dd($request->cve_cat_deptos_siti);
      ////////////////////////////////////////////////////////////////////
      // $reg = Areas::find($request->cve_cat_deptos_siti);
      // //dd($reg);
      //   $id_reg = 0;
      //   $id_est = 0;
      //   $nivel1 = [];
      //   if($reg) {
      //       $nivel  = $reg->nivel;
      //
      //
      //       $id_reg = $reg->id ;   // cve_t_estructura;
      //       $id_est = $reg->id;
      //       //dd($id_reg,$nivel);
      //
      //           $id_reg = $reg->id;
      //           // $id_est = $reg->id;
      //           $data = [];
      //           $regs = Areas::where([ ['activo', 1], ['id', $id_reg] ])->get();
      //           foreach ($regs as $key => $value) {
      //               $data [] = [ 'id' => $value->id, 'valor' => $value->id_padre , 'tipo' => $value->id_tipo ];
      //
      //               array_push($nivel1,$value->id);
      //           }
      //
      //           if (isset($value->id)) {
      //             dd($regs2,$value->id,$value->nivel);
      //             $regs2 = Areas::where([ ['activo', 1], ['id_padre', $value->id] , ['nivel',$value->nivel] ])->get();
      //
      //             foreach ($regs2 as $key => $value2) {
      //                 array_push($nivel1,$value2->id);
      //
      //             }
      //           }
      //
      //
      //
      //             if (isset($value2->id)) {
      //               $regs3 = Areas::where([ ['activo', 1], ['id_padre', $value2->id] , ['nivel', $value2->nivel] ])->get();
      //               foreach ($regs3 as $key => $value3) {
      //                   array_push($nivel1,$value3->id);
      //               }
      //             }
      //
      //
      //             if (isset($value3->id)) {
      //               $regs4 = Areas::where([ ['activo', 1], ['id_padre', $value3->id] , ['nivel',$value3->nivel] ])->get();
      //               foreach ($regs4 as $key => $value4) {
      //                   array_push($nivel1,$value4->id);
      //               }
      //             }
      //
      //             if (isset($value4->id)) {
      //               $regs5 = Areas::where([ ['activo', 1], ['id_padre', $value4->id] , ['nivel', $value4->nivel] ])->get();
      //               foreach ($regs5 as $key => $value5) {
      //                   array_push($nivel1,$value5->id);
      //               }
      //             }
      //
      //
      // }
      //////////////////////////////////////////////////////////////////





    $firmantes = Departamento_Firmantes::where([
      ['activo',1],
      ['cve_area_departamentos',$request->area_encargada],
    ])->get();


    return $firmantes;
  }
}
