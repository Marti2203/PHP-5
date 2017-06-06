@extends('layouts.app')

@section('title','View Profile')

@section('content')

{{ Storage::url('text.txt')}}

<a href="storage/text.txt">Test</a>

<h4> Username:</h4><p>{{ $user->username}}</p>

<h4> Date Of Birth:</h4><p > {{ $user->date_of_birth }}</p>

<h4> Address:</h4><p> {{ $user->email()->address }}</p>

<h4> Gender:</h4><p >{{ $user->gender()->gender}}</p>

@if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))

<h4>Adiministration Level:</h4><p class="navbar-text">{{ $user->adiministration_level}}</p>

<a class="btn btn-default" href="{{url('admin/delete/user',['id'=>$user->id])}}">Remove User</a>
<a class="btn btn-default" href="{{url('admin/edit/user',['id'=>$user->id])}}">Edit User</a>
@endif



@endsection
