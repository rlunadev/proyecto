<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Nota;
class NotasController extends Controller
{
     public function index(){
     	$notass = Nota::orderBy('id','ASC')->paginate(12);
    	return view('admin.notas.index')->with('notass',$notass);
    }

      public function create() {
    	return view('admin.notas.create');
    }
   
    public function destroy ($id) {
         $notas=Nota::find($id);
         $notas->delete();
         return redirect()->route('admin.notas.index');
    }
    public function edit($id) {
        $notas=Nota::find($id);
        return view('admin.notas.edit')->with('notas',$notas);
    }
    public function update (Request $request, $id) {
        $notas=Nota::find($id);
        $notas->name=$request->name;
        $notas->save();
        return redirect()->route('admin.notas.index');
    }
}
