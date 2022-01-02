<!DOCTYPE html>
{{--<html lang="en" dir="rtl">--}}

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ direction() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@lang('messages.Dashboard') || @yield('title')</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset('Dashboard/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Dashboard/assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Dashboard/assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Dashboard/assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Dashboard/assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    @notifyCss
    <!-- /global stylesheets -->
    @yield('style')
    @include('Dashboard.layouts.parts.core_Js_files')

</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo">
    @include('Dashboard.layouts.nav')
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">


    <!-- Page content -->
    <div class="page-content">
    @if (!Request::is(app()->getLocale().'/dashboard/show_login'))

        <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default">
                <div class="sidebar-content">
                    <!-- User menu -->
                    <div class="sidebar-user-material">
                        @include('Dashboard.layouts.sidebar_my_account')
                    </div>
                    <!-- /user menu -->

                    <!-- Main navigation Sidebar -->
                    <div class="sidebar-category sidebar-category-visible">
                        <div class="category-content no-padding">
                            @include('Dashboard.layouts.sidebar')
                        </div>
                    </div>
                    <!-- /main navigation -->
                </div>
            </div>
            <!-- /main sidebar -->
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Page header -->
            @include('Dashboard.layouts.header')
            <!-- /page header -->

    @endif

                @yield('content')
            </div>
            <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->




<!-- scripts -->
@yield('scripts')

<script type="text/javascript" src="{{ asset('assets/js/crud.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/lang.min.js') }}"></script>

<script type="text/javascript"
        src="{{ asset('assets/js/plugins/forms/selects/bootstrap_select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.printPage.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('assets/js/plugins/bootstrap-notify/bootstrap-notify.js') }}"></script>--}}
{{--@notifyJs--}}
{{--<x:notify-messages/>--}}

@include('Dashboard.layouts.parts.custom_scripts')

</body>
</html>
