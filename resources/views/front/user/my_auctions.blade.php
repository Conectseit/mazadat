@extends('front.layouts.master')
@section('title', trans('messages.user.my_auctions'))
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="watching-page"  dir="{{ direction() }}">
        <div class="container">
            <h4 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}
            </h4><br>
            <div class="row">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#pending_auctions"
                                type="button" role="tab" aria-controls="profile"
                                aria-selected="false">{{ trans('messages.auction.pending') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#accepted_not_appear"
                                type="button" role="tab" aria-controls="accepted_not_appear"
                                aria-selected="false">{{ trans('messages.auction.accepted_not_appear') }}</button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#on_progress_auctions"
                                type="button" role="tab" aria-controls="home"
                                aria-selected="true">{{ trans('messages.auction.on_progress') }}</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#ended_auctions"
                                type="button" role="tab" aria-controls="contact"
                                aria-selected="false">{{ trans('messages.auction.done') }}</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="pending_auctions" role="tabpanel" aria-labelledby="profile-tab"><br>

                        @if($pending_auctions->count() > 0)
                            @foreach($pending_auctions as $auction)
                                <div class="watching-card" id="pending-item-{{ $auction->id }}">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="card list-card">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                        {{trans('messages.auction.start_at')}}
                                                        : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}
                                                                :{{ ($auction->count_of_buyer ) }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-tag"></i>
                                                                {{trans('messages.auction.value_of_increment')}}
                                                                : {{($auction->value_of_increment)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>
                                                                {{trans('messages.auction.current_price')}}
                                                                :{{($auction->current_price)}}</p>

                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}
                                                                :{{($auction->start_auction_price)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="buttons ">
                                                <a href="{{route('front.auction_show_update',$auction->id)}}"
                                                   class="bid">@lang('messages.update')</a>
                                                <a data-id="{{ $auction->id }}" class="delete-action"
                                                   href="{{ Url('/auction/auction/'.$auction->id) }}"
                                                   style="background-color: #1e3c48;">
                                                    <i class="icon-database-remove"></i>@lang('messages.delete')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center;"><h2> @lang('messages.you_dont_have_auctions_yet') </h2></div>
                        @endif
                    </div>
                    <div class="tab-pane fade  " id="on_progress_auctions" role="tabpanel" aria-labelledby="home-tab"><br>
                        @if($on_progress_auctions->count() > 0)
                            @foreach($on_progress_auctions as $auction)
                                <div class="watching-card">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="card list-card" id="itemCard-{{ $auction->id }}">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                        {{trans('messages.auction.start_at')}}
                                                        : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}
                                                                :{{ ($auction->count_of_buyer ) }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-tag"></i>
                                                                {{trans('messages.auction.value_of_increment')}}
                                                                : {{($auction->value_of_increment)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>
                                                                {{trans('messages.auction.current_price')}}
                                                                :{{($auction->current_price)}}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}
                                                                :{{($auction->start_auction_price)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center;"><h2> @lang('messages.you_dont_have_auctions_yet') </h2></div>
                        @endif

                    </div>
                    <div class="tab-pane fade  " id="accepted_not_appear" role="tabpanel" aria-labelledby="accepted_not_appear-tab"><br>
                        @if($accepted_not_appear_auctions->count() > 0)
                            @foreach($accepted_not_appear_auctions as $auction)
                                <div class="watching-card">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="card list-card" id="itemCard-{{ $auction->id }}">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                        {{trans('messages.auction.start_at')}}
                                                        : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}
                                                                :{{ ($auction->count_of_buyer ) }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-tag"></i>
                                                                {{trans('messages.auction.value_of_increment')}}
                                                                : {{($auction->value_of_increment)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>
                                                                {{trans('messages.auction.current_price')}}
                                                                :{{($auction->current_price)}}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}
                                                                :{{($auction->start_auction_price)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center;"><h2> @lang('messages.you_dont_have_auctions_yet') </h2></div>
                        @endif

                    </div>
                    <div class="tab-pane fade" id="ended_auctions" role="tabpanel" aria-labelledby="contact-tab"><br>
                        @if($ended_auctions->count() > 0)
                            @foreach($ended_auctions as $auction)
                                <div class="watching-card" id="watching-card-{{ $auction->id }}">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="card list-card" id="itemCard-{{ $auction->id }}">
                                                <a href="{{route('front.auction_details',$auction->id)}}" class="image">
                                                    <div class="overlay"></div>
                                                    <img src="{{$auction->first_image_path}}" alt="card-img">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ ($auction->$name ) }}</h5>
                                                    <p class="start-date info-item">
                                                        <i class="fal fa-calendar-alt"></i>
                                                        {{trans('messages.auction.start_at')}}
                                                        : {{  isset($auction->start_date)?$auction->start_date->format('l, m/d/Y'):''  }}
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-ticket"></i>{{trans('messages.auction.buyers')}}
                                                                :{{ ($auction->count_of_buyer ) }}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-tag"></i>
                                                                {{trans('messages.auction.value_of_increment')}}
                                                                : {{($auction->value_of_increment)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p><i class="fal fa-gavel"></i>
                                                                {{trans('messages.auction.current_price')}}
                                                                :{{($auction->current_price)}}</p>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <p>
                                                                <i class="fal fa-gavel"></i>{{trans('messages.auction.start_auction_price')}}
                                                                :{{($auction->start_auction_price)}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div style="text-align: center;"><h2> @lang('messages.you_dont_have_auctions_yet') </h2></div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@if($pending_auctions->count() > 0)
    @push('scripts')
        <script>
            let modelTable = 'auctions';
            let currentModel = 'auction';

            $(document).on('click', 'a.delete-action', function (e) {
                var id = $(this).data('id');
                let _token = '{{ csrf_token() }}';
                e.preventDefault();

                swal({
                    title: "{{ trans('messages.confirm-delete-message-var', ['var' => trans('messages.'.'auction'.'.'.'auction')]) }}",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: 'POST',
                                {{--                        url: '{{ Url('/ajax-delete-auction') }}',--}}
                                url: '{{ route('front.ajax-delete-auction') }}',
                                data: {id, _token},
                                success: function (response) {
                                    if (response.deleteStatus) {
                                        $(`#pending-item-${id}`).fadeOut();
                                        swal(response.message, {icon: "success"});
                                    }
                                },
                                error: (x) => swal(x, {icon: 'warning'}),
                                complete: function () {
                                    if (count === 1) tbody.append(`<tr><td colspan="5"><strong>No data available in table</strong></td></tr>`);
                                }
                            });
                        } else {
                            swal("تم الغاء الحذف");
                        }
                    });
            });

        </script>
    @endpush
@endif
