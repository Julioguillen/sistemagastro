<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Danados;
use App\Herramientas_Cocina;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        $restar = $request->restar;
        $criterio = $request->criterio;

           if($buscar ==''){
            $danados = Danados::orderBy('id_danados','desc')->paginate(10);
            }else{
               $danados = Danados::where('created_at','like','%'.$buscar.'%')->orderBy('id_danados','desc')->paginate(10);
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



    //Funciones agregadas para generar los pdf
    public function pdfDescargar()
    {
        $formatoPdf = Danados::all();
        $reposiciones2 = \PDF::loadView('formatoPdf', compact('formatoPdf'));
        return $reposiciones2->Download('reposicion.Pdf');
    }

    public function pdfVer( Request $request)
    {
        $danados = Danados::all();
         $formatoPdf = PDF::loadview('formatoPdf', ['danados'=>$danados  ]);
        return $formatoPdf->stream('archivo.pdf');
        /*
        $formatoPdf = danados::findOrFail($request->input('id'));
        return view('formatoPdf', compact('formatoPdf'));
        https://desarrolloweb.com/articulos/http-request-laravel5.html*/
    }
    //fin de funciones agregadas para generar pdf

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
