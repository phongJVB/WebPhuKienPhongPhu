<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Laravel </title>
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Dosis:300,400' >
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:400,300'>
	<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/vendors/colorbox/example3/colorbox.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/rs-plugin/css/settings.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/rs-plugin/css/responsive.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontEnd/assets/dest/css/huong-style.css') }}">
</head>
<body>

	<!-- Header -->
	@include('layouts.header')

	<!-- Content -->
	@yield('content') 

	<!-- Footer -->
	@include('layouts.footer')

	<!-- include js files -->
	<script src="{{ asset('frontEnd/assets/dest/js/jquery.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/jqueryui/jquery-ui-1.10.4.custom.min.js') }}"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/bxslider/jquery.bxslider.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/colorbox/jquery.colorbox-min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/animo/Animo.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/vendors/dug/dug.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/scripts.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/waypoints.min.js') }}"></script>
	<script src="{{ asset('frontEnd/assets/dest/js/wow.min.js') }}"></script>
	<!--customjs-->
	<script src="{{ asset('frontEnd/assets/dest/js/custom2.js') }}"></script>
	<script>
			$(document).ready(function($) {    
				$(window).scroll(function(){
					if($(this).scrollTop()>150){
						$(".header-bottom").addClass('fixNav')
					}else{
						$(".header-bottom").removeClass('fixNav')
					}}
					)
			})
	</script>
</body>
</html>
