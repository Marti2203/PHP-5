@extends('layouts.app')

@section('title','Main')

@section('content')


<div class="row">
<div class="col-md-6">
	{!! view('layouts.searchForm')->with(['title'=>'Find Blog of User','type'=>'User','action'=>'PostController@viewName']) !!}
</div>

<div class="col-md-6">
	{!! view('layouts.searchForm')->with(['title'=>'Search Tags','type'=>'Tag','action'=>'PostController@search']) !!}
</div>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Most Popular Tags</div>
  <table class="table">
	  <tr>
		  <th></th>
		  @if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
		  <th></th>
		  <th></th>
		  @endif
		  <th>Count</th></tr>	
   @foreach (App\Tag::orderBy('reference_count','desc')->take(20)->get() as $tag) 
   <tr>
   <th><a href="{{url('/search',['tag'=>$tag->name])}}">{{$tag->name}}</a></th>
   @if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
   <th><a href="{{url('/admin/delete/tag',['id'=>$tag->id])}}">Delete</a></th>
   <th><a href="{{url('/admin/edit/tag',['id'=>$tag->id])}}">Edit</a></th>
   @endif
   <th>{{$tag->reference_count}}</th>
   </tr>

   @endforeach
      
  </table>
</div>

@endsection
