<?php $__env->startSection('title','Main'); ?>

<?php $__env->startSection('script'); ?>

        $(document).ready(function() {
            $('.add-to-collection').on('click', function(e) {
                e.preventDefault();
                var container = $('.collection-container');
                var count = container.children().length;
                var proto = container.data('prototype').replace(/__NAME__/g, count);
                container.append(proto);
            });
        });

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

    <?php echo form_start($form); ?>

    
    <?php echo form_row($form->title); ?>

    
    <?php echo form_row($form->text); ?>

    
    <div class="collection-container" data-prototype="<?php echo e(form_row($form->tags->prototype())); ?>">
        <?php echo form_row($form->tags); ?>

    </div>
	
<div class="row">
	<div class="col-md-4">
	    <button type="button" class="add-to-collection form-control">Add Tag</button>
	</div>
	
	<div class="col-md-4">
		<?php echo form_row($form->submit); ?>

	</div>

	<div class="col-md-4">
		<?php echo form_row($form->clear); ?>

	</div>
</div>	

    <?php echo form_end($form); ?>


</div>

<div class="col-md-4"> 
<?php echo view('post.cheatsheet'); ?>

</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>