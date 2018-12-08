<?php

    use \App\Http\Models\Role\RoleType;
    /** @var \App\Http\Models\User\User $user */
    $user = Auth::user();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hakooh') }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>


    <script src="{{ asset('js/main.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>{{ config('app.name', 'Hakooh') }}</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top static-top-height">
            <div class="navbar-custom-menu static-top-user-icon">
                <ul class="nav navbar-nav static-top-height">
                    @guest
                    <li class="dropdown user user-menu">
                        @if (Route::has('invitation-key'))
                            @if (Request::is('invitation-key') || Request::is('register'))
                                <a href="{{ url('/') }}" >{{ __('Авторизация') }}</a>
                            @else
                                <a href="{{ route('invitation-key') }}" >{{ __('Регистрация') }}</a>
                            @endif
                        @endif
                    </li>
                    @else
                    <li class="dropdown user user-menu">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-body">
                                <a href="{{ route('home') }}">
                                    {{ __('Личный кабинет') }}
                                </a>
                            </li>
                            <li class="user-body">
                                <a href="{{ route('edit/profile') }}">
                                    {{ __('Редактировать данные') }}
                                </a>
                            </li>
                            <li class="user-body">
                                <a href="{{ route('edit/password') }}">
                                    {{ __('Изменить пароль') }}
                                </a>
                            </li>
                            <li class="user-body">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Выход из системы') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>





                    </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        @guest
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img class="bg-white rounded" src="{{asset('dist/img/guest.png')}}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{__('Гость')}}</p>
                    </div>
                </div>
            </section>
        @else
            <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img class="bg-white rounded" src="{{asset('dist/img/admin.png')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ $user->first_name }} {{ $user->second_name }}</p>
                    <span>
                        <i class="fa fa-circle text-success"></i>
                        {{ $user->roles()->pluck('name')->implode(' ') }}
                    </span>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                @if ($user->hasRole(RoleType::ADMINISTRATOR))
                <li>
                    <a href="{{ URL::route('users.index') }}" >
                        <i class="glyphicon-glyphicon-user"></i> <span> Управление пользователями</span> </a>
                </li>
                @endif
                <li>
                    <a href="{{ URL::route('platens.index') }}" >
                        <i class="glyphicon-glyphicon-user"></i> <span> Управление столами</span> </a>
                </li>
                <li>
                    <a href="{{ URL::route('logs') }}" >
                        <i class="glyphicon-glyphicon-user"></i> <span> Посмотреть логи</span> </a>
                </li>
                <li>
                    <a href="{{ URL::route('reservation.index') }}" >
                        <i class="glyphicon-glyphicon-user"></i> <span> Брони</span> </a>
                </li>
            </ul>
        </section>
    @endguest
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       <!-- <section class="content-header">
            <h1>
                @yield('title')
            </h1>

        </section> -->

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>IC </b> studio
        </div>
        <strong>Incredible Code</strong>
    </footer>

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
<script type="text/javascript" src="{{ asset('js/confirm-delete.js') }}"></script>
</html>
