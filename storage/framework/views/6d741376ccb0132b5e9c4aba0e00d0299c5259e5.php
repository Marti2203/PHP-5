
<div class="row">
	<div class="col-md-8 col-md-offset-1 triangle-border left">
			  <?php echo Michelf\MarkdownExtra::defaultTransform($comment->text); ?>

      </blockquote>
	-<?php echo e($comment->visitor->username); ?> ID	:<?php echo e($comment->id); ?>

	<?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
	<a href="<?php echo e(url('admin/delete/comment',['id'=>$comment->id])); ?>">Remove Comment</a>
	<a href="<?php echo e(url('admin/edit/comment',['id'=>$comment->id])); ?>">Edit Comment</a>
	<?php endif; ?>
	</div>
</div>
