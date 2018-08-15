<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Danados;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
class danadosController extends Controller
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
            $danados = Danados::orderBy('id_danados','desc')->paginate(10);
            }else{
               $danados = Danados::where('nombre','like','%'.$buscar.'%')->orderBy('id_danados','desc')->paginate(10);
           }

        return [
          'pagination'=>[
              'total' => $danados->total(),
              'current_page' => $danados->currentPage(),
              'per_page' => $danados->perPage(),
              'last_page' => $danados->LastPage(),
              'from' => $danados->firstItem(),
              'to' => $danados->LastItem(),
          ],
            'danados'=>$danados
        ];
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $danados = new Danados();
        $danados->nombre=$request->nombre;
        $danados->cantidad=$request->cantidad;
        $danados->descripcion=$request->descripcion;
        $danados->imagen=$request->imagen;
        $danados->save();
    }

    public function pdfDescargar()
    {    
        $formatoPdf = Danados::all();
        $reposiciones2 = \PDF::loadView('formatoPdf', compact('formatoPdf'));
        return $reposiciones2->download('reposicion.Pdf');
    }

    public function pdfVer()
    {   
        $danados = $_GET[id_danados];
        $formatoPdf = danados::findOrFail($danados);
        return view('formatoPdf', compact('formatoPdf'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
