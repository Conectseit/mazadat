<!-- Page header -->
<div class="page-header page-header-default">

    <div class="page-header-content">
        <div class="page-title">
            <div class="row">
                <div class="col-6">

{{--                    <i class="icon-spinner icon-spin icon-large"></i> Spinner icon when loading content...--}}
                    <a style="float: {{ floating('right', 'right') }};" href="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" data-popup="lightbox">
                        <img src="{{ asset('Dashboard/assets/images/header1.png') }}" alt="" width="400" height="80" class="img-circle">
{{--                        <img src="{{ asset('Dashboard/assets/images/loogoo.png') }}" alt="" width="220" height="100">--}}
                        <img src="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" alt="" width="220" height="100" class="img-circle">
                    </a>
                </div>
            </div>
{{--            <h1>--}}
{{--                <i class="icon-arrow-right6 position-left"></i>--}}
{{--                <span class="text-bold">@lang('messages.Dashboard')</span>--}}
{{--            </h1>--}}
        </div>

{{--        <div class="clock">--}}
{{--            <div id="Date"></div>--}}
{{--            <ul>--}}
{{--                <li id="hours"></li>--}}
{{--                <li id="point">:</li>--}}
{{--                <li id="min"></li>--}}
{{--                <li id="point">:</li>--}}
{{--                <li id="sec"></li>--}}
{{--            </ul>--}}
{{--        </div>--}}

{{--        <div class="heading-elements">--}}
{{--            <div class="heading-btn-group">--}}
{{--                time--}}
{{--                <p class="btn  btn-float text-size-small has-text" id="txt"></p>--}}

{{--                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i--}}
{{--                                        class="icon-bars-alt text-primary"></i><span>Statistics</span></a>--}}
{{--                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i--}}
{{--                                        class="icon-calculator text-primary"></i> <span>Invoices</span></a>--}}
{{--                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i--}}
{{--                                        class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    <!-- Page header -->
    <div class="page-header page-header-default">
        @yield('breadcrumb')
    </div>
    <!-- /page header -->
</div>
<!-- /page header -->
