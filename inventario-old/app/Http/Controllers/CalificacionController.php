<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Calificacion;
use App\Alumno;

class CalificacionController extends Controller
{
     public function store(Request $request) {
    	$calificacion = new Calificacion($request->all());
    	$calificacion->save();
        return view('admin.calificacion.create');
    }

    public function index() {
    	$calificacion=Calificacion::orderBy('id','ASC')->paginate(12);
        $calificacion->each(function($calificacion){
           $calificacion->alumno;
       });
        return view('admin.calificacion.index')->with('calificacion',$calificacion);
    }
    public function lista() {
        $calificacion=Calificacion::orderBy('id','ASC')->paginate(12);
        $calificacion->each(function($calificacion){
           $calificacion->alumno;
       });
        return view('admin.calificacion.lista')->with('calificacion',$calificacion);
    }

    public function create() {
    	return view('admin.calificacion.create');
    }

    public function edit($id) {
    	$calificacion=Calificacion::find($id);
        $array=['0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0'];
        if($calificacion->calificacion=="") {
            return view('admin.calificacion.edit')
            ->with('array',$array)
            ->with('calificacion',$calificacion);        
        }
        else{
        $array=explode(',',$calificacion->calificacion,20);
        return view('admin.calificacion.edit')
        ->with('array',$array)
        ->with('calificacion',$calificacion);
        }
    }

    public function update (Request $request, $id) {
        $calificacion=Calificacion::find($id);
        $calificacion->fill($request->all());
        $calificacion->save();
        return redirect()->route('admin.calificacion.index');
    }

    public function destroy ($id) {
         $calificacion=Calificacion::find($id);
         $calificacion->delete();
         return redirect()->route('admin.calificacion.index');
    }
    public function show($id){

    }
    public function pdf_id($id){
        $calificacion=Calificacion::find($id);
        //$array=explode(',',$calificacion->calificacion,20);
        $data = $calificacion;
        $data->array=explode(',',$calificacion->calificacion,20);
        $date = date('Y-m-d');
        $invoice = $data->id;
        $view =  \View::make('admin.calificacion.pdf_id', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('admin.calificacion.pdf_id');
    }
    public function pdf_all($id){
        $calificacion=Calificacion::all();
        $calificacion->each(function($calificacion){
           $calificacion->calificacion=explode(',',$calificacion->calificacion,20);
       });
        $data = $calificacion;
        //dd($data);
        $date = date('Y-m-d');
        $invoice = "1";
        $view =  \View::make('admin.calificacion.pdf_all', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('admin.calificacion.pdf_all');
    }
}
