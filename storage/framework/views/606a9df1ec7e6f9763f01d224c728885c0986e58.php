<div class="container-fluid">

<center>

<?php echo Michelf\MarkdownExtra::defaultTransform($post->title); ?>


<hr style="border: 3px solid gray;" >

</center>

<div markdown="1" class="center-block">
<?php echo Michelf\MarkdownExtra::defaultTransform($post->text); ?>


</div>

<div class="row">

<div class="col-md-4">

<a class="btn btn-default" href="<?php echo e(url('post',['id'=>$post->id])); ?>">View Comments</a>

<?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
<a class="btn btn-default" href="<?php echo e(url('admin/delete/post',['id'=>$post->id])); ?>">Remove Post</a>
<a class="btn btn-default" href="<?php echo e(url('admin/edit/post',['id'=>$post->id])); ?>">Edit Post</a>
<?php endif; ?>

</div>

<div class="col-md-4">
<p class="text-center">
<?php $__currentLoopData = $post->references; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reference): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 


<?php  $tag=$reference->tag;  ?>
<a href="<?php echo e(url('/search',['tag'=>$tag['name']])); ?>" > #<?php echo e($tag['name']); ?> </a>
<?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/delete/tag',['id'=>$tag['id']])); ?>">Remove Tag</a>
<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/delete/post/'.$post->id .'/tag/' .$tag['id'],[])); ?>">Remove Tag For Post</a>
<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/edit/tag',['id'=>$tag['id']])); ?>">Edit Tag</a>
<a class="btn btn-default btn-sm" href="<?php echo e(url('admin/edit/post/'.$post->id .'/tag/' .$tag['id'],[])); ?>">Edit Tag For Post</a>
</p><p class="text-center">
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</p>
</div>


<div class="col-md-4">
<p class="text-right"><?php echo e($post->views); ?>  <?php if($post->views>1): ?>Views <?php else: ?> View <?php endif; ?> </p>	
</div>


</div>
<hr>
</div>
