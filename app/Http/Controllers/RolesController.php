<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar ==''){
            $roles = Roles::orderBy('id_rol','desc')->paginate(10);
        }else{
            $roles = Roles::where($criterio,'like','%'.$buscar.'%')->orderBy('id_rol','desc')->paginate(10);
        }

        return [
            'pagination'=>[
                'total' => $roles->total(),
                'current_page' => $roles->currentPage(),
                'per_page' => $roles->perPage(),
                'last_page' => $roles->LastPage(),
                'from' => $roles->firstItem(),
                'to' => $roles->LastItem(),
            ],
            'herramientas'=>$roles
        ];

    }
    public function listarRoles(Request $request){
        //if (!$request->ajax())return redirect('/');
        $roles =Roles::where('condicion','=','1')
            ->select('id_rol','nombre')
            ->orderBy('nombre','asc')->get();
        return ['roles'=>$roles];
    }
}
