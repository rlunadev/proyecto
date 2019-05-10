<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

class ExcelController extends Controller
{
    //
    public function index() {
    	 Excel::create('Laravel Excel', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {
 
                $products = User::all();
 
                $sheet->fromArray($products);
 
            });
            
        })->export('xls');
// or
//->download('xls');
    }
}
