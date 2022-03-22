@extends('Dashboard.layouts.master')
@section('title', trans('messages.category.categories'))
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

@section('content')
    @include('Dashboard.layouts.parts.validation_errors')


    <!-- Toolbar -->
    <div class="navbar navbar-default navbar-xs content-group">
        <ul class="nav navbar-nav visible-xs-block">
            <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse" id="navbar-filter">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#category_data" data-toggle="tab"><i
                            class="icon-menu7 position-left"></i> {{ trans('messages.category.category_data') }}</a>
                </li>
                <li><a href="#category_options" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.category.options') }} <span
                            class="badge badge-success badge-inline position-right">{{$category_options->count()}}</span></a></li>
                <li><a href="#category_auctions" data-toggle="tab"><i
                            class="icon-calendar3 position-left"></i> {{ trans('messages.category.auctions') }} <span
                            class="badge badge-success badge-inline position-right">{{$category_auctions->count()}}</span></a></li>
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
{{--                                                    <div class="card-header header-elements-inline">--}}
{{--                                                        <h3 class="card-title">{{ trans('messages.category.category_data') }}</h3>--}}
{{--                                                    </div>--}}
                                                    <br>
                                                    <div class="card-body">
                                                        <form action="#">
{{--                                                            <!-- Cover area -->--}}
{{--                                                            <div class="profile-cover">--}}
{{--                                                                <div class="profile-cover-img"--}}
{{--                                                                                 style="background-image: url({{ $category->image_path }})"--}}
{{--                                                                ></div>--}}
{{--                                                                <div class="media">--}}
{{--                                                                    <div class="media-left">--}}
{{--                                                                        <a href="#" class="profile-thumb">--}}
{{--                                                                            <img src="{{ $category->image_path }}" class="img-circle" alt="">--}}
{{--                                                                        </a>--}}
{{--                                                                    </div>--}}
{{--                                                                    --}}{{--            <div class="media-body">--}}
{{--                                                                    --}}{{--                <h1>{{ trans('messages.category.name') }} :--}}
{{--                                                                    --}}{{--                    <small class="display-block">{{ $category->$name }}</small>--}}
{{--                                                                    --}}{{--                </h1>--}}
{{--                                                                    --}}{{--            </div>--}}

{{--                                                                    <div class="media-right media-middle">--}}
{{--                                                                        <ul class="list-inline list-inline-condensed no-margin-bottom text-nowrap">--}}
{{--                                                                            <li><a href="#" class="btn btn-default"><i class="icon-file-picture position-left"></i>  {{ trans('messages.category.name') }} :{{ $category->$name }}</a></li>--}}
{{--                                                                            --}}{{--                    <li><a href="#" class="btn btn-default"><i class="icon-file-stats position-left"></i> {{ trans('messages.category.name') }} :</a></li>--}}
{{--                                                                        </ul>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <!-- /cover area -->--}}

                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label">{{ trans('messages.category.name') }}:</label>
                                                                    {{ $category->$name }}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group row">
                                                                        <label class="col-form-label col-lg-3">{{ trans('messages.description') }}:</label>
                                                                        <div class="col-lg-9">
                                                                            <textarea rows="5" cols="5" name="about_app_ar" class="form-control">
                                                                                {{ $category->$description }}
                                                                            </textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                    </div><br>
                                    <table class="table datatable-basic" id="auctions" style="font-size: 16px;">
                                        <thead>
                                        <tr style="background-color:gainsboro">                                            <th>#</th>
                                            <th>{{ trans('messages.image') }}</th>
                                            <th>{{ trans('messages.name') }}</th>
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
                                                    <a href="{{ $category_auction->first_image_path }}" data-popup="lightbox">
                                                        <img src="{{ $category_auction->first_image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                </td>
                                                <td>
                                                    <a href={{ route('auctions.show', $category_auction->id) }}>{{ isNullable($category_auction->$name) }}</a>
                                                </td>
                                                <td> {{ ($category_auction->seller->user_name) }}</a></td>

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
                                                                        <i class="icon-database-edit2"></i>@lang('messages.edit')
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('auctions.show',$category_auction->id) }}">
                                                                        <i class="icon-eye"></i>@lang('messages.show')
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
                                        </div><br>
                                        @if($category_options->count() > 0)
                                        <table class="table datatable-basic" id="options" style="font-size: 16px;">
                                            <thead>
                                            <tr style="background-color:gainsboro">                                                <th class="text-center">#</th>
                                                <th class="text-center">{{ trans('messages.name') }}</th>
                                                <th class="text-center">@lang('messages.option.option_details')</th>
                                                {{--                                                <th>@lang('messages.since')</th>--}}
                                                <th class="text-center">@lang('messages.option_detail.add_detail') </th>
                                                <th class="text-center">@lang('messages.option.delete')</th>
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
                                                        @if( $option->option_details->count() >0)
                                                            @foreach($option->option_details as $option_detail)
                                                                <span class="badge bg-success badge-pill">{{ ($option_detail->$value) }}</span>/
                                                            @endforeach
                                                        @else
                                                        {{trans('messages.no_value')}}
                                                        @endif

                                                    </td>
                                                    {{--                                                    <td>{{isset($option->created_at) ?$option->created_at->diffForHumans():'---' }}</td>--}}
                                                    <td class="text-center">
                                                        <ul class="{{ floating('right', 'left') }}">
                                                            <li>
                                                                <a  href="javascript:void(0);"
                                                                    data-toggle="modal" data-target="#add_option_details-{{$option->id}}">
                                                                    <i class="icon-plus2"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
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
                                                                        <a data-id="{{ $option->id }}"
                                                                           class="delete-action"
                                                                           href="{{ Url('/option/option/'.$option->id) }}">
                                                                            <i class="icon-database-remove"></i>@lang('messages.delete')
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('Dashboard.Categories.option_details_modal', ['id' => $option->id])
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                            <br><div style="margin:50px; padding: 20px;">
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
    </div>

@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'option'])
@stop


