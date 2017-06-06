@extends('layouts.app')

@section('title','Main')

@section('script')

        $(document).ready(function() {
            $('.add-to-collection').on('click', function(e) {
                e.preventDefault();
                var container = $('.collection-container');
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, count);
                container.append(proto);
            });
        });

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

    {!! form_start($form) !!}
    
    {!! form_row($form->title) !!}
    
    {!! form_row($form->text) !!}
    
    <div class="collection-container" data-prototype="{{ form_row($form->tags->prototype()) }}">
        {!! form_row($form->tags) !!}
    </div>
	
<div class="row">
	<div class="col-md-4">
	    <button type="button" class="add-to-collection form-control">Add Tag</button>
	</div>
	
	<div class="col-md-4">
		{!! form_row($form->submit) !!}
	</div>

	<div class="col-md-4">
		{!! form_row($form->clear) !!}
	</div>
</div>	

    {!! form_end($form) !!}

</div>

<div class="col-md-4"> 
{!! view('post.cheatsheet') !!}
</div>
</div>

@endsection
