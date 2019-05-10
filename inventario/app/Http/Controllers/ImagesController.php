<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Image;
Use Illuminate\Support\Facades\Redirect;

class ImagesController extends Controller
{
    public function index(Request $request) {
    	
    	$images=Image::orderBy('id','ASC')->paginate(6);
        $images->each(function($images){
            $images->article;
        });
        //dd($images->article);
    	return view('admin.images.index')->with('images',$images);
    }
}
