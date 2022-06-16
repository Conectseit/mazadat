@extends('Dashboard.layouts.master')
@section('title', __('messages.home'))

<!-- Page header -->
@section('breadcrumb')
    <div class="breadcrumb-line">
        <ul class="breadcrumb"style="float: {{ floating('right', 'left') }}">
            <li><a href="{{route('admin.home')}}"><i class="icon-home2 position-left"></i> @lang('messages.home')</a></li>
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
                            <div class="panel-body shadow-depth5" style="height: 100px;" >
                                <i class="icon-home2"></i>
                                <a href="{{route(Str::plural($model). '.'.'index')}}" style="color: whitesmoke; font-weight: bold;">
                                    <h6 class=""> {{trans('messages.count')}}   @lang('messages.'.$model. '.' .Str::plural($model))  ({{ model_count($model) ?? 0 }}) </h6>
                                </a>
                            </div>
                            <div class="container-fluid">
                                <div class="chart" id="members-online"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col-lg-2" style="float: {{ floating('right', 'left') }};">
                        <div class="panel bg-green-400">
                            <div class="panel-body shadow-depth5" style="height: 100px;">
                                <i class="icon-home2"></i>
                                <a href="{{route('persons.index')}}" style="color: whitesmoke;">
                                <h5 class="no-margin"> {{trans('messages.count')}} @lang('messages.person.persons')  ({{App\Models\User::where('is_company', 'person')->count()}})  </h5>
                                </a>
                            </div>
                            <div class="container-fluid">
                                <div class="chart" id="members-online"></div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
    <br>
    <br>

    <!-- Dashboard content -->
    <div class="row"style="font-family: Sans-Serif;">
        <div class="col-lg-6" style="float: {{ floating('right', 'left') }}">
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
                                            <div class="thumb" style="height: 80px;width: 80px;">
                                                <a href="{{ route('auctions.show', $auction->id) }}">
                                                    <img src="{{ $auction->first_image_path }}"
                                                         class="img-responsive img-rounded media-preview" alt="" >
{{--                                                    <span class="zoom-image"><i class="icon-play3"></i></span>--}}
                                                </a>
                                            </div>
                                        </div>

                                        <div class="media-body">
                                            <h6 class="media-heading"><a href="#">{{$auction->$name}}</a></h6>
                                            <ul class="list-inline list-inline-separate text-muted mb-5">
                                                <li>{{$auction->created_at->diffForHumans()}}</li>
                                            </ul>
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
    <div class=" " style="text-align: center; padding: 80px 20px 0 0 ;">
        <h3> <a href="#">Developed </a> by <a href="" target="_blank"> &copy; Connect Team devlopers</a> 2022.</h3>
    </div>
    <!-- /footer -->




</div>
<!-- /content area -->
@stop
