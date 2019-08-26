<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    //
    public function index (Request $request) {
    	$tags=Tag::search($request->name)->orderBy('id','ASC')->paginate(12);
    	return view('admin.tags.index')->with('tags',$tags);
    }

    public function create() {
    	return view('admin.tags.create');
    }

    public function store(TagRequest  $request) {
    	$tag=new Tag($request->all());
    	$tag->save();
    	return redirect()->route('admin.tags.index');
    }

    public function edit($id) {
		$tag=Tag::find($id);
		return view('admin.tags.edit')->with('tag',$tag);
    }

    public function show($id) {

    }
    public function destroy($id) {
    	$tag=Tag::find($id);
    	$tag->delete();
    	return redirect()->route('admin.tags.index');
    }
    public function update(Request $request, $id) {
    	$tag=Tag::find($id);
    	$tag->fill($request->all());
    	$tag->save();
    	return redirect()->route('admin.tags.index');
    }
 }

