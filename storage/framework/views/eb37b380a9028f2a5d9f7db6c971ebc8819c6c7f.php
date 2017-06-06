<?php $__env->startSection('title','Main'); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
<div class="col-md-6">
	<?php echo view('layouts.searchForm')->with(['title'=>'Find Blog of User','type'=>'User','action'=>'PostController@viewName']); ?>

</div>

<div class="col-md-6">
	<?php echo view('layouts.searchForm')->with(['title'=>'Search Tags','type'=>'Tag','action'=>'PostController@search']); ?>

</div>
</div>

<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Most Popular Tags</div>
  <table class="table">
	  <tr>
		  <th></th>
		  <?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
		  <th></th>
		  <th></th>
		  <?php endif; ?>
		  <th>Count</th></tr>	
   <?php $__currentLoopData = App\Tag::orderBy('reference_count','desc')->take(20)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
   <tr>
   <th><a href="<?php echo e(url('/search',['tag'=>$tag->name])); ?>"><?php echo e($tag->name); ?></a></th>
   <?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>
   <th><a href="<?php echo e(url('/admin/delete/tag',['id'=>$tag->id])); ?>">Delete</a></th>
   <th><a href="<?php echo e(url('/admin/edit/tag',['id'=>$tag->id])); ?>">Edit</a></th>
   <?php endif; ?>
   <th><?php echo e($tag->reference_count); ?></th>
   </tr>

   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      
  </table>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>