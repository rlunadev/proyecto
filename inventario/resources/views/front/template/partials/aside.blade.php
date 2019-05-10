<div class="col-md-12">
      	<div class="panel panel-red">
           <div class="panel-heading">
              <h3 class="panel-title">Categorias</h3>
           </div>
           <div class="panel-body">
              <div class="list-group">
              @foreach($categories as $category)
              
                <li class="list-group-item">
                  <span class="badge">{{$category->articles->count()}}</span>
                  <a href="{{route('front.search.category',$category->name) }}">
                    {{$category->name}}
                  </a>
                </li> 
              @endforeach             
              </div>
           </div>
         </div>
      </div>
      <div class="col-md-12">
      	<div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title"> IDIOMAS</h3>
            </div>
            <div class="panel-body">
            @foreach($tags as $tag)
                  <a href="{{route('front.search.tag',$tag->name)}}">
                    <button type="button" class="btn btn-xs btn-primary">{{$tag->name}}</button>
                  </a>
               @endforeach   
            </div>
          </div>
      </div>