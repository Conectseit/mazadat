<!-- Page header -->
<div class="page-header page-header-default">

    <div class="page-header-content">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <a href="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" data-popup="lightbox">
                        <img src="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" alt="" width="150" height="80" class="img-circle">
                    </a>
                </div>
            </div>
            <h1>
                <i class="icon-arrow-right6 position-left"></i>
                <span class="text-bold">@lang('messages.Dashboard')</span>
            </h1>
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

        <div class="heading-elements">
            <div class="heading-btn-group">
{{--                time--}}
{{--                <p class="btn  btn-float text-size-small has-text" id="txt"></p>--}}

                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                        class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                        class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                                <a href="#" class="btn btn-link btn-float text-size-small has-text"><i
                                        class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>

    </div>
    <!-- Page header -->
    <div class="page-header page-header-default">
        @yield('breadcrumb')
    </div>
    <!-- /page header -->
</div>
<!-- /page header -->
