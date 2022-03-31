@extends('front.layouts.master')
@section('title', trans('messages..my_watched_auctions'))
@section('style')
    <style></style>
@endsection

@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="watching-page" dir="{{ direction() }}">
        <div class="container">
{{--            <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i class="fal fa-arrow-circle-right text-black"></i> </a> حسابي الشخصي<br><br>--}}
            <h5 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}</h5><br>
            @if($auctions->count() > 0)
                @foreach($auctions as $auction)
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
                                            start_at: {{ ($auction->start_date->format('l, m/d/Y  h s') ) }}

                                        </p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-ticket"></i>{{ ($auction->count_of_buyer ) }}</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-tag"></i>{{($auction->value_of_increment)}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p><i class="fal fa-gavel"></i>{{($auction->start_auction_price)}} $</p>
                                            </div>
                                            <div class="col-sm-6">
                                                {{--                                        <p><i class="fal fa-clock"></i>{{$auction->remaining_time}}</p>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="buttons">
                                    <a href="{{route('front.auction_details',$auction->id)}}" class="bid">المزايدة
                                        الان</a>
                                    <a href="{{route('front.delete_watch_auction',$auction->id)}}"
                                       class="remove">@lang('messages.auction.remove_from_watched')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center;">
                    <h2> @lang('messages.you_dont_have_watched_auctions_yet') </h2></div>
            @endif
        </div>

    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
