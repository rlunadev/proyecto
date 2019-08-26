<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Alumno;
use App\Calificacion;
Use Illuminate\Support\Facades\Redirect;
use Dompdf\Dompdf;
use DB;
//jwt
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AlumnoController extends Controller
{
    public function store(Request $request) {

$token=JWTAuth::fromUser($request);

dd($token);
        $alumno = new Alumno($request->all());
        $alumno->save();
       for ($i=0; $i <2 ; $i++) { 
            if($i==1){
            $calificacion = new Calificacion($request->all());
            $id_al=Alumno::orderBy('id','DESC')->paginate(1)->lists('id');
            $calificacion->tipo=2;
            $calificacion->id_alumnos=$id_al[0];
            $calificacion->save();
            }
            else{
            $calificacion = new Calificacion($request->all());
            $id_al=Alumno::orderBy('id','DESC')->paginate(1)->lists('id');
            $calificacion->id_alumnos=$id_al[0];
            $calificacion->save();
            }
       }
        
    return redirect()->route('admin.calificacion.index');
    }

    public function index() {
        
        $alumno = DB::table('alumnos')
            ->join('calificaciones', 'calificaciones.id_alumnos', '=', 'alumnos.id')
            ->select('alumnos.*', 'calificaciones.nota_total')
            ->get();
    	return view('admin.alumno.index')->with('alumno',$alumno);
    }
    public function lista() {
        $alumno=Alumno::orderBy('id','ASC')->paginate(12);
        return view('admin.alumno.lista')->with('alumno',$alumno);
    }

    public function create() {
    	return view('admin.alumno.create');
    }

    public function edit($id) {
    	$alumno=Alumno::find($id);
        return view('admin.alumno.edit')
        ->with('alumno',$alumno);
    }

    public function update (Request $request, $id) {
        $alumno=Alumno::find($id);
        $alumno->fill($request->all());
        $alumno->save();
        return redirect()->route('admin.alumno.index');
    }

    public function destroy ($id) {
         $alumno=Alumno::find($id);
         $alumno->delete();
         return redirect()->route('admin.alumno.index');
    }
    public function show($id){

    }
    public function pdf_id($id){
        $alumno=Alumno::find($id);
        $data = $alumno;
        $date = date('Y-m-d');
        $invoice = $data->id;
        $view =  \View::make('admin.alumno.pdf_id', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('admin.alumno.pdf_id');
    }
    public function pdf_all($id){
        $alumno = DB::table('alumnos')
            ->join('calificaciones', 'calificaciones.id_alumnos', '=', 'alumnos.id')
            ->select('alumnos.*', 'calificaciones.nota_total')
            ->get();
        $data = $alumno;
        $date = date('Y-m-d');
        $invoice = "1";
        $view =  \View::make('admin.alumno.pdf_all', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('admin.alumno.pdf_all');
    }
}
