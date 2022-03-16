@extends('front.layouts.master')
@section('title', trans('messages.auction.my_auctions'))
@section('style')
    <style></style>
@endsection

@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="watching-page">
        <div class="container">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home"
                            aria-selected="true">{{ trans('messages.auction.on_progress') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile"
                            aria-selected="false">{{ trans('messages.auction.pending') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">{{ trans('messages.auction.done') }}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>

                    @if($on_progress_auctions->count() > 0)
                            @foreach($on_progress_auctions as $auction)
                                <div class="watching-card">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="card list-card" id="itemCard">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                                                            يبدأ فى الثلاثاء , 16/11/2021 , 10:10
                                                        {{trans('messages.auction.start_at')}} : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}:{{ ($auction->count_of_buyer ) }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-tag"></i>
                                                            {{trans('messages.auction.value_of_increment')}} : {{($auction->value_of_increment)}}</p>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>
                                                                {{trans('messages.auction.current_price')}}:{{($auction->current_price)}}</p>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}:{{($auction->start_auction_price)}}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-clock"></i>{{$auction->remaining_time['days']}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
{{--                                            <div class="buttons">--}}
{{--                                                <a href="{{route('front.auction_details',$auction->id)}}" class="bid"> متابعة</a>--}}
{{--                                                <a href="{{route('front.cancel_bid_auction',$auction->id)}}" class="remove">الخروج</a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    @else
                        <center><h2> @lang('messages.you_dont_have_auctions_yet') </h2></center>
                    @endif

                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>

                    @if($pending_auctions->count() > 0)
                        @foreach($pending_auctions as $auction)
                            <div class="watching-card">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="card list-card" id="itemCard">
                                            <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                <div class="overlay"></div>
                                                <img src="{{$auction->first_image_path}}" alt="card-img">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                <p class="start-date info-item">
                                                    <i class="fal fa-calendar-alt"></i>
                                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10
                                                    {{trans('messages.auction.start_at')}} : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                </p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}:{{ ($auction->count_of_buyer ) }}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-tag"></i>
                                                            {{trans('messages.auction.value_of_increment')}} : {{($auction->value_of_increment)}}</p>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-gavel"></i>
                                                            {{trans('messages.auction.current_price')}}:{{($auction->current_price)}}</p>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}:{{($auction->start_auction_price)}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-clock"></i>{{$auction->remaining_time['days']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="buttons">
                                            <a href="{{route('front.auction_show_update',$auction->id)}}" class="bid">@lang('messages.update')</a>
                                            <a href="{{route('front.delete-auction',$auction->id)}}" class="remove">@lang('messages.delete')</a>
{{--                                            <a data-id="{{ $auction->id }}" class="delete-action"--}}
{{--                                               href="{{ Url('/auction/auction/'.$auction->id) }}">--}}
{{--                                                <i class="icon-database-remove"></i>@lang('messages.delete')--}}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <center><h2> @lang('messages.you_dont_have_auctions_yet') </h2></center>
                    @endif
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @if($ended_auctions->count() > 0)
                        @foreach($ended_auctions as $auction)
                            <div class="watching-card">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="card list-card" id="itemCard">
                                            <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                <div class="overlay"></div>
                                                <img src="{{$auction->first_image_path}}" alt="card-img">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                <p class="start-date info-item">
                                                    <i class="fal fa-calendar-alt"></i>
                                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10
                                                    {{trans('messages.auction.start_at')}} : {{ ($auction->start_date->format('l, m/d/Y') ) }}
                                                </p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}:{{ ($auction->count_of_buyer ) }}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-tag"></i>
                                                            {{trans('messages.auction.value_of_increment')}} : {{($auction->value_of_increment)}}</p>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-gavel"></i>
                                                            {{trans('messages.auction.current_price')}}:{{($auction->current_price)}}</p>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}:{{($auction->start_auction_price)}}</p>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p><i class="fal fa-clock"></i>{{$auction->remaining_time['days']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        {{--                                            <div class="buttons">--}}
                                        {{--                                                <a href="{{route('front.auction_details',$auction->id)}}" class="bid"> متابعة</a>--}}
                                        {{--                                                <a href="{{route('front.cancel_bid_auction',$auction->id)}}" class="remove">الخروج</a>--}}
                                        {{--                                            </div>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <center><h2> @lang('messages.you_dont_have_auctions_yet') </h2></center>
                    @endif

                </div>
            </div>

        </div>
    </section>
@stop

@section('scripts')
{{--    @include('Dashboard.layouts.parts.ajax_delete', ['model' => 'auction'])--}}


{{--<script>--}}
{{--    let modelTable = '{{ str()->plural('auction') }}';--}}
{{--    let currentModel = '{{ 'auction' }}';--}}

{{--    $('a.delete-action').on('click', function (e) {--}}
{{--        var id = $(this).data('id');--}}
{{--        var tbody = $('table#'+modelTable+' tbody');--}}
{{--        var count = tbody.data('count');--}}

{{--        e.preventDefault();--}}

{{--        swal({--}}
{{--            title: "{{ trans('messages.confirm-delete-message-var', ['var' => trans('messages.'.'auction'.'.'.'auction')]) }}",--}}
{{--            icon: "warning",--}}
{{--            buttons: true,--}}
{{--            dangerMode: true,--}}
{{--        })--}}
{{--            .then((willDelete) => {--}}
{{--                if (willDelete) {--}}
{{--                    var tbody = $('table#'+modelTable+' tbody');--}}
{{--                    var count = tbody.data('count');--}}
{{--                    $.ajax({--}}
{{--                        type: 'POST',--}}
{{--                        --}}{{--url: '{{ Url('dashboard/ajax-delete-' . auction) }}',--}}
{{--                        url: '{{ route('front.ajax-delete-' . 'auction') }}',--}}
{{--                        --}}{{--url: '{{ Url('/'.auction.'/'.auction.'/'.auction->id) }}',--}}
{{--                            --}}{{--url: '{{ route('categories.destroy',$category->id) }}',--}}
{{--                        data: {id: id},--}}
{{--                        success: function (response) {--}}
{{--                            if (response.deleteStatus) {--}}
{{--                                // $('#city-row-'+id).fadeOut(); count = count - 1;tbody.attr('data-count', count);--}}
{{--                                $('#'+currentModel+'-row-' + id).remove();--}}
{{--                                count = count - 1;--}}
{{--                                tbody.attr('data-count', count);--}}
{{--                                swal(response.message, {icon: "success"});--}}
{{--                            }--}}
{{--                            else {--}}
{{--                                swal(response.error);--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function (x) {--}}
{{--                            crud_handle_server_errors(x);--}}
{{--                        },--}}
{{--                        complete: function () {--}}
{{--                            if (count === 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--                else {--}}
{{--                    swal("تم الغاء الحذف");--}}
{{--                }--}}
{{--            });--}}
{{--    });--}}

{{--</script>--}}
@stop
