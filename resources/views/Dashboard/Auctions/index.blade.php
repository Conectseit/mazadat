@extends('Dashboard.layouts.master')
@section('title', trans('messages.auction.auctions'))
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
@stop

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
                                <li><a href="#not_accepted" data-toggle="tab">{{ trans('messages.auction.not_accepted') }}</a></li>
                                <li><a href="#accepted_not_appear" data-toggle="tab">{{ trans('messages.auction.accepted_not_appear') }}</a></li>
                                <li><a href="#on_progress_auctions" data-toggle="tab">{{ trans('messages.auction.on_progress') }}</a></li>
                                <li><a href="#done_auctions" data-toggle="tab">{{ trans('messages.auction.done') }}</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="all_auctions">
                                   <div class="row">
                                       @if($auctions->count() > 0)
                                           <table class="table datatable-button-print-basic" id="auctions" style="font-size: 16px;">
                                               <thead>
                                               <tr style="background-color:gainsboro">
                                                   <th class="text-center">id</th>
{{--                                                   <th class="text-center">Serial number</th>--}}
                                                   <th class="text-center">قسم</th>
                                                   <th class="text-center">{{ trans('messages.extra_file') }}</th>
                                                   <th class="text-center">{{ trans('messages.image') }}</th>
                                                   <th class="text-center">{{ trans('messages.name') }}</th>
{{--                                                   <th class="text-center">{{ trans('messages.description') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.seller_full_name') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.category_name') }}</th>--}}
                                                   <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
{{--                                                   <th class="text-center">{{ trans('messages.auction.value_of_increment') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.start_date') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.end_date') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.auction.remaining_days') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.not_accept') }}</th>--}}
{{--                                                   <th class="text-center">{{ trans('messages.unique') }}</th>--}}

                                                   <th class="text-center">@lang('messages.since')</th>
                                                   <th class="text-center">@lang('messages.form-actions')</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($auctions as $key => $auction)
                                                   <tr id="auction-row-{{ $auction->id }}">

                                                       <td class="text-center">{{ $key+1 }}</td>
{{--                                                       <td class="text-center">{{ $auction->serial_number }}</td>--}}
                                                       <td class="text-center">{{ $auction->category->$name }}</td>
                                                       <td class="text-center">
                                                           @if(isset($auction->extra))
                                                           <a href="{{route('view',$auction->id)}}" target="_blank"> <i class="icon-file-pdf" style="color: red;"> </i></a>

                                                           <a href="{{route('download',$auction->extra)}}"><i class="icon-download4"> </i> {{trans('messages.download')}}</a>
                                                           @else لا يوجد
                                                           @endif
                                                       </td>
                                                       <td class="text-center">
                                                           <a href="{{ $auction->first_image_path }}" data-popup="lightbox"><img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                       </td>
                                                       <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable(substr($auction->$name,0,15)) }} </a></td>
{{--                                                       <td class="text-center"> {{ isNullable($auction->$description) }}</td>--}}
{{--                                                       <td class="text-center"> {{ ($auction->seller->full_name) }}</a></td>--}}
{{--                                                       --}}{{--                                                    <td class="text-center"> {{ $auction->category['name_' . app()->getLocale()] }}</a></td>--}}
{{--                                                       <td class="text-center"> {{ $auction->category->$name }}</a></td>--}}
                                                       <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
{{--                                                       <td class="text-center"> {{ ($auction->value_of_increment ) }}</a></td>--}}

{{--                                                       <td class="text-center">{{($auction->start_date) }}</td>--}}
{{--                                                       <td class="text-center">{{($auction->end_date) }}</td>--}}
{{--                                                       <td class="text-center">{{$auction->remaining_time['days']}}</td>--}}
                                                       {{--                                                    {{ Carbon\Carbon::now()->toDateTimeString() }}--}}

