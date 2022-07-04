<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content" style="">
        <div class="page-title"dir="{{ direction() }}">
            <div class="row"  style="height:60px;">
                <div class="col-6">
                    <h3 style="display: inline;"style="color: black;">
                        <i class="icon-arrow-right6 position-left"></i>
                        <span class="text-bold">@lang('messages.Dashboard')</span>
                    </h3>
{{--                    <div class="image_head" style="display: inline">--}}
{{--                        <img class="" width="280"--}}
{{--                             src="{{ asset('Dashboard/assets/images/loogoo.png') }}"/>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>


{{--    <div class="page-header-content">--}}
{{--        <div class="page-title">--}}
{{--            <div class="row">--}}
{{--                <div class="col-6">--}}
{{--                    <a style="float: {{ floating('right', 'right') }};" href="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" data-popup="lightbox">--}}
{{--                        <img src="{{ asset('Dashboard/assets/images/header1.png') }}" alt="" width="400" height="80" class="img-circle">--}}
{{--                        <img src="{{ asset('Dashboard/assets/images/mazadat_logo.jpg') }}" alt="" width="220" height="100" class="img-circle">--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
    <!-- Page header -->
    <div class="page-header page-header-default">
        @yield('breadcrumb')
    </div>
    <!-- /page header -->
</div>
<!-- /page header -->
