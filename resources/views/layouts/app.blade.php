<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog Project">
    <meta name="author" content="Marti2203">
    <link rel="icon" href="favicon.ico">

    <title>Skriblr - @yield('title')</title>

	<link href="{{url('css/app.css')}}" rel="stylesheet">
	
	@yield('sheet')
	
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{url('css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">
    
    <link href="{{url('css/simple-sidebar.css')}}" rel="stylesheet">
    
    <style>
		body{padding-top:50px}.starter-template{padding:40px 15px;}
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('{{url('fonts/glyphicons-halflings-regular.eot')}}');
            src: url('{{url('fonts/glyphicons-halflings-regular.eot')}}#iefix') format('embedded-opentype'),
            url('{{url('fonts/glyphicons-halflings-regular.woff')}}') format('woff'),
            url('{{url('/fonts/glyphicons-halflings-regular.woff2')}}') format('woff2'),
			url('{{url('fonts/glyphicons-halflings-regular.ttf')}}') format('truetype'),
			url('{{url('fonts/glyphicons-halflings-regular.sv')}}g#proxima_nova_rgitalic') format('svg');
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
			        @if (Auth::check())
						<li><a href="{{ url('/blogger/'.Auth::id()) }}">Home</a></li>
						<li><a href="{{ url('/post/create')}}">Create Post</a></li>
                        <li><a href="{{ url('/logout') }}">Logout</a></li>
                    @else
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @endif
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
                @foreach (App\Tag::orderBy('reference_count','desc')->take(10)->get() as $tag)
                <li class="active">
				<a href="{{url('search',['tag'=>$tag->name])}}">{{$tag->name}}</a>
                </li>
                @endforeach
                
                @php $count=0; $yearShown=false ;$start=Carbon\Carbon::now(); $end=Carbon\Carbon::parse(Config::get('constants.creationDate')); @endphp

				@while($count!=10 && $start->gt($end))
				
				@if (!$yearShown)
				<li class="sidebar-brand active"><a href="{{url('search',['year'=>$start->year])}}">{{$start->year}}</a></Li>
				@php $yearShown=true; @endphp
				@endif
				
				@if(App\Post::whereYear('created_at',$start->year)->whereMonth('created_at',$start->month)->count()>1 )
				
				<li><a href="{{url('search',['year'=>$start->year,'month'=>$start->month])}}">{{ $start->format('F') }}</a></li>
				
				@php $count++; @endphp
				@endif
				
				@php if($start->month==1) $yearShown=false;  $start->subMonth(); @endphp
				@endwhile
				<li>End</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
				<div class="container body-content" id="main-body">		
							@yield('content')
							<hr />
							
								<footer>
								<p>Skriblr &copy;</p>
								</footer>
                                
                                </div>
                                </div>
                                </div>
        <!-- /#page-content-wrapper -->
        
    <script src="{{url('js/app.js')}}"></script>
    <script src="{{url('js/ie10-viewport-bug-workaround.js')}}"></script>
        <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    @yield('script')
    </script>
  </body>
</html>
