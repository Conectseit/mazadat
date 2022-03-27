@extends('Dashboard.layouts.master')
@section('title', __('messages.home'))

<!-- Page header -->
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb"style="float: {{ floating('right', 'left') }}">
            <li><a href="index.html"><i class="icon-home2 position-left"></i> @lang('messages.home')</a></li>
            <li class="active">@lang('messages.Dashboard')</li>
        </ul>

        <ul class="breadcrumb-elements"style="float: {{ floating('left', 'right') }}">
            <li><a href="{{ route('contacts.index') }}"><i class="icon-comment-discussion position-left"></i> {{trans('messages.contact.contacts')}}</a></li>
            <li class="dropdown">
                <a href="{{ route('settings.index') }}" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear position-left"></i>
                    {{ trans('messages.settings.settings') }}
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('admin.showProfile') }}"><i class="icon-user-lock"></i> @lang('messages.my-account')</a></li>
{{--                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>--}}
{{--                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>--}}
                    <li class="divider"></li>
                    <li><a href="{{ route('settings.index') }}"><i class="icon-gear"></i> {{ trans('messages.settings.settings') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
@stop
<!-- /page header -->
@section('content')

{{--    @include('notify::messages')--}}
<!-- Content area -->
<div class="content">
    @include('Dashboard.layouts.parts.validation_errors')

    <div class="row">
        <p>{{trans('messages.Statistics')}}</p>
        <div class="col-lg-12" dir="{{ direction() }}">
            <div class="row">
                @foreach (models(true) as $color => $model)
                    <div class="col-lg-2" style="float: {{ floating('right', 'left') }};">
                        <div class="panel bg-{{ $color }}-400">
                            <div class="panel-body" >
                                <a href="{{route(Str::plural($model). '.'.'index')}}" style="color: gold;">
                                <h3 class="no-margin"> {{trans('messages.count')}} ({{ model_count($model) ?? 0 }}) </h3>

                                     @lang('messages.'.$model. '.' .Str::plural($model))</a>
                            </div>
                            <div class="container-fluid">
                                <div class="chart" id="members-online"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
{{--                    <div class="col-lg-2" style="float: {{ floating('right', 'left') }};">--}}
{{--                        <div class="panel bg-green-400">--}}
{{--                            <div class="panel-body" >--}}
{{--                                <h3 class="no-margin"> {{trans('messages.count')}} (0) </h3>--}}
{{--                                <a href="{{route('persons.index')}}">--}}
{{--                                    @lang('messages.person.persons'))</a>--}}
{{--                            </div>--}}
{{--                            <div class="container-fluid">--}}
{{--                                <div class="chart" id="members-online"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

            </div>
        </div>
    </div>


    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-8" style="float: {{ floating('right', 'left') }}">
            <!-- Latest Auctions -->
            <div class="panel panel-flat" >
                <div class="panel-heading">
                    <h6 class="panel-title">{{ trans('messages.auction.latest_auctions') }}</h6>
                    <div class="heading-elements"style="float: {{ floating('right', 'left') }}">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="media-list content-group">

                                @foreach($auctions as $auction)
                                    <li class="media stack-media-on-mobile">
                                        <div class="media-left">
                                            <div class="thumb">
                                                <a href="#">
{{--                                                    <img src="{{asset('Dashboard/assets/images/placeholder.jpg')}}"--}}
                                                    <img src="{{ $auction->first_image_path }}"
                                                         class="img-responsive img-rounded media-preview" alt="" >
                                                    <span class="zoom-image"><i class="icon-play3"></i></span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading"><a href="#">{{$auction->$name}}</a></h6>
                                            <ul class="list-inline list-inline-separate text-muted mb-5">
                                                <li>
                                                    <i class="icon-book-play position-left"></i> {{$auction->seller->user_name}}
                                                </li>
                                                <li>{{$auction->created_at->diffForHumans()}}</li>
                                            </ul>
                                            {{$auction->description_ar}}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /latest Auctions -->
        </div>
    </div>
    <!-- /dashboard content -->


    <!-- Footer -->
    <div class="footer text-muted " style="text-align: center;">
        <h3> <a href="#">Mazadat</a> by <a href="" target="_blank"> &copy; Connect</a> 2022.</h3>
    </div>
    <!-- /footer -->

</div>
<!-- /content area -->
@stop
