<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('content'); ?>

<style>
p.round {
    border: 2px solid gray;
    border-radius: 5px;
}

</style>

<h1><?php echo e($title); ?></h1>

<?php echo $__env->renderEach('post.view', $posts, 'post','post.empty'); ?>


<?php if($hasMore==true): ?>  
<ul class="pager">
	<?php if($chunk!=0): ?>
	 <li>
		<a href="<?php echo e(url($action,['tag'=>$tag,'chunk'=>($chunk -1),'size'=>$size])); ?>">Previous Posts</a>
	</li>
	<?php endif; ?>
    <li>
		<a href="<?php echo e(url($action,['tag'=>$tag,'chunk'=>($chunk +1),'size'=>$size])); ?>">Next Posts</a>
	</li>
</ul> 
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>