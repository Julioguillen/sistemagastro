<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Danados;
use App\Equipo;
use Illuminate\Support\Facades\DB;

class equiposController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar ==''){
            $equipos = Equipo::orderBy('id_equipo','desc')->paginate(10);

        }else{

            $equipos = Equipo::where('nombre','like','%'.$buscar.'%')->orderBy('id_equipo','desc')->paginate(10);

        }
        if($buscar ==''){
            $equipos = Equipo::orderBy('id_equipo','desc')->paginate(10);

        }else{

            $equipos = Equipo::where('descripcion','like','%'.$buscar.'%')->orderBy('id_equipo','desc')->paginate(10);

        }

        return [
            'pagination'=>[
                'total' => $equipos->total(),
                'current_page' => $equipos->currentPage(),
                'per_page' => $equipos->perPage(),
                'last_page' => $equipos->LastPage(),
                'from' => $equipos->firstItem(),
                'to' => $equipos->LastItem(),
            ],
            'equipos'=>$equipos
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
        $equipos = new Equipo();
        $equipos->nombre=$request->nombre;
        $equipos->cantidad=$request->cantidad;
        $equipos->descripcion=$request->descripcion;
        $equipos->imagen=$request->imagen;

        $equipos->save();
    }
    public function update(Request $request)
    {

        if (!$request->ajax())return redirect('/');
        if ($request->cantidad_danados == null){
            $equipos = Equipo::findOrFail($request->id_equipo);
            $equipos->nombre=$request->nombre;
            $equipos->cantidad=$request->cantidad;
            $equipos->descripcion=$request->descripcion;
            $equipos->imagen=$request->imagen;
            $equipos->save();
        }else{

            $equipos = Equipo::findOrFail($request->id_equipo)->decrement('cantidad',$request->cantidad_danados);

            $danados = new Danados();
            $danados->nombre=$request->nombre;
            $danados->cantidad_danados=$request->cantidad_danados;
            $danados->descripcion_danados=$request->descripcion_danados;
            $danados->control=$request->control;
            $danados->alumno=$request->alumno;
            $danados->imagen=$request->imagen;
            $danados->save();
        }


    }
    public function destroy($id)
    {
        $equipos = Equipo::findOrFail($id);

        $equipos->delete();


    }


}
