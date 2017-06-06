<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog Project">
    <meta name="author" content="Marti2203">
    <link rel="icon" href="favicon.ico">

    <title>Skriblr - <?php echo $__env->yieldContent('title'); ?></title>

	<link href="<?php echo e(url('css/app.css')); ?>" rel="stylesheet">
	
	<?php echo $__env->yieldContent('sheet'); ?>
	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo e(url('css/ie10-viewport-bug-workaround.css')); ?>" rel="stylesheet">
    
    <link href="<?php echo e(url('css/simple-sidebar.css')); ?>" rel="stylesheet">
    
    <style>
		body{padding-top:50px}.starter-template{padding:40px 15px;}
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('<?php echo e(url('fonts/glyphicons-halflings-regular.eot')); ?>');
            src: url('<?php echo e(url('fonts/glyphicons-halflings-regular.eot')); ?>#iefix') format('embedded-opentype'),
            url('<?php echo e(url('fonts/glyphicons-halflings-regular.woff')); ?>') format('woff'),
            url('<?php echo e(url('/fonts/glyphicons-halflings-regular.woff2')); ?>') format('woff2'),
			url('<?php echo e(url('fonts/glyphicons-halflings-regular.ttf')); ?>') format('truetype'),
			url('<?php echo e(url('fonts/glyphicons-halflings-regular.sv')); ?>g#proxima_nova_rgitalic') format('svg');
        }
 </style>
    </style>
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">Skriblr</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
			<li class="active"><a href="#menu-toggle" id="menu-toggle">Toggle Dashboard</a></li>
			        <?php if(Auth::check()): ?>
						<li><a href="<?php echo e(url('/blogger/'.Auth::id())); ?>">Home</a></li>
						<li><a href="<?php echo e(url('/post/create')); ?>">Create Post</a></li>
                        <li><a href="<?php echo e(url('/logout')); ?>">Logout</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(url('/login')); ?>">Login</a></li>
                        <li><a href="<?php echo e(url('/register')); ?>">Register</a></li>
                    <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
	
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav" >
                <li class="sidebar-brand">
                        Dashboard
                </li>
                <?php $__currentLoopData = App\Tag::orderBy('reference_count','desc')->take(10)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="active">
				<a href="<?php echo e(url('search',['tag'=>$tag->name])); ?>"><?php echo e($tag->name); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php  $count=0; $yearShown=false ;$start=Carbon\Carbon::now(); $end=Carbon\Carbon::parse(Config::get('constants.creationDate'));  ?>

				<?php while($count!=10 && $start->gt($end)): ?>
				
				<?php if(!$yearShown): ?>
				<li class="sidebar-brand active"><a href="<?php echo e(url('search',['year'=>$start->year])); ?>"><?php echo e($start->year); ?></a></Li>
				<?php  $yearShown=true;  ?>
				<?php endif; ?>
				
				<?php if(App\Post::whereYear('created_at',$start->year)->whereMonth('created_at',$start->month)->count()>1 ): ?>
				
				<li><a href="<?php echo e(url('search',['year'=>$start->year,'month'=>$start->month])); ?>"><?php echo e($start->format('F')); ?></a></li>
				
				<?php  $count++;  ?>
				<?php endif; ?>
				
				<?php  if($start->month==1) $yearShown=false;  $start->subMonth();  ?>
				<?php endwhile; ?>
				<li>End</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
				<div class="container body-content" id="main-body">		
							<?php echo $__env->yieldContent('content'); ?>
							<hr />
							
								<footer>
								<p>Skriblr &copy;</p>
								</footer>
                                
                                </div>
                                </div>
                                </div>
        <!-- /#page-content-wrapper -->
        
    <script src="<?php echo e(url('js/app.js')); ?>"></script>
    <script src="<?php echo e(url('js/ie10-viewport-bug-workaround.js')); ?>"></script>
        <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    <?php echo $__env->yieldContent('script'); ?>
    </script>
  </body>
</html>
