@extends('layouts.app')

@section('title',$title)

@section('content')

<style>
p.round {
    border: 2px solid gray;
    border-radius: 5px;
}

</style>

<h1>{{$title}}</h1>

@each('post.view', $posts, 'post','post.empty')


@if ($hasMore==true)  
<ul class="pager">
	@if ($chunk!=0)
	 <li>
		<a href="{{ url($action,['tag'=>$tag,'chunk'=>($chunk -1),'size'=>$size]) }}">Previous Posts</a>
	</li>
	@endif
    <li>
		<a href="{{ url($action,['tag'=>$tag,'chunk'=>($chunk +1),'size'=>$size]) }}">Next Posts</a>
	</li>
</ul> 
@endif
@endsection
