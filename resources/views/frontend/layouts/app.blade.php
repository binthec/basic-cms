<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>転倒予防教室｜Oita</title>
	<!-- core CSS -->
    <link href="/frontend/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/animate.min.css" rel="stylesheet">
    <link href="/frontend/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/frontend/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="/frontend/assets/css/main.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/frontend/assets/js/html5shiv.js"></script>
    <script src="/frontend/assets/js/respond.min.js"></script>
    <![endif]-->

  </head><!--/head-->

  <body id="home" class="homepage">

	@yield('content')

    <footer id="footer">
	  <div class="container text-center">
		All rights reserved &copy; 2017 | <a href="http://www.pfind.com/goodies/bizexpress/">BizExpress Template</a> from <a href="http://www.pfind.com/goodies/">pFind.com</a>
	  </div>
    </footer><!--/#footer-->

    <script src="/frontend/assets/js/jquery.js"></script>
    <script src="/frontend/assets/js/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="/frontend/assets/js/owl.carousel.min.js"></script>
    <script src="/frontend/assets/js/mousescroll.js"></script>
    <script src="/frontend/assets/js/smoothscroll.js"></script>
    <script src="/frontend/assets/js/jquery.prettyPhoto.js"></script>
    <script src="/frontend/assets/js/jquery.isotope.min.js"></script>
    <script src="/frontend/assets/js/jquery.inview.min.js"></script>
    <script src="/frontend/assets/js/wow.min.js"></script>
    <script src="/frontend/assets/js/main.js"></script>
	<script src="/frontend/assets/js/scrolling-nav.js"></script>
	<script>

		$(document).ready(function ($) {
		  $("#owl-example").owlCarousel();
		});

		$("body").data("page", "frontpage");

		$("#owl-example").owlCarousel({
		  items: 3,
		  /*        itemsDesktop : [1199,3],
		   itemsDesktopSmall : [980,9],
		   itemsTablet: [768,5],
		   itemsTabletSmall: false,
		   itemsMobile : [479,4]*/
		})

    </script>
  </body>
</html>