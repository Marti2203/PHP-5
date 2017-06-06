<div class="container-fluid">

<center>

{!! Michelf\MarkdownExtra::defaultTransform($post->title) !!}

<hr style="border: 3px solid gray;" >

</center>

<div markdown="1" class="center-block">
{!! Michelf\MarkdownExtra::defaultTransform($post->text) !!}

</div>

<div class="row">

<div class="col-md-4">

<a class="btn btn-default" href="{{ url('post',['id'=>$post->id])}}">View Comments</a>

@if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
<a class="btn btn-default" href="{{url('admin/delete/post',['id'=>$post->id])}}">Remove Post</a>
<a class="btn btn-default" href="{{url('admin/edit/post',['id'=>$post->id])}}">Edit Post</a>
@endif

</div>

<div class="col-md-4">
<p class="text-center">
@foreach ($post->references as $reference) 


@php $tag=$reference->tag; @endphp
<a href="{{ url('/search',['tag'=>$tag['name']]) }}" > #{{ $tag['name']  }} </a>
@if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
<a class="btn btn-default btn-sm" href="{{url('admin/delete/tag',['id'=>$tag['id']])}}">Remove Tag</a>
<a class="btn btn-default btn-sm" href="{{url('admin/delete/post/'.$post->id .'/tag/' .$tag['id'],[])}}">Remove Tag For Post</a>
<a class="btn btn-default btn-sm" href="{{url('admin/edit/tag',['id'=>$tag['id']])}}">Edit Tag</a>
<a class="btn btn-default btn-sm" href="{{url('admin/edit/post/'.$post->id .'/tag/' .$tag['id'],[])}}">Edit Tag For Post</a>
</p><p class="text-center">
@endif

@endforeach
</p>
</div>


<div class="col-md-4">
<p class="text-right">{{$post->views}}  @if ($post->views>1)Views @else View @endif </p>	
</div>


</div>
<hr>
</div>
