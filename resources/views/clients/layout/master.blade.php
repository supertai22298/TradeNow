
<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- Basic page needs
  ============================================ -->
  <base href="{{ asset('') }}">
	<title>@yield('title')</title>
	<meta charset="utf-8">
  <title>@yield('title')</title>
	<!-- Mobile specific metas
	============================================ -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	
	<!-- Favicon
	============================================ -->

  <link rel="shortcut icon" href="clients/ico/tradenow.png">
	
	<!-- Google web fonts
	============================================ -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">
    <!-- Libs CSS
	============================================ -->
  <link rel="stylesheet" href="clients/css/bootstrap/css/bootstrap.min.css">
	<link href="clients/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="clients/js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="clients/js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="clients/css/themecss/lib.css" rel="stylesheet">
	<link href="clients/js/jquery-ui/jquery-ui.min.css" rel="stylesheet">
	
	<!-- Theme CSS
	============================================ -->
  <link href="clients/css/themecss/so-megamenu.css" rel="stylesheet">
  <link href="clients/css/themecss/so-categories.css" rel="stylesheet">
	<link href="clients/css/themecss/so-listing-tabs.css" rel="stylesheet">
	<link href="clients/css/themecss/slider.css" rel="stylesheet">
	<link href="clients/css/themecss/so-super-category.css" rel="stylesheet">
	<link id="color_scheme" href="clients/css/home10.css" rel="stylesheet">
  <link href="clients/css/responsive.css" rel="stylesheet">
  
  <!-- ============================================ -->
  @yield('css')
</head>

<body class="common-home res layout-home10 pattern-28">
  <div id="wrapper" class="wrapper-boxed banners-effect-7">
    <!-- Header Container  -->
    @include('clients.layout.header')
    <!-- //Header Container  -->
		<!-- Main Container  -->
		<main id="content" class="page-main">
			<!-- Slider  -->
			@include('clients.layout.content_components.slider')
      <!-- End Slider  -->

			<!--  Main content -->
			<div class="so-spotlight3" style="margin-top:30px;">
				<div class="container">
          <!-- Content -->
          @yield('content')
          <!-- End Content -->
				</div>
      </div>
      <!-- End Main content  -->
      
      <!-- Top Sell & recommend  -->
      @include('clients.layout.content_components.recommend')
			<!-- End Top Sell & recommend  -->
		</main >
		<!-- //Main Container -->
		
    <script type="text/javascript">
			var $typeheader = 'header-home10';
		</script>
    <!-- Footer Container -->
    @include('clients.layout.footer')
    <!-- //end Footer Container -->

  </div>
  <!-- Social widgets -->
  @include('clients.layout.social')
  <!-- End Social widgets -->

	<link rel='stylesheet' property='stylesheet'  href='clients/css/themecss/cpanel.css' type='text/css' media='all' />
	
	<!-- Preloading Screen -->
	@include('clients.layout.loading')
	<!-- End Preloading Screen -->
	
	<!-- Include Libs & Plugins
	============================================ -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="clients/js/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="clients/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="clients/js/owl-carousel/owl.carousel.js"></script>
	<script type="text/javascript" src="clients/js/themejs/libs.js"></script>
	<script type="text/javascript" src="clients/js/unveil/jquery.unveil.js"></script>
	<script type="text/javascript" src="clients/js/countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="clients/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
	<script type="text/javascript" src="clients/js/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="clients/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="clients/js/jquery-ui/jquery-ui.min.js"></script>


	<!-- Theme files
	============================================ -->
	<script type="text/javascript" src="clients/js/themejs/application.js"></script>
  {{-- <script type="text/javascript" src="clients/js/themejs/toppanel.js"></script>  --}}
	<script type="text/javascript" src="clients/js/themejs/so_megamenu.js"></script>
	<script type="text/javascript" src="clients/js/themejs/addtocart.js"></script>
	<script type="text/javascript" src="clients/js/themejs/accordion.js"></script>	
  <script type="text/javascript" src="clients/js/themejs/cpanel.js"></script>
  
  <!-- ============================================ -->
  <script>
    $('.with-sub-menu').removeClass('active');
    $('.with-sub-menu').removeClass('home');
    $('#@yield("id-active")').addClass('home');
  </script>
  @yield('js')
</body>
</html>