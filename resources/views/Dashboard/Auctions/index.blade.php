@extends('Dashboard.layouts.master')
@section('title', trans('messages.auction.auctions'))
<!-- Page header -->
<div class="page-header page-header-default">
    @section('breadcrumb')
        <div class="breadcrumb-line">
            <ul class="breadcrumb">
                <li><a href="{{route('admin.home')}}">
                        <i class="icon-home2 position-left"></i> @lang('messages.home')
                    </a>
                </li>
                <li class="active">@lang('messages.auction.auctions')</li>
            </ul>
            @include('Dashboard.layouts.parts.quick-links')
        </div>
    @endsection
</div>
<!-- /page header -->
@section('content')


    @include('Dashboard.layouts.parts.validation_errors')
    <!-- Basic datatable -->
    <div class="panel panel-flat" dir="{{ direction() }}" style="margin: 20px;">
        <br><div class="list-icons" style="padding-right: 10px;">
            <a href="{{route('auctions.create')}}" class="btn btn-success btn-labeled btn-labeled-left"><b><i class="icon-plus2"></i></b>{{ trans('messages.auction.add') }}</a>
        </div>
        <div class="panel-heading">
            @include('Dashboard.layouts.parts.table-header', ['collection' => $auctions, 'name' => 'auctions', 'icon' => 'auctions'])
        </div>

        <!-- Basic pills -->
        <div class="row" style="padding: 15px;">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
{{--                        <h6 class="panel-title">{{ trans('messages.auction.auctions') }}</h6>--}}
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tabbable">
                            <ul class="nav nav-pills nav-pills-bordered nav-justified">
                                <li class="active"><a href="#all_auctions" data-toggle="tab">{{ trans('messages.auction.all_auctions') }}</a></li>
                                <li><a href="#on_progress_auctions" data-toggle="tab">{{ trans('messages.auction.on_progress') }}</a></li>
                                <li><a href="#done_auctions" data-toggle="tab">{{ trans('messages.auction.done') }}</a></li>
                            </ul>



                            <div class="tab-content">
                                <div class="tab-pane active" id="all_auctions">
                                   <div class="row">
                                       @if($auctions->count() > 0)
                                           <table class="table datatable-basic" id="auctions" style="font-size: 16px;">
                                               <thead>
                                               <tr style="background-color:gainsboro">                                                   <th class="text-center">#</th>
                                                   <th class="text-center">{{ trans('messages.image') }}</th>
                                                   <th class="text-center">{{ trans('messages.name') }}</th>
{{--                                                   <th class="text-center">{{ trans('messages.description') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.seller_full_name') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.category_name') }}</th>--}}
                                                   <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
                                                   <th class="text-center">{{ trans('messages.auction.value_of_increment') }}</th>
{{--                                                   <th class="text-center">{{ trans('messages.auction.start_date') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.end_date') }}</th>--}}
                                                   <th class="text-center">{{ trans('messages.auction.remaining_days') }}</th>
                                                   <th class="text-center">@lang('messages.since')</th>
                                                   <th class="text-center">@lang('messages.form-actions')</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($auctions as $auction)
                                                   <tr id="auction-row-{{ $auction->id }}">

                                                       <td class="text-center">{{ $auction->id }}</td>
                                                       <td class="text-center">
                                                           <a href="{{ $auction->first_image_path }}" data-popup="lightbox"><img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                       </td>
                                                       <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable($auction->$name) }}</a></td>
{{--                                                       <td class="text-center"> {{ isNullable($auction->$description) }}</td>--}}
{{--                                                       <td class="text-center"> {{ ($auction->seller->full_name) }}</a></td>--}}
{{--                                                       --}}{{--                                                    <td class="text-center"> {{ $auction->category['name_' . app()->getLocale()] }}</a></td>--}}
{{--                                                       <td class="text-center"> {{ $auction->category->$name }}</a></td>--}}
                                                       <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
                                                       <td class="text-center"> {{ ($auction->value_of_increment ) }}</a></td>

{{--                                                       <td class="text-center">{{($auction->start_date) }}</td>--}}
{{--                                                       <td class="text-center">{{($auction->end_date) }}</td>--}}
                                                       <td class="text-center">{{($auction->remaining_time) }}</td>
                                                       {{--                                                    {{ Carbon\Carbon::now()->toDateTimeString() }}--}}
                                                       <td class="text-center">{{isset($auction->created_at) ?$auction->created_at->diffForHumans():'---' }}</td>
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
                                                                           <a href="{{ route('auctions.edit',$auction->id) }}">
                                                                               <i class="icon-database-edit2"></i>@lang('messages.edit')
                                                                           </a>
                                                                       </li>
                                                                       <li>
                                                                           <a href="{{ route('auctions.show',$auction->id) }}">
                                                                               <i class="icon-eye"></i>@lang('messages.show')
                                                                           </a>
                                                                       </li>
                                                                       <li>
                                                                           <a data-id="{{ $auction->id }}" class="delete-action"
                                                                              href="{{ Url('/auction/auction/'.$auction->id) }}">
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
                                       @else
                                           <center><h3> @lang('messages.no_data_found') </h3></center>
                                       @endif
                                   </div>
                                </div>
                                <div class="tab-pane" id="on_progress_auctions">
                                    @if($on_progress_auctions->count() > 0)
                                        <table class="table datatable-basic" id="auctions" style="font-size: 16px;">
                                            <thead>
                                            <tr style="background-color:gainsboro">                                                  <th class="text-center">#</th>
                                                <th class="text-center">{{ trans('messages.image') }}</th>
                                                <th class="text-center">{{ trans('messages.name') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.value_of_increment') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.remaining_days') }}</th>
                                                <th class="text-center">@lang('messages.since')</th>
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($on_progress_auctions as $auction)
                                                <tr id="auction-row-{{ $auction->id }}">
                                                    <td class="text-center">{{ $auction->id }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ $auction->first_image_path }}" data-popup="lightbox">
                                                            <img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle">
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable($auction->$name) }}</a></td>
                                                    <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
                                                    <td class="text-center"> {{ ($auction->value_of_increment ) }}</a></td>
                                                    <td class="text-center">{{($auction->remaining_time) }}</td>
                                                    <td class="text-center">{{isset($auction->created_at) ?$auction->created_at->diffForHumans():'---' }}</td>
                                                    <td class="text-center">
                                                        <div class="list-icons text-center">
                                                            <div class="list-icons-item dropdown text-center">
                                                                <a href="#" class="list-icons-item caret-0 dropdown-toggle" data-toggle="dropdown">
                                                                    <i class="icon-menu9"></i>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-{{ floating('right', 'left') }}">
                                                                    <li>
                                                                        <a href="{{ route('auctions.edit',$auction->id) }}">
                                                                            <i class="icon-database-edit2"></i>@lang('messages.edit')
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('auctions.show',$auction->id) }}">
                                                                            <i class="icon-eye"></i>@lang('messages.show')
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a data-id="{{ $auction->id }}" class="delete-action"
                                                                           href="{{ Url('/auction/auction/'.$auction->id) }}">
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

                                    @else
                                        <center><h3> @lang('messages.no_data_found') </h3></center>
                                    @endif
                                </div>
                                <div class="tab-pane" id="done_auctions">
                                    @if($done_auctions->count() > 0)
                                        <table class="table datatable-basic" id="auctions" style="font-size: 16px;">
                                            <thead>
                                            <tr style="background-color:gainsboro">                                                  <th class="text-center">#</th>
                                                <th class="text-center">{{ trans('messages.image') }}</th>
                                                <th class="text-center">{{ trans('messages.name') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.value_of_increment') }}</th>
                                                <th class="text-center">@lang('messages.since')</th>
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($done_auctions as $auction)

                                                <tr id="auction-row-{{ $auction->id }}">
                                                    <td class="text-center">{{ $auction->id }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ $auction->first_image_path }}" data-popup="lightbox">
                                                            <img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle">
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable($auction->$name) }}</a></td>
                                                    <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
                                                    <td class="text-center"> {{ ($auction->value_of_increment ) }}</a></td>
                                                    <td class="text-center">{{isset($auction->created_at) ?$auction->created_at->diffForHumans():'---' }}</td>
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
                                                                        <a href="{{ route('auctions.edit',$auction->id) }}">
                                                                            <i
                                                                                class="icon-database-edit2"></i>@lang('messages.edit')
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('auctions.show',$auction->id) }}">
                                                                            <i
                                                                                class="icon-eye"></i>@lang('messages.show')
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a data-id="{{ $auction->id }}"
                                                                           class="delete-action"
                                                                           href="{{ Url('/auction/auction/'.$auction->id) }}">
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
                                    @else
                                        <center><h3> @lang('messages.no_data_found') </h3></center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /basic pills -->
    </div>
    <!-- /basic datatable -->
@stop

@section('scripts')
    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'auction'])
@stop


