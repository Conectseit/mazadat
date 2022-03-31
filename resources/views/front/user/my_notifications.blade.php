@extends('front.layouts.master')
@section('title', trans('messages.notification.notifications'))
@section('style')
    <style></style>
@endsection

@section('content')

    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="notifications-page" dir="{{ direction() }}">

        <div class="container">
            <h5 class="title">
                <a href="{{ route('front.my_profile') }}" class="mt-2 mx-1 back"> <i
                        class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>
                {{ trans('messages.my_profile') }}</h5><br>

            {{--                <h5 class="title"><a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i> </a>u</h5><br>--}}
            @if($_notifications->count() > 0)
                @foreach($_notifications as $notification)
                    <div class="notification-item">

                        @if(isset($notification->auction_id))
                            <div class="col-lg-2" dir="{{ direction() }}">
                                <div>
                                    <a href="{{route('front.auction_details',$notification->auction_id)}}">
                                        <img src="{{ $notification->auction->first_image_path }}" alt="" width="50"
                                             height="50" class="img-thumbnail"></a>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-8" dir="{{ direction() }}">
                            <div class="text">
                                <p><i class="fa fa-bell fa-fw"></i>{{$notification->text}} </p>
                                <small class="date">{{$notification->created_at->diffForHumans()}}</small>
                            </div>
                        </div>
                        @if(isset($notification->auction_id))
                            <div class="col-lg-2" dir="{{ direction() }}">
                                <div>
                                    <a href="{{route('front.auction_details',$notification->auction_id)}}"
                                       class="bid" style="color: #1e3c48;">@lang('messages.auction.show')</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div style="text-align: center;"><h2> @lang('messages.you_dont_have_notifications_yet') </h2></div>
            @endif
        </div>

    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
