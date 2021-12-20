@extends('Dashboard.layouts.master')
@section('title', trans('messages.category.categories'))
@section('content')

    <!-- Page header -->
    <div class="page-header page-header-default">
        @section('breadcrumb')
            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.home')}}"><i
                                class="icon-home2 position-left"></i> @lang('messages.home')</a>
                    </li>
                    <li><a href="{{ route('categories.index') }}"><i
                                class="icon-admin position-left"></i> @lang('messages.category.categories')</a></li>
                    <li class="active">@lang('messages.category.show')</li>
                </ul>
                @include('Dashboard.layouts.parts.quick-links')
            </div>
        @endsection
    </div>
    <!-- /page header -->


    <!-- Cover area -->
    <div class="profile-cover">
        <div class="profile-cover-img" style="background-image: url({{ $category->image_path }})"></div>
        <div class="media">
            <div class="media-left">
                <a href="#" class="profile-thumb">
                    <img src="{{ $category->image_path }}" class="img-circle" alt="">
                </a>
            </div>
            <div class="media-body">
                <h1>{{ trans('messages.category.name') }} : {{ $category->$name }} <small class="display-block">UX/UI
                        designer</small></h1>
            </div>

            <div class="media-right media-middle">
                <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">
                    <li><a href="#" class="btn btn-default"><i class="icon-file-picture position-left"></i> Cover image</a>
                    </li>
                    <li><a href="#" class="btn btn-default"><i class="icon-file-stats position-left"></i> Statistics</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /cover area -->


    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i
                        class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#category_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.category.category_data') }}</a>
                </li>
                <li><a href="#category_options" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.category.options') }} <span
                            class="badge badge-success badge-inline position-right">32</span></a></li>
                <li><a href="#category_auctions" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.category.auctions') }} <span
                            class="badge badge-success badge-inline position-right">32</span></a></li>
            </ul>
        </div>
    </div>
    <!-- /toolbar -->


    <!-- Content area -->
    <div class="content">

        <!-- Category profile -->
        <div class="row">
            <div class="col-lg-9">
                <div class="tabbable">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="category_data">

                            <!-- Timeline -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container">

                                    <!-- Sales stats -->
                                    <div class="timeline-row">

                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <div class="card">
                                                    <div class="card-header header-elements-inline">
                                                        <h3 class="card-title">{{ trans('messages.category.category_data') }}</h3>
                                                    </div>
                                                    <br>
                                                    <div class="card-body">
                                                        <form action="#">
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        class="col-form-label">{{ trans('messages.category.name') }}
                                                                        :</label>
                                                                    {{ $category->$name }}
                                                                </div>
                                                                {{--                                                                <div class="col-md-6">--}}
                                                                {{--                                                                    <label class="col-form-label">{{ trans('messages.category.category') }}:</label>--}}
                                                                {{--                                                                   hhh--}}
                                                                {{--                                                                </div>--}}

                                                            </div>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /sales stats -->
                                </div>
                            </div>
                            <!-- /timeline -->

                        </div>
                        <div class="tab-pane fade" id="category_auctions">
                            <!-- category_auctions -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="card-header header-elements-inline">
                                        <h3 class="card-title">{{ trans('messages.category.auctions')}}:</h3>
                                    </div>
                                    <br>

                                    <table class="table datatable-basic" id="auctions" style="font-size: 16px;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('messages.image') }}</th>
                                            <th>{{ trans('messages.name') }}</th>
                                            {{--                                                   <th>{{ trans('messages.description') }}</th>--}}
                                            <th>{{ trans('messages.auction.seller_full_name') }}</th>
                                            <th>@lang('messages.since')</th>
                                            <th class="text-center">@lang('messages.form-actions')</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($category_auctions as $category_auction)

                                            <tr id="auction-row-{{ $category_auction->id }}">

                                                <td>{{ $category_auction->id }}</td>
                                                <td>
                                                    <a href="{{ $category_auction->first_image_path }}"
                                                       data-popup="lightbox"><img
                                                            src="{{ $category_auction->first_image_path }}" alt=""
                                                            width="80" height="80" class="img-circle"></a>
                                                </td>

                                                <td>
                                                    <a href={{ route('auctions.show', $category_auction->id) }}>{{ isNullable($category_auction->$name) }}</a>
                                                </td>
                                                {{--                                                       <td> {{ isNullable($category_auction->$description) }}</td>--}}
                                                <td> {{ ($category_auction->seller->full_name) }}</a></td>

                                                {{--                                                    {{ Carbon\Carbon::now()->toDateTimeString() }}--}}
                                                <td>{{isset($category_auction->created_at) ?$category_auction->created_at->diffForHumans():'---' }}</td>
                                                <td class="text-center">
                                                    <div class="list-icons text-center">
                                                        <div class="list-icons-item dropdown text-center">
                                                            <a href="#"
                                                               class="list-icons-item caret-0 dropdown-toggle"
                                                               data-toggle="dropdown">
                                                                <i class="icon-menu9"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                <li>
                                                                    <a href="{{ route('auctions.edit',$category_auction->id) }}">
                                                                        <i
                                                                            class="icon-database-edit2"></i>@lang('messages.edit')
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('auctions.show',$category_auction->id) }}">
                                                                        <i
                                                                            class="icon-eye"></i>@lang('messages.show')
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a data-id="{{ $category_auction->id }}"
                                                                       class="delete-action"
                                                                       href="{{ Url('/auction/auction/'.$category_auction->id) }}">
                                                                        <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /category_auctions -->
                        </div>
                        <div class="tab-pane fade" id="category_options">
                            <!-- category_options -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <!-- Basic datatable -->
                                    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
                                        <div class="list-icons" style="padding-right: 10px;">
                                            <a href="#" data-toggle="modal" data-target="#add_options"
                                               class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                        class="icon-plus2"></i></b>{{ trans('messages.option.add') }}
                                            </a>
                                        </div>
                                        <table class="table datatable-basic" id="options" style="font-size: 16px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ trans('messages.name') }}</th>
                                                <th>@lang('messages.option.option_details')</th>
                                                {{--                                                <th>@lang('messages.since')</th>--}}
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($category_options as $option)
                                                <tr id="option-row-{{ $option->id }}">

                                                    <td>{{ $option->id }}</td>

                                                    <td>
                                                        <a href={{ route('options.show', $option->id) }}> {{ isNullable($option->$name) }}</a>
                                                    </td>
                                                    <td>
                                                        @if( $option->option_details->count() >1)
                                                            @foreach($option->option_details as $option_detail)
                                                                <span
                                                                    class="badge bg-success badge-pill">{{ $option_detail->$value }}</span>
                                                                /
                                                            @endforeach
                                                        @else
                                                            ===
                                                        @endif
                                                    </td>
                                                    {{--                                                    <td>{{isset($option->created_at) ?$option->created_at->diffForHumans():'---' }}</td>--}}
                                                    <td class="text-center">
                                                        <div class="list-icons text-center">
                                                            <div class="list-icons-item dropdown text-center">
                                                                <a href="#"
                                                                   class="list-icons-item caret-0 dropdown-toggle"
                                                                   data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                    <li>
                                                                        <a href="#" data-toggle="modal"
                                                                           data-target="#add_option_details"
                                                                           class="btn btn-success btn-labeled btn-labeled-left"><b><i
                                                                                    class="icon-plus2"></i></b>{{ trans('messages.option_detail.add') }}
                                                                        </a>
                                                                    </li>

                                                                    <li>
                                                                        <a href="{{ route('options.show', $option->id) }}">
                                                                            <i
                                                                                class="icon-eye"></i>@lang('messages.show')
                                                                        </a>
                                                                    </li>

                                                                    {{--                                                                    <li>--}}
                                                                    {{--                                                                        <a href="{{ route('options.edit',$option->id) }}">--}}
                                                                    {{--                                                                            <i--}}
                                                                    {{--                                                                                class="icon-database-edit2"></i>@lang('messages.edit')--}}
                                                                    {{--                                                                        </a>--}}
                                                                    {{--                                                                    </li>--}}
                                                                    {{--                                                                    <li>--}}
                                                                    {{--                                                                        <a data-id="{{ $option->id }}"--}}
                                                                    {{--                                                                           class="delete-action"--}}
                                                                    {{--                                                                           href="{{ Url('/option/option/'.$option->id) }}">--}}
                                                                    {{--                                                                            <i class="icon-database-remove"></i>@lang('messages.delete')--}}
                                                                    {{--                                                                        </a>--}}
                                                                    {{--                                                                    </li>--}}
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        @if($category_options->count() <= 0)
                                            <br>
                                            <div style="margin:50px; padding: 20px;">
                                                <h2> @lang('messages.no_data_found') </h2>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- /basic datatable -->
                                </div>
                            </div>
                            <!-- /category_options -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('Dashboard.Categories.option_modal')
        @include('Dashboard.Categories.option_details_modal')
    </div>

@stop

@section('scripts')
@stop


