<!DOCTYPE html>
<html class="no-js" lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ config('app.name') }} | Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="/backend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/assets/css/vendor.css">
    <link rel="stylesheet" href="/backend/assets/css/app.css">
    <link rel="stylesheet" href="/vendor/select2/select2.css">
    <link rel="stylesheet" href="/vendor/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >

    @yield('css')

    <link rel="stylesheet" href="/backend/assets/css/custom.css">
</head>

<body>

<div class="main-wrapper">
    <div class="app" id="app">

        {{-- フラッシュメッセージの表示 --}}
        @if (Session::has('flashMsg'))
            <div class="flash-msg">{{ Session::get('flashMsg') }}</div>
        @elseif(Session::has('flashErrMsg'))
            <div class="flash-msg err">{{ Session::get('flashErrMsg') }}</div>
        @endif

        <header class="header">
            <div class="header-block header-block-collapse hidden-lg-up">
                <button class="collapse-btn" id="sidebar-collapse-btn">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="header-block header-block-nav">
                <ul class="nav-profile">
                    <li class="profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="true" aria-expanded="false">
                            <div class="img"
                                 style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"></div>
                            <span class="name">
                                    {{ Auth::user()->name }}
                                </span>
                        </a>
                        <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
                            <a class="dropdown-item" href="#"><i class="fa fa-user icon"></i>設定</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off icon"></i>ログアウト</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header>

        <aside class="sidebar">
            <div class="sidebar-container">
                <div class="sidebar-header">
                    <div class="brand">
                        <div class="logo"><span class="l l1"></span> <span class="l l2"></span> <span
                                    class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span></div>
                        Admin
                    </div>
                </div>
                <nav class="menu">
                    <ul class="nav metismenu" id="sidebar-menu">
                        <li class="{{ isActiveUrl('dashboard') }}">
                            <a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a>
                        </li>
                        <li class="{{ isActiveUrl('topimage*') }}">
                            <a href="">
                                <i class="fa fa-image"></i> トップ画像
                                <i class="fa arrow"></i>
                            </a>
                            <ul>
                                <li class="{{ isActiveUrl('topimage') }}"><a href="{{ route('topimage.index') }}"><i class="fa fa-list"></i> 一覧表示・編集</a></li>
                                <li class="{{ isActiveUrl('topimage/create') }}"><a href="{{ route('topimage.create') }}"><i class="fa fa-edit"></i> 新規登録</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ isActiveUrl('activity*') }}"><a href="">
                                <i class="fa fa-table"></i> 活動の様子<i class="fa arrow"></i>
                            </a>
                            <ul>
                                <li><a href="{{ route('activity.index') }}">一覧表示・編集</a></li>
                                <li><a href="{{ route('activity.create') }}">新規登録</a></li>
                            </ul>
                        </li>

                        <li class="{{ isActiveUrl('user*') }}"><a href="">
                                <i class="fa fa-table"></i> ユーザ管理<i class="fa arrow"></i>
                            </a>
                            <ul>
                                <li class="{{ isActiveUrl('register') }}"><a href="{{ route('register') }}"> ユーザ新規登録</a>
                                </li>
                                <li class="{{ isActiveUrl('user') }}"><a href="{{ route('user') }}">一覧表示・編集</a></li>
                            </ul>
                        </li>

                        <li class="{{ isActiveUrl('actionlog*') }}">
                            <a href="{{ route('actionlog.index') }}"><i class="fa fa-list"></i> 操作ログ閲覧</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        @yield('content')

        <footer class="footer">
            <div class="footer-block buttons"></div>
            <div class="footer-block author">
                <ul>
                    <li> {{ config('app.name') }} </li>
                </ul>
            </div>
        </footer>
    </div><!-- /.app -->
</div><!-- /.main-wrapper -->

<!-- Reference block for JS -->
<div class="ref" id="ref">
    <div class="color-primary"></div>
    <div class="chart">
        <div class="color-primary"></div>
        <div class="color-secondary"></div>
    </div>
</div>

<script src="/backend/assets/js/jquery.js"></script>

{{--<script src="/backend/assets/js/vendor.js"></script>--}}

<script src="/backend/assets/js/bootstrap.min.js"></script>
<script src="/backend/assets/js/app.js"></script>
<script src="/vendor/select2/select2.js"></script>
<script src="/vendor/jquery-ui/jquery-ui.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>

@yield('js')

<script src="/backend/assets/js/custom.js"></script>

</body>

</html>