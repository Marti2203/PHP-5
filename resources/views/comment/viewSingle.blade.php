
<div class="row">
	<div class="col-md-8 col-md-offset-1 triangle-border left">
			  {!! Michelf\MarkdownExtra::defaultTransform($comment->text) !!}
      </blockquote>
	-{{$comment->visitor->username}} ID	:{{$comment->id}}
	@if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel'))
	<a href="{{url('admin/delete/comment',['id'=>$comment->id])}}">Remove Comment</a>
	<a href="{{url('admin/edit/comment',['id'=>$comment->id])}}">Edit Comment</a>
	@endif
	</div>
</div>
