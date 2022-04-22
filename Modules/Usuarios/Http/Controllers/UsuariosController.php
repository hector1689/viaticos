<?php

namespace Modules\Usuarios\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use \Modules\Usuarios\Entities\Roles;
use \Modules\Usuarios\Entities\RolesPermisos;
use \Modules\Usuarios\Entities\ModeloRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use \App\Models\User;
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
        return view('usuarios::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

      $data['roles'] = Roles::all();

      return view('usuarios::create')->with($data);
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

      $data['roles'] = Roles::all();
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
      $registros = User::where('activo', 1); //user es una entidad que se trae desde la app
      $datatable = DataTables::of($registros)
      ->editColumn('tipo_usuario', function ($registros) {
        return $registros->obtenerUser->name;//relacion
       })
      ->make(true);
      //Cueri
      $data = $datatable->getData();
      foreach ($data->data as $key => $value) { //el array acciones se constuye en el helpers dropdown - helpers esta con bootsrap

        if(Auth::user()->can(['editar usuario','eliminar usuario'])){
          $acciones = [
            "Editar" => [
              "icon" => "edit blue",
              "href" => "/usuarios/$value->id/edit" //esta ruta esta en el archivo web
            ],
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

    public function archivosview(){
      return view('usuarios::archivos');
    }


}
