<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{$article->title}}</title>
	<meta tag="{{$article->title}}">
	<link rel="stylesheet" href="{{asset('css/style.css')}} ">
	<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}} ">
	<script src="{{asset('bootstrap/js/jquery-2.1.1.min.js')}} "></script>
	<script src="{{asset('bootstrap/js/bootstrap.js')}} "></script>
</head>
<body>

 <br>
 <h1>{{$article->title}}</h1>
 <hr>
 {{$article->content}}
 <hr> {{$article->user->name}} | {{$article->category->name}} |


 @foreach($article->tags as $tag)
 	{{$tag->name}}
 @endforeach


</body>
</html>