<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Roles;
class UsuariosController extends Controller
{


    public function index(Request $request){

        if (!$request->ajax())return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar ==''){
            $usuarios = User::join('roles','users.id_roles','=','roles.id_rol')->
            select('users.id_usuario','users.name','users.email','users.telefono','users.password','users.condicion','users.id_roles','roles.nombre as rol')
                ->orderBy('users.id_usuario', 'desc')->paginate(10);
        }else{
            $usuarios = User::join('roles','users.id_roles','=','roles.id_rol')->
            select('users.name','users.email','users.telefono','users.password','users.condicion','users.id_roles','roles.nombre as rol')
            -> where('name','like','%'.$buscar.'%')->orderBy('users.id_usuario','desc')->paginate(10);
        }

        return [
            'pagination'=>[
                'total' => $usuarios->total(),
                'current_page' => $usuarios->currentPage(),
                'per_page' => $usuarios->perPage(),
                'last_page' => $usuarios->LastPage(),
                'from' => $usuarios->firstItem(),
                'to' => $usuarios->LastItem(),
            ],
            'users'=>$usuarios
        ];

    }

    public function store(Request $request)
    {
        if($request->get('imagen'))
        {
            $image = $request->get('imagen');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('imagen'))->save(public_path('images/').$name);
        }
        $max_size = (int)ini_get('upload_max_filesize') * 1000;
        if (!$request->ajax())return redirect('/');
        $usuarios = new User();
        $usuarios->name=$request->name;
        $usuarios->email=$request->email;
        $usuarios->password=bcrypt($request->password);
        $usuarios->telefono=$request->telefono;
        $usuarios->imagen=$request->imagen;

        $usuarios->id_roles=$request->id_roles;


        $usuarios->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $usuarios = User::findOrFail($request->id_usuario);
        $usuarios->name=$request->name;
        $usuarios->email=$request->email;
        $usuarios->password=bcrypt($request->password);
        $usuarios->telefono=$request->telefono;
        $usuarios->condicion=1;
        $usuarios->id_roles=$request->id_roles;

        $usuarios->save();
    }
    public function destroy($id)
    {
        $usuarios = User::findOrFail($id);
        $usuarios->delete();


    }
    public function desactivar(Request $request)
    {
        $usuarios = User::findOrFail($request->id_usuario);
        $usuarios->condicion ='0';
        $usuarios->save();
    }
    public function activar(Request $request)
    {
        $usuarios = User::findOrFail($request->id_usuario);
        $usuarios->condicion ='1';
        $usuarios->save();
    }
    public function validacion(Request $request){
        $this->validate($request,[
            'nombre'=>'required',
            'correo'=>'required',
            'contrasena'=>'required',
            'telefono'=>'required',

           'id_roles'=>'required'
        ]);
    }

}
