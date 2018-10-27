<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cristaleria;
use App\Danados;

class cristaleriaController extends Controller
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

        if($buscar ==''){
            $cristaleria = Cristaleria::orderBy('id_cristaleria','desc')->paginate(10);
            }else{
               $cristaleria = Cristaleria::where('nombre','like','%'.$buscar.'%')->orderBy('id_cristaleria','desc')->paginate(10);
           }


        return [
          'pagination'=>[
              'total' => $cristaleria->total(),
              'current_page' => $cristaleria->currentPage(),
              'per_page' => $cristaleria->perPage(),
              'last_page' => $cristaleria->LastPage(),
              'from' => $cristaleria->firstItem(),
              'to' => $cristaleria->LastItem(),
          ],
            'cristaleria'=>$cristaleria
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
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
        $cristaleria = new Cristaleria();
        $cristaleria->nombre=$request->nombre;
        $cristaleria->cantidad=$request->cantidad;
        $cristaleria->descripcion=$request->descripcion;
        $cristaleria->imagen=$request->imagen;

        $cristaleria->save();
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
    public function update(Request $request, $id)
    {
        if (!$request->ajax())return redirect('/');
        if ($request->cantidad_danados == null){
        $cristaleria = Cristaleria::findOrFail($request->id_cristaleria);
        $cristaleria->nombre=$request->nombre;
        $cristaleria->cantidad=$request->cantidad;
        $cristaleria->descripcion=$request->descripcion;
        $cristaleria->imagen=$request->imagen;

        $cristaleria->save();
        }else{
             $cristaleria= Cristaleria::findOrFail($request->id_cristaleria)->decrement('cantidad',$request->cantidad_danados);

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
        $cristaleria = Cristaleria::findOrFail($id);

        $cristaleria->delete();

    }
    public function desactivar(Request $request)
    {
        $cristaleria = Cristaleria::findOrFail($request->id_cristaleria);
        $cristaleria->condicion ='0';
        $cristaleria->save();
    }
    public function activar(Request $request)
    {
        $cristaleria = Cristaleria::findOrFail($request->id_cristaleria);
        $cristaleria->condicion ='1';
        $cristaleria->save();
    }
}