{{--                                                       <td class="text-center">--}}
{{--                                                           @if($auction->is_accepted ==1)--}}
{{--                                                               <a href="auction/{{$auction->id}}/not_accept/">--}}
{{--                                                                   <span class="badge badge-danger" >  <i class="icon-close2"> </i>  {{trans('messages.not_accept')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                           @else--}}
{{--                                                               <a href="auction/{{$auction->id}}/accept/">--}}
{{--                                                                   <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.accept')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                                <a href="buyer/{{$auction->id}}/accept/" class="btn btn-success btn-sm">  <i class="icon-check2"></i> {{trans('messages.accept')}}</a>--}}
{{--                                                           @endif--}}
{{--                                                       </td>--}}
{{--                                                       <td class="text-center">--}}
{{--                                                           @if($auction->is_unique ==0)--}}
{{--                                                               <a href="auction/{{$auction->id}}/unique/">--}}
{{--                                                                   <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.unique')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                           @else--}}

{{--                                                               <a href="auction/{{$auction->id}}/not_unique/">--}}
{{--                                                                   <span class="badge badge-danger" >  <i class="icon-close2"> </i>  {{trans('messages.not_unique')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                           @endif--}}
{{--                                                       </td>--}}
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
                                           <div style="text-align: center;"><h3> @lang('messages.no_data_found') </h3></div>
                                       @endif
                                   </div>
                                </div>
                                <div class="tab-pane " id="not_accepted">
                                   <div class="row">
                                       @if($not_accepted_auctions->count() > 0)
                                           <table class="table datatable-button-print-basic" id="auctions" style="font-size: 16px;">
                                               <thead>
                                               <tr style="background-color:gainsboro">
                                                   <th class="text-center">قسم</th>
                                                   <th class="text-center">{{ trans('messages.image') }}</th>
                                                   <th class="text-center">{{ trans('messages.name') }}</th>
                                                   <th class="text-center">{{ trans('messages.auction.add_time/accept') }}</th>
                                                   <th class="text-center">{{ trans('messages.need_update') }}</th>
                                                   <th class="text-center">@lang('messages.since')</th>
                                                   <th class="text-center">@lang('messages.form-actions')</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($not_accepted_auctions as $auction)
                                                   <tr id="auction-row-{{ $auction->id }}">
                                                       <td class="text-center">{{ $auction->category->$name }}</td>
                                                       <td class="text-center">
                                                           <a href="{{ $auction->first_image_path }}" data-popup="lightbox"><img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                       </td>
                                                       <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable(substr($auction->$name,0,15)) }} </a></td>
{{--                                                       <td class="text-center">--}}
{{--                                                           @if($auction->is_accepted ==0)--}}
{{--                                                               <a href="auction/{{$auction->id}}/not_accept/">--}}
{{--                                                                   <span class="badge badge-danger" >  <i class="icon-close2"> </i>  {{trans('messages.not_accept')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                           @else--}}
{{--                                                               <a href="auction/{{$auction->id}}/accept/">--}}
{{--                                                                   <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.accept')}} </span>--}}
{{--                                                               </a>--}}
{{--                                                               --}}{{--                                                                <a href="buyer/{{$auction->id}}/accept/" class="btn btn-success btn-sm">  <i class="icon-check2"></i> {{trans('messages.accept')}}</a>--}}
{{--                                                           @endif--}}
{{--                                                       </td>--}}


                                                       <td class="text-center">
                                                           <a href="#" data-toggle="modal" data-target="#add_start_time_modal"
                                                              class="btn btn-success btn-labeled btn-labeled-left">
{{--                                                               <b><i class="icon-plus2"></i></b>{{ trans('messages.auction.add_time/accept') }}--}}
                                                               <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.auction.add_time/accept')}} </span>
                                                           </a>
                                                       </td>

                                                       <td class="text-center">
                                                               <a href="auction/{{$auction->id}}/need_update/">
                                                                   <span class="badge badge-primary" >  <i class="icon-close2"> </i>  {{trans('messages.need_update')}} </span>
                                                               </a>
                                                       </td>

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
{{--                                                                       <li>--}}
{{--                                                                           <a href="{{ route('auctions.edit',$auction->id) }}">--}}
{{--                                                                               <i class="icon-database-edit2"></i>@lang('messages.edit')--}}
{{--                                                                           </a>--}}
{{--                                                                       </li>--}}
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

                                                       @include('Dashboard.Auctions.parts.add_start_time_modal')

                                                   </tr>
                                               @endforeach
                                               </tbody>
                                           </table>
                                       @else
                                           <div style="text-align: center;"><h3> @lang('messages.no_data_found') </h3></div>
                                       @endif
                                   </div>
                                </div>
                                <div class="tab-pane " id="accepted_not_appear">
                                   <div class="row">
                                       @if($accepted_not_appear->count() > 0)
                                           <table class="table datatable-button-print-basic" id="auctions" style="font-size: 16px;">
                                               <thead>
                                               <tr style="background-color:gainsboro">
                                                   <th class="text-center">{{ trans('messages.category.category') }}</th>
                                                   <th class="text-center">{{ trans('messages.image') }}</th>
                                                   <th class="text-center">{{ trans('messages.name') }}</th>
                                                   <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
                                                   <th class="text-center">{{ trans('messages.unique') }}</th>
                                                   <th class="text-center">@lang('messages.since')</th>
                                                   <th class="text-center">@lang('messages.form-actions')</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($accepted_not_appear as $auction)
                                                   <tr id="auction-row-{{ $auction->id }}">
                                                       <td class="text-center">{{ $auction->category->$name }}</td>
                                                       <td class="text-center">
                                                           <a href="{{ $auction->first_image_path }}" data-popup="lightbox"><img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle"></a>
                                                       </td>
                                                       <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable(substr($auction->$name,0,15)) }} </a></td>
                                                       <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
                                                       <td class="text-center">
                                                           @if($auction->is_unique ==0)
                                                               <a href="auction/{{$auction->id}}/unique/">
                                                                   <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.unique')}} </span>
                                                               </a>
                                                           @else
                                                               <a href="auction/{{$auction->id}}/not_unique/">
                                                                   <span class="badge badge-danger" >  <i class="icon-close2"> </i>  {{trans('messages.not_unique')}} </span>
                                                               </a>
                                                           @endif
                                                       </td>

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

                                                       @include('Dashboard.Auctions.parts.add_start_time_modal')

                                                   </tr>
                                               @endforeach
                                               </tbody>
                                           </table>
                                       @else
                                           <div style="text-align: center;"><h3> @lang('messages.no_data_found') </h3></div>
                                       @endif
                                   </div>
                                </div>
                                <div class="tab-pane" id="on_progress_auctions">
                                    @if($on_progress_auctions->count() > 0)
                                        <table class="table datatable-button-print-basic" id="auctions" style="font-size: 16px;">
                                            <thead>
                                            <tr style="background-color:gainsboro">
                                                <th class="text-center">قسم</th>
                                                <th class="text-center">{{ trans('messages.image') }}</th>
                                                <th class="text-center">{{ trans('messages.name') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
                                                <th class="text-center">{{ trans('messages.unique') }}</th>

{{--                                                <th class="text-center">{{ trans('messages.auction.make_done') }}</th>--}}
                                                <th class="text-center">@lang('messages.since')</th>
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($on_progress_auctions as $auction)
                                                <tr id="auction-row-{{ $auction->id }}">
                                                    <td class="text-center">{{ $auction->category->$name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ $auction->first_image_path }}" data-popup="lightbox">
                                                            <img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle">
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable(substr($auction->$name,0,15)) }} </a></td>
                                                    <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
                                                    <td class="text-center">
                                                           @if($auction->is_unique ==0)
                                                               <a href="auction/{{$auction->id}}/unique/">
                                                                   <span class="badge badge-success" >  <i class="icon-check2"> </i>  {{trans('messages.unique')}} </span>
                                                               </a>
                                                           @else
                                                               <a href="auction/{{$auction->id}}/not_unique/">
                                                                   <span class="badge badge-danger" >  <i class="icon-close2"> </i>  {{trans('messages.not_unique')}} </span>
                                                               </a>
                                                           @endif
                                                    </td>
{{--                                                    <td class="text-center">--}}
{{--                                                        @if($auction->status !='done')--}}
{{--                                                            <a href="auction/{{$auction->id}}/done/">--}}
{{--                                                                <span class="badge badge-primary" >  <i class="icon-close2"> </i>  {{trans('messages.auction.make_done')}} </span>--}}
{{--                                                            </a>--}}
{{--                                                        @endif--}}
{{--                                                    </td>--}}
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
                                        <div
                                            style="text-align: center;"><h3> @lang('messages.no_data_found') </h3></div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="done_auctions">
                                    @if($done_auctions->count() > 0)
                                        <table class="table datatable-button-print-basic" id="auctions" style="font-size: 16px;">
                                            <thead>
                                            <tr style="background-color:gainsboro">
                                                <th class="text-center">Serial number</th>
                                                <th class="text-center">قسم</th>
                                                <th class="text-center">{{ trans('messages.image') }}</th>
                                                <th class="text-center">{{ trans('messages.name') }}</th>
                                                <th class="text-center">{{ trans('messages.auction.start_auction_price') }}</th>
{{--                                                <th class="text-center">{{ trans('messages.auction.value_of_increment') }}</th>--}}
                                                <th class="text-center">@lang('messages.since')</th>
                                                <th class="text-center">@lang('messages.form-actions')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($done_auctions as $auction)

                                                <tr id="auction-row-{{ $auction->id }}">
                                                    <td class="text-center">{{ $auction->serial_number }}</td>
                                                    <td class="text-center">{{ $auction->category->$name }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ $auction->first_image_path }}" data-popup="lightbox">
                                                            <img src="{{ $auction->first_image_path }}" alt="" width="80" height="80" class="img-circle">
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><a href={{ route('auctions.show', $auction->id) }}>{{ isNullable(substr($auction->$name,0,15)) }} </a></td>
                                                    <td class="text-center"> {{ ($auction->start_auction_price ) }}</a></td>
{{--                                                    <td class="text-center"> {{ ($auction->value_of_increment ) }}</a></td>--}}
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
                                        <div style="text-align: center;"><h3> @lang('messages.no_data_found') </h3></div>
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
