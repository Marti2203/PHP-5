<?php $__env->startSection('title','View Profile'); ?>

<?php $__env->startSection('content'); ?>

<?php echo e(Storage::url('text.txt')); ?>


<a href="storage/text.txt">Test</a>

<h4> Username:</h4><p><?php echo e($user->username); ?></p>

<h4> Date Of Birth:</h4><p > <?php echo e($user->date_of_birth); ?></p>

<h4> Address:</h4><p> <?php echo e($user->email()->address); ?></p>

<h4> Gender:</h4><p ><?php echo e($user->gender()->gender); ?></p>

<?php if(Auth::user()!=null && Auth::user()->administration_level>=Config::get('constants.administratorLevel')): ?>

<h4>Adiministration Level:</h4><p class="navbar-text"><?php echo e($user->adiministration_level); ?></p>

<a class="btn btn-default" href="<?php echo e(url('admin/delete/user',['id'=>$user->id])); ?>">Remove User</a>
<a class="btn btn-default" href="<?php echo e(url('admin/edit/user',['id'=>$user->id])); ?>">Edit User</a>
<?php endif; ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>