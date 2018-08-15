<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mueble;

class muebleController extends Controller
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
            $mueble = Mueble::orderBy('id_mueble','desc')->paginate(10);
            }else{
               $mueble = Mueble::where('nombre','like','%'.$buscar.'%')->orderBy('id_mueble','desc')->paginate(10);
           }

        return [
          'pagination'=>[
              'total' => $mueble->total(),
              'current_page' => $mueble->currentPage(),
              'per_page' => $mueble->perPage(),
              'last_page' => $mueble->LastPage(),
              'from' => $mueble->firstItem(),
              'to' => $mueble->LastItem(),
          ],
            'mueble'=>$mueble
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
        $mueble = new Mueble();
        $mueble->nombre=$request->nombre;
        $mueble->cantidad=$request->cantidad;
        $mueble->descripcion=$request->descripcion;
        $mueble->imagen=$request->imagen;

        $mueble->save();
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
        $mueble = Mueble::findOrFail($request->id_mueble);
        $mueble->nombre=$request->nombre;
        $mueble->cantidad=$request->cantidad;
        $mueble->descripcion=$request->descripcion;
        $mueble->imagen=$request->imagen;

        $mueble->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mueble = Mueble::findOrFail($id);

        $mueble->delete();
    }
    public function desactivar(Request $request)
    {
        $mueble = Mueble::findOrFail($request->id_mueble);
        $mueble->condicion ='0';
        $mueble->save();
    }
    public function activar(Request $request)
    {
        $mueble = Mueble::findOrFail($request->id_mueble);
        $mueble->condicion ='1';
        $mueble->save();
    }
}
