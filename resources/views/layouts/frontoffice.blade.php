<!doctype html>
<html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{ config('app.name', 'Laravel') }}">
  
  <meta name="author" content="Anon">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/bootstrap/css/bootstrap.min.css') }}">
  <!-- Icon Font Css -->
  <link rel="stylesheet" href="{{ asset('backoffice/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/themify/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/fontawesome/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/magnific-popup/dist/magnific-popup.css') }}">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/slick-carousel/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('frontoffice/plugins/slick-carousel/slick/slick-theme.css') }}">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="{{ asset('frontoffice/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontoffice/css/custom.css') }}">

  <!-- Page plugins -->
  @stack('plugin_css')

  @stack('style')
</head>

<body>

<!-- Header Start --> 
<header class="navigation">
	<nav class="navbar navbar-expand-lg  py-4" id="navbar">
		<div class="container">
		  <a class="navbar-brand" href="{{ route('app.home') }}">
		  	Digital <span>Interactive.</span>
		  </a>

          @guest

          @else
          <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>
          
		  <div class="collapse navbar-collapse text-center" id="navbarsExample09">
			<ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('app.home') }}">Beranda <span class="sr-only">(current)</span></a>
                </li>
			  <!-- <li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About</a>
					<ul class="dropdown-menu" aria-labelledby="dropdown03">
						<li><a class="dropdown-item" href="about.html">Our company</a></li>
						<li><a class="dropdown-item" href="pricing.html">Pricing</a></li>
					</ul>
			  </li> -->
			    <li class="nav-item">
                   <a class="nav-link" href="{{ route('app.mapel.list') }}">Mata Pelajaran</a>
                </li>
			    <li class="nav-item">
                    <a class="nav-link" href="{{ route('app.nilai-simulasi') }}">Nilai Simulasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('app.akun-saya') }}">Akun Saya</a>
                </li>
			</ul>

			<form action="{{ route('logout') }}" class="form-lg-inline my-2 my-md-0 ml-lg-4 text-center" method="POST">
                @csrf
			  <button class="btn btn-solid-border btn-round-full">Keluar</button>
			</form>
		  </div>

          @endguest
		</div>
	</nav>
</header>

<!-- Header Close --> 

<div class="main-wrapper">
    @yield('content')

    <!-- footer Start -->
    @include('layouts.partials.frontoffice.footer')
    <!-- Footer end -->
</div>

    <!-- 
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="{{ asset('frontoffice/plugins/jquery/jquery.js') }}"></script>
    <!-- App.js -->
    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    <!-- Bootstrap 4.3.1 -->
    <script src="{{ asset('frontoffice/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontoffice/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

   <!--  Magnific Popup-->
    <script src="{{ asset('frontoffice/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <!-- Slick Slider -->
    <script src="{{ asset('frontoffice/plugins/slick-carousel/slick/slick.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('frontoffice/plugins/counterup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontoffice/plugins/counterup/jquery.counterup.min.js') }}"></script>   
    
    <script src="{{ asset('frontoffice/js/script.js') }}"></script>

    @stack('plugin_script')

    @stack('script')
  </body>
</html>