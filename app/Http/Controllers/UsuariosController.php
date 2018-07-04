<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuarios;
class UsuariosController extends Controller{
    public function index(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar ==''){
            $usuarios = Usuarios::orderBy('id_usuario','desc')->paginate(10);
        }else{
            $usuarios= Usuarios::where($criterio,'like','%'.$buscar.'%')->orderBy('id_usuario','desc')->paginate(10);
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
            'usuarios'=>$usuarios
        ];

    }

    public function store(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $usuarios = new Usuarios();
        $usuarios->nombre=$request->nombre;
        $usuarios->correo=$request->correo;
        $usuarios->contrasena=$request->contrasena;

        $usuarios->telefono=$request->telefono;


        $usuarios->save();
    }
    public function update(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $usuarios = Usuarios::findOrFail($request->id_usuario);
        $usuarios->nombre=$request->nombre;
        $usuarios->correo=$request->correo;
        $usuarios->contrasena=$request->contrasena;

        $usuarios->telefono=$request->telefono;

        $usuarios->save();
    }
    public function destroy($id)
    {
        $usuarios = Usuarios::findOrFail($id);

        $usuarios->delete();


    }

}
