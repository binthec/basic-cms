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
    <link href="/frontend/assets/css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]-->
    <script src="/frontend/assets/js/html5shiv.js"></script>
    <script src="/frontend/assets/js/respond.min.js"></script>
    <!--[endif]-->

    @yield('css')

</head><!--/head-->

<body>

<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">転倒予防教室</a>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="scroll"><a href="/">ホーム </a></li>
                    <li class="scroll"><a href="/#services">活動の主旨と内容 </a></li>
                    <li class="scroll"><a href="/#blog">最近の活動の様子 </a></li>
                    <li class="scroll"><a href="/#testimonial">主催者 </a></li>
                    <li class="scroll"><a href="/#get-in-touch">問い合せ </a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->

@yield('content')

<footer id="footer">
    <div class="container text-center">
        All rights reserved &copy; 2017 | <a href="http://www.pfind.com/goodies/bizexpress/">BizExpress Template</a> from
        <a href="http://www.pfind.com/goodies/">pFind.com</a>
    </div>
</footer><!--/#footer-->

<script src="/frontend/assets/js/jquery.js"></script>
<script src="/frontend/assets/js/bootstrap.min.js"></script>

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

//    $("body").data("page", "frontpage");

    $("#owl-example").owlCarousel({
        items: 3,
    })

</script>

@yield('js')

</body>
</html>