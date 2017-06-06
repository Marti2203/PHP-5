<?php $__env->startSection('title','View Post'); ?>

<?php $__env->startSection('sheet'); ?>

<link rel="stylesheet" type="text/css" href="../../css/bubbles.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">

<div class="col-md-8">

<?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<center>

<?php echo Michelf\MarkdownExtra::defaultTransform($post->title); ?>


<hr style="border: 3px solid gray;" >

</center>

<?php echo Michelf\MarkdownExtra::defaultTransform($post->text); ?>


<div class="row">

<div class="col-md-4">
<p class="text-center">
<?php $__currentLoopData = $post->references(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<?php  $name=$reference->tag()->name  ?>
<a href="<?php echo e(url('/search',['tag'=> $name] 	)); ?>" > #<?php echo e($name); ?> </a> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</p>
</div>

<div class="col-md-4">
	 <?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
	<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/delete/post',['id'=>$post->id])); ?>">Remove Post</a>
	<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/edit/post',['id'=>$post->id])); ?>">Edit Post</a>
	<?php endif; ?>
</div>

<div class="col-md-4">
<?php  $post->views++; $post->save();  ?>
<blockquote>
<p class="text-right"><?php echo e($post->views); ?>  <?php if($post->views>1): ?>Views <?php else: ?> View <?php endif; ?> </p>	
</blockquote>
</div>

<div class="form-group">

<form method="POST" action="<?php echo e(url('comment/create')); ?>">
    <?php echo e(csrf_field()); ?>

    
    <input type="hidden" name="post_id" value="<?php echo e($post->id); ?>">
    <input type="hidden" name="post_user_id" value="<?php echo e($post->user->id); ?>">
    
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
<h3>Comments : <?php echo e($post->comments()->count()); ?></h3>


<?php echo $__env->renderEach('comment.viewSingle', $post->comments()->orderBy('id','desc')->get(), 'comment','comment.empty'); ?>


</div>

<div class="col-md-4"> 
<?php echo view('post.cheatsheet'); ?>

</div>

</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>