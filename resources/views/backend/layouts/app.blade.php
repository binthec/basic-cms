<!DOCTYPE html>
<html class="no-js" lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ config('app.name') }} | Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSS for Tools -->
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/vendor/AdminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/vendor/AdminLTE/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/vendor/select2/select2.css">
    <link rel="stylesheet" href="/vendor/Ionicons/css/ionicons.css">
    <link rel="stylesheet" href="/vendor/iCheck/all.css">
    <link rel="stylesheet" href="/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="/vendor/dropzone/dropzone-custom.css">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="/vendor/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="/vendor/fullcalendar/fullcalendar.print.min.css" media="print">


    {{--<link rel="stylesheet" href="/vendor/dropzone/dropzone.css">--}}

    {{--<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">--}}


    @yield('css')

    <link rel="stylesheet" href="/backend/css/custom.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini" id="@yield('bodyId')">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <span class="logo-mini"><b>Y</b></span>
            <span class="logo-lg"><b>Yobo</b>Admin</span>
        </a>

        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/backend/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"> {{ Auth::user()->name }}e</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="/backend/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                <p>{{ Auth::user()->name }}</p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li><!-- /.user-footer -->

                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- sidebar -->
    <aside class="main-sidebar">
        <section class="sidebar">

            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">メインメニュー</li>

                <li class="{{ isActiveUrl('dashboard') }}">
                    <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>

                <li class="treeview {{ isActiveUrl('topimage*') }}">
                    <a href="#">
                        <i class="fa fa-image"></i> <span>トップ画像</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ isActiveUrl('topimage*') }}">
                        <li class="{{ isActiveUrl('topimage') }}"><a href="{{ route('topimage.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ isActiveUrl('topimage/create') }}"><a href="{{ route('topimage.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                    </ul>
                </li>

                <li class="treeview {{ isActiveUrl('event*') }}">
                    <a href="#">
                        <i class="fa fa-calendar"></i> <span>カレンダー</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ isActiveUrl('event*') }}">
                        <li class="{{ isActiveUrl('event') }}"><a href="{{ route('event.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ isActiveUrl('event/create') }}"><a href="{{ route('event.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                    </ul>
                </li>

                <li class="treeview {{ isActiveUrl('activity*') }}">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>活動の様子</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ isActiveUrl('topimage*') }}">
                        <li class="{{ isActiveUrl('activity') }}"><a href="{{ route('activity.index') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ isActiveUrl('activity/create') }}"><a href="{{ route('activity.create') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                    </ul>
                </li>

                <li class="header">管理メニュー</li>

                <li class="treeview {{ isActiveUrl('user*') }}">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>ユーザ管理</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu {{ isActiveUrl('topimage*') }}">
                        <li class="{{ isActiveUrl('user') }}"><a href="{{ route('user') }}"><i class="fa fa-circle-o"></i> 一覧表示・編集</a></li>
                        <li class="{{ isActiveUrl('register') }}"><a href="{{ route('register') }}"><i class="fa fa-circle-o"></i> 新規登録</a></li>
                    </ul>
                </li>

                <li class="{{ isActiveUrl('actionlog*') }}">
                    <a href="{{ route('actionlog.index') }}"><i class="fa fa-circle-o text-aqua"></i> <span>操作ログ閲覧</span></a>
                </li>
            </ul>
        </section><!-- /.sidebar -->

    </aside>

    {{-- フラッシュメッセージの表示 --}}
    @if (Session::has('flashMsg'))
        <div class="flash-msg">{{ Session::get('flashMsg') }}</div>
    @elseif(Session::has('flashErrMsg'))
        <div class="flash-msg err">{{ Session::get('flashErrMsg') }}</div>
    @endif

    @yield('content')

    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 1.0.0</div>
        <strong>Copyright &copy; 2017- <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rightsreserved.
    </footer>

</div><!-- ./wrapper -->

{{--<script src="/vendor/jquery/jquery.js"></script><!-- jQuery 3 -->--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/vendor/jquery-ui/jquery-ui.js"></script><!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
{{--<script>--}}
    {{--$.widget.bridge('uibutton', $.ui.button);--}}
{{--</script>--}}

<!-- Tools JS -->
<script src="/vendor/bootstrap/js/bootstrap.js"></script>
<script src="/vendor/select2/select2.js"></script>
<script src="/vendor/iCheck/icheck.js"></script>
<script src="/vendor/ckeditor/ckeditor.js"></script>
<script src="/vendor/moment/moment.js"></script>
<script src="/vendor/moment/locale/ja.js"></script>
<script src="/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.ja.min.js"></script>
<script src="/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
{{--<script src="/vendor/dropzone/dropzone.js"></script>--}}
<script src="/vendor/dropzone/dropzone.js"></script>

<!-- fullCalendar -->
<script src="/vendor/fullcalendar/fullcalendar.min.js"></script>
{{--<script src='/vendor/fullcalendar/dist/locale/ja.js'></script>--}}

<!-- Sparkline -->
{{--<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>--}}
<!-- jvectormap -->
{{--<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>--}}
{{--<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>--}}
<!-- daterangepicker -->
{{--<script src="bower_components/moment/min/moment.min.js"></script>--}}
{{--<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>--}}
<!-- Slimscroll -->
{{--<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>--}}
<!-- FastClick -->
{{--<script src="bower_components/fastclick/lib/fastclick.js"></script>--}}

<script src="/vendor/AdminLTE/js/adminlte.js"></script>

@yield('js')

<script src="/backend/js/custom.js"></script>
<script src="/backend/js/functions.js"></script>

</body>
</html>