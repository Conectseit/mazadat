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
    <!-- /global stylesheets -->


    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <!-- /core JS files -->

{{--    <!-- Theme JS files -->--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/forms/selects/select2.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/core/app.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/datatables_basic.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/datatables_extension_buttons_print.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/ui/ripple.min.js')}}"></script>--}}
{{--    <!-- /theme JS files -->--}}



    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/tables/datatables/extensions/buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/tables/datatables/extensions/select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/forms/selects/select2.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('Dashboard/assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/datatables_extension_buttons_print.js')}}"></script>




    <!-- Theme JS files  create auction-->
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/forms/wizards/stepy.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('Dashboard/assets/js/core/libraries/jasny_bootstrap.min.js')}}"></script>
    <script type="text/javascript"
            src="{{asset('Dashboard/assets/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('Dashboard/assets/js/pages/wizard_stepy.js')}}"></script>

    <!-- /theme JS files -->


    <script type="text/javascript" src="{{ url('assets/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/bootstrap-datetimepicker.min.js') }}"
            charset="UTF-8"></script>
    {{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}

    {{--==============  end teeest ====================================--}}

    {{--    ckeditor--}}
    <script type="text/javascript" src="{{ asset('Dashboard/ckeditor/ckeditor.js') }}"></script>


    @yield('style')

</head>

<body style="font-family: Sans-Serif;">

<!-- Main navbar -->
<div class="navbar navbar-inverse bg-indigo" style="background-color: #009688">
    @include('Dashboard.layouts.nav')
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content" >
    @if (!Request::is(app()->getLocale().'/dashboard/show_login'))

        <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default">
                <div class="sidebar-content">
                    <!-- User menu -->
                    <div class="sidebar-user-material" style="color: white">
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

<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/bootstrap_select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.printPage.js') }}"></script>

@include('Dashboard.layouts.parts.custom_scripts')

</body>
</html>
