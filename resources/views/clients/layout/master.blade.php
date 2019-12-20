
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic page needs
  ============================================ -->
  <base href="{{ asset('') }}">
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
	<!-- <link href="css/themecss/slider.css" rel="stylesheet"> -->
	<link id="color_scheme" href="clients/css/home3.css" rel="stylesheet">
	<link href="clients/css/responsive.css" rel="stylesheet">
  <!-- ============================================ -->
  <style>
  .removeToWishList{
    color: red !important;
  }
  </style>
  @yield('css')
</head>

<body class="common-home res layout-home3">
  <div id="wrapper" class="wrapper-full banners-effect-7">
  <!-- Header Container  -->
  @include('clients.layout.header')
  <!-- //Header Container  -->
  <!-- Main Container  -->
  <main id="content" class="page-main">
    <div class="so-spotlight1">
      <div class="container">
        <div class="row">
          {{-- content --}}
          @yield('content')
        </div>
      </div>
    </div>  
    <!-- List services  -->
    @include('clients.layout.list_services')
    
  </main >
  <!-- //Main Container -->

  <script type="text/javascript">
    var $typeheader = 'header-home3';
  </script>
  <!-- Footer Container -->
  @include('clients.layout.footer')
  <!-- //end Footer Container -->

  </div>
<!-- Social widgets -->
{{-- @include('clients.layout.social') --}}
<!-- End Social widgets -->

<!-- Cpanel Block -->	
<div id="sp-cpanel" class="sp-delay">
  <h2 class="sp-cpanel-title"> Demo Options <span class="sp-cpanel-close"> <i class="fa fa-times"> </i></span></h2>
  <div id="sp-cpanel_settings">
    <div class="panel-group ">
      <label>Header style</label>
      <div class="group-boxed">
        <select id="change_header_type" name="cpheaderstype" class="form-control" onchange="headerTypeChange(this.value);">
          <option value="header-home3" >Header 3</option>
        </select>
      </div>
    </div>
  </div>
</div>

<link rel='stylesheet' property='stylesheet'  href='clients/css/themecss/cpanel.css' type='text/css' media='all' />

<!-- Preloading Screen -->
{{-- @include('clients.layout.loading') --}}
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
<script type="text/javascript" src="clients/js/themejs/toppanel.js"></script>
<script type="text/javascript" src="clients/js/themejs/so_megamenu.js"></script>

<script type="text/javascript" src="clients/js/themejs/accordion.js"></script>	
<script type="text/javascript" src="clients/js/themejs/cpanel.js"></script>


<!-- FILE CART LOCALSTORAGE
============================================ -->
<script type="text/javascript" src="clients/js/CART.js"></script>
@if (Auth::check())
@include('clients.user.wish_list_ajax')
@endif
<script>
$(document).ready(function(){
  //here
  $('.hover').removeClass('home');
  $("#@yield('id-active-page')").addClass('home');
})
</script>
@yield('js')
</body>
</html>