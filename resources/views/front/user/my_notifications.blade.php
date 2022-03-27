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

    <section class="notifications-page">
        @if($_notifications->count() > 0)
            <div class="container">
                @foreach($_notifications as $notification)
                    <div class="notification-item">
                        <i class="fa fa-bell fa-fw"></i>

                        @if(isset($notification->auction_id))
                            <div class="col-lg-2">
                                <div>
                                    <a href="{{route('front.auction_details',$notification->auction_id)}}"
                                       data-popup="lightbox">
                                        <img src="{{ $notification->auction->first_image_path }}" alt="" width="80"
                                             height="80" class="img-circle"></a>
                                </div>
                            </div>
                        @endif
                        <div class="text">
                            <p>{{$notification->text}} </p>
                            <small class="date">{{$notification->created_at->diffForHumans()}}</small>
                        </div>
                        @if(isset($notification->auction_id))
                            <div class="col-lg-2">
                                <div>
                                    <a href="{{route('front.auction_details',$notification->auction_id)}}"
                                       class="bid" style="color: #1e3c48;">@lang('messages.auction.show')</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center;"><h2> @lang('messages.you_dont_have_notifications_yet') </h2></div>
        @endif
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
