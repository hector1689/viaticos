<?php

namespace Modules\Usuarios\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use \Modules\Usuarios\Entities\Roles;
use \Modules\Usuarios\Entities\RolesPermisos;
use \Modules\Usuarios\Entities\ModeloRoles;
use \Modules\Usuarios\Entities\Asociar;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \App\Models\User;
use \Modules\Catalogos\Entities\Areas;
use Auth;
use \DB;
class UsuariosController extends Controller
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
      $tipo_usuario = Auth::user()->tipo_usuario;

      if($tipo_usuario == 4){
        $data['areas'] = Areas::where([['activo',1],['id_padre',0]])->get();
      }else{
        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;
        $data['areas'] = Areas::where([['activo',1],['id',$area]])->get();
      }

        return view('usuarios::index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

      if (Auth::user()->tipo_usuario == 4) {
        $data['roles'] = Roles::all();
      }else{
        $data['roles'] = Roles::where('id','!=',4)->get();
      }



      return view('usuarios::create')->with($data);
    }

    public function asociarusuario(Request $request){
        try {
          $asociar = Asociar::where('id_usuario',$request->id)->first();

          if (isset($asociar)) {
            $as = Asociar::find($asociar->id);
            $as->id_dependencia = $request->dependencia;
            $as->save();
          }else{
            $as = new Asociar();
            $as->id_usuario = $request->id;
            $as->id_dependencia = $request->dependencia;
            $as->save();
          }

          return response()->json(['success'=>'Se Agrego Satisfactoriamente']);

        } catch (\Exception $e) {
           dd($e->getMessage());
        }

    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
     public function store(Request $request)//es post siempre
     {
         try {

           $rol = Roles::find($request->tipo_usuario);

           $usuario = new User();
           $usuario->nombre = $request->nombre;
           $usuario->apellido_paterno = $request->apellido_paterno;
           $usuario->apellido_materno = $request->apellido_materno;
           $usuario->tipo_usuario = $request->tipo_usuario;
           $usuario->name = $request->nombre.'.'.$request->apellido_paterno;
           $usuario->email = $request->email;
           $usuario->password = bcrypt($request->password);
           $usuario->password_name = $request->password;
           $usuario->cve_usuario = Auth::user()->id;
           $usuario->assignRole($rol->name);
           $usuario->save();


           $roles_permisos = RolesPermisos::where('role_id',$request->tipo_usuario)->get();

           foreach ($roles_permisos as $key => $value) {
             $modelo = new ModeloRoles();
             $modelo->permission_id = $value['permission_id'];
             $modelo->model_type = 'App\Models\User';
             $modelo->model_id = $usuario->id;
             $modelo->save();
           }

           return response()->json(['success'=>'Se Agrego Satisfactoriamente']);

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
        return view('usuarios::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
      $data['usuarios'] = User::find($id);

      if (Auth::user()->tipo_usuario == 4) {
        $data['roles'] = Roles::all();
      }else{
        $data['roles'] = Roles::where('id','!=',4)->get();
      }
      return view('usuarios::create')->with($data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
     public function update(Request $request, $id)
     {
     try {
       //dd($request->all(),$id);
       $rol = Roles::find($request->tipo_usuario);

       $user_pass=Auth::user()->password_name;
       if ($user_pass==$request->password) {
         $usuario = User::find($id);
         $usuario->nombre = $request->nombre;
         $usuario->apellido_paterno = $request->apellido_paterno;
         $usuario->apellido_materno = $request->apellido_materno;
         $usuario->tipo_usuario = $request->tipo_usuario;
         $usuario->name = $request->nombre.'.'.$request->apellido_paterno;
         $usuario->email = $request->email;
         $usuario->syncRoles($rol->name);
         $usuario->cve_usuario = Auth::user()->id;
         $usuario->save();

         $roles_permisos = RolesPermisos::where('role_id',$request->tipo_usuario)->get();
         ModeloRoles::where('model_id',$usuario->id)->delete();
         foreach ($roles_permisos as $key => $value) {
           $modelo = new ModeloRoles();
           $modelo->permission_id = $value['permission_id'];
           $modelo->model_type = 'App\Models\User';
           $modelo->model_id = $usuario->id;
           $modelo->save();
         }



         return response()->json(['success'=>'Ha sido editado con éxito']);
       }
       else{
         $usuario = User::find($id);
         $usuario->nombre = $request->nombre;
         $usuario->apellido_paterno = $request->apellido_paterno;
         $usuario->apellido_materno = $request->apellido_materno;
         $usuario->tipo_usuario = $request->tipo_usuario;
         $usuario->name = $request->nombre.'.'.$request->apellido_paterno;
         $usuario->email = $request->email;
         $usuario->password = bcrypt($request->password);
         $usuario->password_name = $request->password;
         $usuario->cve_usuario = Auth::user()->id;
         $usuario->syncRoles($rol->name);
         $usuario->save();

         $roles_permisos = RolesPermisos::where('role_id',$request->tipo_usuario)->get();
         ModeloRoles::where('model_id',$usuario->id)->delete();
         foreach ($roles_permisos as $key => $value) {
          $modelo = new ModeloRoles();
          $modelo->permission_id = $value['permission_id'];
          $modelo->model_type = 'App\Models\User';
          $modelo->model_id = $usuario->id;
          $modelo->save();

         }

         return response()->json(['success'=>'Ha sido editado con éxito']);
       }



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
        $usuario = User::find($request->id_user);
        $usuario->activo = 0;
        $usuario->save();
        return response()->json(['success'=>'Eliminado exitosamente']);
      } catch (\Exception $e) {
        dd($e->getMessage());
      }
    }

    public function tablausuarios(){
      setlocale(LC_TIME, 'es_ES');
      \DB::statement("SET lc_time_names = 'es_ES'");
      $tipo_usuario = Auth::user()->tipo_usuario;

      if($tipo_usuario == 4){
        $registros = User::where('activo', 1);
      }else{


        $usuario = Auth::user()->id;
        $asociar = Asociar::where('id_usuario',$usuario)->first();
        $area = $asociar->id_dependencia;

        $registros = User::join('t_usuarios','t_usuarios.id_usuario','users.id')->
        where([
          ['users.activo', 1],
          ['users.tipo_usuario','!=',4]
        ])->where([['users.tipo_usuario',$tipo_usuario],['t_usuarios.id_dependencia',$area]])->get();

      }

      $datatable = DataTables::of($registros)
      ->editColumn('tipo_usuario', function ($registros) {
        return $registros->obtenerUser->name;//relacion
       })
      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) { //el array acciones se constuye en el helpers dropdown - helpers esta con bootsrap

        if ($value->tipo_usuario == 'Administrador') {
          if(Auth::user()->can(['editar usuario','eliminar usuario'])){
            $acciones = [
              "Editar" => [
                "icon" => "edit blue",
                "href" => "/usuarios/$value->id/edit" //esta ruta esta en el archivo web
              ],
              "Asociar" => [
                "icon" => "edit blue",
                "onclick" => "asociar($value->id)"
              ],
              "Login as" => [ "onclick" => "as('$value->id')" ],
              "Eliminar" => [
                "icon" => "edit blue",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }else if(Auth::user()->can('eliminar usuario')){
            $acciones = [
              "Eliminar" => [
                "icon" => "edit blue",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }else if(Auth::user()->can('editar usuario')){
            $acciones = [
              "Editar" => [
                "icon" => "edit blue",
                "href" => "/usuarios/$value->id/edit" //esta ruta esta en el archivo web
              ],

            ];
          }else{
            $acciones = [

            ];
          }
        }else{
          if(Auth::user()->can(['editar usuario','eliminar usuario'])){
            $acciones = [
              "Editar" => [
                "icon" => "edit blue",
                "href" => "/usuarios/$value->id/edit" //esta ruta esta en el archivo web
              ],
              "Login as" => [ "onclick" => "as('$value->id')" ],
              "Eliminar" => [
                "icon" => "edit blue",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }else if(Auth::user()->can('eliminar usuario')){
            $acciones = [
              "Eliminar" => [
                "icon" => "edit blue",
                "onclick" => "eliminar($value->id)"
              ],
            ];
          }else if(Auth::user()->can('editar usuario')){
            $acciones = [
              "Editar" => [
                "icon" => "edit blue",
                "href" => "/usuarios/$value->id/edit" //esta ruta esta en el archivo web
              ],

            ];
          }else{
            $acciones = [

            ];
          }
        }







      $value->acciones = generarDropdown($acciones);
      }
      $datatable->setData($data);
      return $datatable;
    }


    public function archivos(Request $request){

      $files = Storage::allFiles();
      return $files;
    }

    public function Eliminararchivos(Request $request){
      $files = Storage::allFiles();

      //dd(array_key_exists($request->id, $files));

      foreach ($files as $key => $value) {
        //dd($key,$value,$request->id);
        //dd($key == $request->id);

      //  var_dump(array_key_exists($request->id,$key));
        if ($request->id == $key) {
            //dd($value);
            $filets = Storage::delete($value);
            return $filets;
        }


      }


      //dd($filets);



    }

    public function as(Request $request){
      $reserva = \Auth::user()->id;
      $user = User::find($request->id);
      \Auth::loginUsingId($user->id);

      $idOriginal = $request->session()->get('idOriginal');
          if ( is_null( $idOriginal ) ) {
            $request->session()->put('idOriginal', $reserva);
          }else if( $idOriginal == $user->id ){
            $request->session()->forget('idOriginal');
          }

      return response()->json(['success'=>'cambio de usuario exitosamente']);
      // return redirect('/dashboard');
    }
    public function as2(Request $request){
      $loginAs = \Auth::user()->id;
      $user = User::find($request->id);
      \Auth::login($user);

      $idOriginal = $request->session()->get('idOriginal');
      if ( is_null( $idOriginal ) ) {
        $request->session()->put('idOriginal', $reserva);
      }else if( $idOriginal == $user->id ){
        $request->session()->forget('idOriginal');
      }


      return 1;

    }

    public function archivosview(){
      return view('usuarios::archivos');
    }


}
