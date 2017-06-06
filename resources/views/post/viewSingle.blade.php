@extends('layouts.app')

@section('title','View Post')

@section('sheet')

<link rel="stylesheet" type="text/css" href="../../css/bubbles.css">

@endsection

@section('content')


<div class="row">

<div class="col-md-8">

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<center>

{!! Michelf\MarkdownExtra::defaultTransform($post->title) !!}

<hr style="border: 3px solid gray;" >

</center>

{!! Michelf\MarkdownExtra::defaultTransform($post->text) !!}

<div class="row">

<div class="col-md-4">
<p class="text-center">
@foreach ($post->references as $reference) 
@php $name=$reference->tag()->name @endphp
<a href="{{ url('/search',['tag'=> $name] 	) }}" > #{{ $name  }} </a> 
@endforeach
</p>
</div>

<div class="col-md-4">
	 @if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
	<a class="btn btn-default btn-sm" href="{{url('admin/delete/post',['id'=>$post->id])}}">Remove Post</a>
	<a class="btn btn-default btn-sm" href="{{url('admin/edit/post',['id'=>$post->id])}}">Edit Post</a>
	@endif
</div>

<div class="col-md-4">
@php $post->views++; $post->save(); @endphp
<blockquote>
<p class="text-right">{{$post->views}}  @if ($post->views>1)Views @else View @endif </p>	
</blockquote>
</div>

<div class="form-group">

<form method="POST" action="{{url('comment/create')}}">
    {{ csrf_field() }}
    
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input type="hidden" name="post_user_id" value="{{$post->user->id}}">
    
		<div class="col-md-4">
        <label for="comment" class="control-label">Comment</label>
        <textarea name="comment" class="form-control" maxlength="200"></textarea>
        </div>
        
        <div class="col-md-4">
        <label for="username" class="control-label">Userame</label>
        <input type="text"  required="required" maxlength="45"  class="form-control" id="username" name="username">
        </div>
        
        <div class="col-md-4">
        <label for="email" class="control-label">Email</label>
        <input type="text" maxlength="45" class="form-control" name="email" id="email">
        <p class="help-block">Secure Username for yourself by adding an email</p>
        </div>


		<div class="col-md-3 center-block">
		<button class="btn btn-default" type="submit">Create Comment</button>
		<button class="btn btn-default" type="reset">Clear</button>
		</div>

</form>	

</div>

</div>

<hr/>
<h3>Comments : {{$post->comments()->count()}}</h3>


@each('comment.viewSingle', $post->comments()->orderBy('id','desc')->get(), 'comment','comment.empty')


</div>

<div class="col-md-4"> 
{!! view('post.cheatsheet') !!}
</div>

</div>


@endsection
