<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Herramientas_Cocina;
use App\Danados;
use Illuminate\Support\Facades\DB;



class herramientaController extends Controller
{
    private $image_ext = ['jpg', 'jpeg', 'png', 'gif'];
    private $audio_ext = ['mp3', 'ogg', 'mpga'];
    private $video_ext = ['mp4', 'mpeg'];
    private $document_ext = ['doc', 'docx', 'pdf', 'odt'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax())return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

           if($buscar ==''){
            $herramientas = Herramientas_Cocina::orderBy('id_herramienta','desc')->paginate(10);

            }else{

               $herramientas = Herramientas_Cocina::where('nombre','like','%'.$buscar.'%')->orderBy('id_herramienta','desc')->paginate(10);

           }
        if($buscar ==''){
            $herramientas = Herramientas_Cocina::orderBy('id_herramienta','desc')->paginate(10);

        }else{

            $herramientas = Herramientas_Cocina::where('descripcion','like','%'.$buscar.'%')->orderBy('id_herramienta','desc')->paginate(10);

        }

        return [
          'pagination'=>[
              'total' => $herramientas->total(),
              'current_page' => $herramientas->currentPage(),
              'per_page' => $herramientas->perPage(),
              'last_page' => $herramientas->LastPage(),
              'from' => $herramientas->firstItem(),
              'to' => $herramientas->LastItem(),
          ],
            'herramientas'=>$herramientas
        ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $herramienta = new Herramientas_Cocina();
        $herramienta->nombre=$request->nombre;
        $herramienta->cantidad=$request->cantidad;
        $herramienta->descripcion=$request->descripcion;
        $herramienta->imagen=$request->imagen;

        $herramienta->save();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request)
    {

        if (!$request->ajax())return redirect('/');
        if ($request->cantidad_danados == null){
        $herramienta = Herramientas_Cocina::findOrFail($request->id_herramienta);
        $herramienta->nombre=$request->nombre;
        $herramienta->cantidad=$request->cantidad;
        $herramienta->descripcion=$request->descripcion;
        $herramienta->imagen=$request->imagen;
        $herramienta->save();
        }else{

        $herramienta = Herramientas_Cocina::findOrFail($request->id_herramienta)->decrement('cantidad',$request->cantidad_danados);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $herramienta = Herramientas_Cocina::findOrFail($id);

        $herramienta->delete();


    }

    public function desactivar(Request $request)
    {
        $herramienta = Herramientas_Cocina::findOrFail($request->id_herramienta);
        $herramienta->condicion ='0';
        $herramienta->save();
    }
    public function activar(Request $request)
    {
        $herramienta = Herramientas_Cocina::findOrFail($request->id_herramienta);
        $herramienta->condicion ='1';
        $herramienta->save();
    }

}
