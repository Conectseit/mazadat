@extends('front.layouts.master')
@section('title', trans('messages.auction.auction_details'))
@section('style')
    <style>
        #map {
            height: 400px;
            border: solid 1px;
            padding-right: 20px;
        }
        .carousel-item {
            width: 100%;
            height: 700px;
        }
    </style>
@endsection

@section('content')
    <main class="categories-bar row m-auto">
        @include('front.layouts.parts.nav_categories')
    </main>
    <div class="ad-details-page">
        <main class="ad-main-details">
            <div class="container">
                <div class="row">
                    @include('front.layouts.parts.make_bid_alert')
                    @if($auction->status=='on_progress')
                        <div class="col-lg-2 d-flex align-items-center">
                        </div>
                        <div class="col-lg-4 d-flex align-items-center">
                            <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                                    class="fal fa-arrow-circle-right"></i> </a>

                            <div id="countdown" style="margin-right: -141px; ">
                                <h5 class="text-center mx-auto my-1 "
                                    style="  padding-bottom: 8px;">{{__('messages.auction.remaining_time')}}
                                    : <i class="fal fa-clock"> </i>
                                </h5>
                                <div class="labels">
                                    <li>{{__('messages.days')}}</li>
                                    <li>{{__('messages.hours')}}</li>
                                    <li>{{__('messages.min')}}</li>
                                    <li>{{__('messages.sec')}}</li>
                                </div>
                                <div class="labels">
                                    <li id="days"></li>
                                    <li id="hours"></li>
                                    <li id="minutes"></li>
                                    <li id="seconds"></li>
                                </div>
                            </div>

                        </div>
                        @if(auth()->check())
                            @if(auth()->user()->is_verified == 1 )
                                @if(auth()->user()->id != $auction->seller_id)

                                    <div class="col-lg-2 d-flex align-items-center" id="bid">
                                        <a href="#" class="bid-btn"> {{ trans('messages.auction.bid_now')}}</a>
                                    </div>
                                @endif
                            @endif
                            @if(auth()->user()->is_verified == 0 )
                                <div class="col-lg-6 d-flex align-items-center">
                                    <a href="{{route('front.show_complete_profile')}}"> {{ trans('messages.please_complete_your_data_to_could_make_bid')}}
                                    </a>
                                </div>
                            @endif
                        @endif
                    @endif
                    <div class="col-lg-6 d-flex align-items-center justify-content-end" id="bidMainInfo">
                        <div class="current-price">
                            <p>{{ trans('messages.auction.current_price')}}:</p>
                            <h4>{{($auction->current_price)}}</h4>
                        </div>
                        <div class="min-increment">
                            <p> {{ trans('messages.auction.value_of_increment')}}:</p>
                            <h4>{{($auction->value_of_increment)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <section class="ad-info" dir="{{ direction() }}">
            <div class="container">
                <div class="row" style="margin-bottom:20px ;">
                    <div class="col-lg-12">
                        <h4 class="ad-title">{{ ($auction->category->$description )}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <h4 class="ad-title">
                            <a href="{{ route('front.category_auctions',$auction->category->id) }}"
                               class="mt-2 mx-1 back"> <i
                                    class="fal fa-arrow-circle-{{ floating('right','left') }}"
                                    style="color: black;"></i>
                            </a>
                            {{ trans('messages.category.category')}} ({{ ($auction->category->$name )}})
                        </h4>
                        <div class="main-image" style="height: 200px;">
                            <img src="{{$auction->first_image_path}}" alt="image" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="row ">
                            <div class="col-lg-6">
                                <div class="details" id="details">
                                    <h4>{{$auction->$name}}  </h4>
                                </div>
                                <div class="details" id="details">
                                    <p class="start-date">
                                        <i class="fal fa-calendar-alt"></i>
                                        {{trans('messages.auction.start_at')}}
                                        : {{isset($auction->start_date)? ($auction->start_date->format('l, m/d/Y') ):''}}
                                    </p>
                                </div>
                                @if($auction->status=='on_progress')
                                    <div class="details" id="details">
                                        <p><i class="fal fa-clock"></i> {{trans('messages.auction.remaining_time')}}:
                                            {{--                                        {{ ($auction->remaining_time['days'] ) }}--}}
                                            <span class="test-time"> <span id="Timerapp"></span></span>
                                        </p>
                                    </div>
                                @endif
                                @if($auction->status=='done')
                                    <div class="details" id="details">
                                        <p><i class="fal fa-clock"></i> {{trans('messages.auction.remaining_time')}}:
                                            <span class="test-time">{{trans('messages.auction.done_auction')}} </span>
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6">

                                <div class="details" id="details">
                                    <h5>{{trans('messages.auction_commission')}} :
                                        {{($auction->category->auction_commission)}} ريال</h5>
                                    <h6 class="group-title text-primary">  {{trans('messages.auction_commission_note')}}</h6>
                                </div>
                                <div class="details" id="details">
                                    <p>
                                        <i class="fa fa-money"> </i>{{trans('messages.auction.start_auction_price')}}
                                        :{{($auction->start_auction_price)}}
                                    </p>
                                </div>
                                <div class="details " id="details">
                                    <p><i class="fa fa-money"> </i> {{trans('messages.auction.current_price')}}
                                        :{{($auction->current_price)}}</p>
                                </div>
                                <div class="details" id="details">
                                    <p><i class="fal fa-gavel"> </i>{{trans('messages.auction.value_of_increment')}}
                                        :{{($auction->value_of_increment)}}</p>

                                    <p class="ticket"><i
                                            class="fa fa-users"> </i> {{trans('messages.auction.buyers_count')}}
                                        :{{ ($auction->count_of_buyer ) }}
                                    </p>

                                    <br>
                                    <div class="details" id="details">
                                        <h5>  <i class="fal fa-user"> </i> {{trans('messages.auction.seller')}}
                                            :
                                            @if($auction->seller->is_company=='person' && $auction->seller->is_appear_name==1)
                                                {{ ($auction->seller->full_name ) }}
                                            @else
                                                {{ ($auction->seller->user_name ) }}
                                            @endif

                                        </h5>
                                    </div>

                                    <div class="details" id="details">
                                        <h6>{{trans('messages.auction.delivery_charge')}} :
                                            {{($auction->delivery_charge)}}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="description" id="description">
                            <h4>{{ trans('messages.description')}}:</h4>
                            <p>{{$auction->$description}}</p>
                        </div>
                        <br>
                        <div class="bid-details" id="bidDetails">
                            <form action="{{route('front.make_bid_person',$auction->id)}}" method="post">
                                @csrf
                                <div class="bid-input">
                                    <span class="minus" id="minuss">
                                        <i class="fal fa-minus"></i>
                                    </span>
                                    <h4>ريال سعودي</h4>
                                    <input type="number" name="buyer_offer" id="bidInput"
                                           value="{{($auction->current_price)}}"/>
                                    <span class="plus" id="pluss">
                                        <i class="fal fa-plus"></i>
                                    </span>
                                </div>

                                <div class="bid-options">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <ul>
                                                <li>
                                                    <div class="mb-3 form-check form-group">
                                                        <a href="javascript:void(0);" id="change-terms-value">
                                                            <input type="checkbox" class="form-check-input"
                                                                   id="accept-terms" name="accept_auction"
                                                            @if(auth()->check()){{ checkIsUserAccept($auction)->count()?'checked':''}}@endif
                                                            >
                                                        </a>
                                                        <label class="form-check-label" for="accept-terms"
                                                               style="color: red;">
                                                            {{ trans('messages.accept_terms')}} </label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-6">
                                            <ul>
                                                <li>
                                                    <p class="ticket"><i
                                                            class="far fa-ticket"></i>{{ trans('messages.auction.count_of_buyer')}}
                                                        : {{ ($auction->count_of_buyer ) }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bid-description">
                                    <h5>{{ trans('messages.description')}}:</h5>
                                    <p> {{$auction->$description}}</p>
                                </div>
                                <div class="sign-btn">
                                    <button type="submit" class="btn btn-primary submit-btn">
                                        {{trans('messages.auction.make_bid')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('front.auctions.parts.auction_images_and_files')

                <div class="terms">
                    <h4>{{ trans('messages.auction.terms')}}:</h4>
                    <p>{{$auction->$auction_terms}}</p>
                </div>

                @if($auction->is_appear_location==1)
                    <hr>
                    <div class="terms">
                        <h4>{{ trans('messages.auction.location')}}:</h4>
                        <div id="map" class="m-6"></div>
                    </div>
                @endif
            </div>
        </section>

        <!-- upload-file-modal -->
        <div class="modal user-modal bio-modal fade" id="upload-file-modal" tabindex="-1"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true" dir="{{ direction() }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" >
                    <form action="{{route('front.addFile_person')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="auction_id" value="{{$auction->id}}">

                            <div class="form-group ">
                                <div class="col-lg-12 col-md-12">
                                    <select name="file_name_id" class="form-select  form-control">
                                        <option selected
                                                disabled>{{trans('messages.select_file_name')}}</option>
                                        @foreach ($inspection_file_names as $inspection_file_name)
                                            <option
                                                value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="file"  class="form-control" name="inspection_report_images">
                                </div>
                                @error('inspection_report_images')<span
                                    style="color: #e81414;">{{ $message }}</span>@enderror
                            </div>
                            <br>

                            <div class="form-group ">
                                <div class="col-lg-12 col-md-12">
                            <textarea  cols="60" name="description" placeholder="{{trans('messages.enter_message')}} "required>
                            </textarea>
                                    @error('description')<span
                                        style="color: #e81414;">{{ $message }}</span>@enderror
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary add">{{trans('messages.send')}}</button>
                            <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">{{trans('messages.cancel')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- upload-file-modal -->
    </div>

@stop
@push('scripts')
    @include('front.auctions.parts.auction_location_on_google_map')
    @include('front.auctions.parts.ajax')
    @include('front.auctions.parts.counter', ['auction' => $auction])

@endpush


{{--                            <hr>--}}
{{--                        @foreach($auction->inspectionimages as $image)--}}
{{--                            <div class="col-md-3 col-6">--}}
{{--                                --}}{{--                                <p> <i class=" fa fa-file-pdf-o" style="color: red; width: 50px;"></i>@lang('messages.file_name') : {{ isset($image->file->name) ? $image->file->name:'..' }}</p><br>--}}
{{--                                <p style="color: red;"> @lang('messages.file_type')--}}
{{--                                    : {{ isset($image->file->name) ? $image->file->name:'..' }}</p><br>--}}
{{--                                <p> @lang('messages.file_desc')--}}
{{--                                    : {{ isset($image->description) ? $image->description:'..' }}</p><br>--}}
{{--                                <div class="image" style="width: 65px;height: 80px;">--}}
{{--                                    <a href="{{route('inspection_view_file',$image->id)}}" target="_blank">--}}
{{--                                        <img src="{{asset('Front/assets/imgs/pdf-icon.jpg')}}" alt="image"--}}
{{--                                             style="width: 100%;">--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="buttons ">--}}
{{--                                --}}{{--                                <a href="{{route('front.auction_show_update',$auction->id)}}"--}}
{{--                                --}}{{--                                   class="bid">@lang('messages.update')</a>--}}
{{--                                <a data-id="{{ $image->id }}" class="delete-action"--}}
{{--                                   href="{{route('inspection_view_file',$image->id)}}"--}}
{{--                                   style="background-color: #1e3c48;">--}}
{{--                                    <i class="icon-database-remove"></i>@lang('messages.delete')--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
