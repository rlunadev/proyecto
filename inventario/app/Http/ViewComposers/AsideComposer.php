<?php

namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
Use App\Category;
Use App\Tag;


class AsideComposer {

	public function compose(View $view) {
		$cat=Category::orderBy('nombre','DESC')->get();
		/*$tags=Tag::orderBy('name','DESC')->get();
		$view->with('categoria',$cat)
		->with('tags',$tags);*/
	}
}