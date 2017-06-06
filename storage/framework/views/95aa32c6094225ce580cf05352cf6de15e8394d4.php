	<p class="text-center"> <?php echo e($title); ?></p>

<?php echo e(Form::open(array('action' => $action,'method'=>'get'))); ?>

    <div class="input-group">
      <span class="input-group-btn">
        <button  type="submit" class="btn btn-default" type="button">Find!</button>
      </span>
      <input type="text" name="name" class="form-control" placeholder="Search for <?php echo e($type); ?>">
    </div><!-- /input-group -->
<?php echo e(Form::close()); ?>

