@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="my-profile-page"  dir="{{ direction() }}">
        <div class="container">
            @if(auth()->user()->is_completed==0)
                Not verified account   <h3> {{ trans('messages.please_complete_your_data')}}  </h3>
            @endif
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="slogan-right">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img src="{{auth()->user()->image_path }}" alt="my-image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info">
                                    <h4 class="name">{{isset(auth()->user()->full_name)?auth()->user()->full_name :auth()->user()->user_name }}</h4>
                                    <h5 class="email">{{Auth::guard('web')->user()->email}} </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slogan-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{route('front.edit_profile')}}"> {{ trans('messages.user.update_profile')}} </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.show_complete_profile')}}">{{ trans('messages.user.complete_data')}}</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_bids')}}"> {{ trans('messages.user.bids')}}</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_watched')}}"> {{ trans('messages.user.watched_auctions')}}</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_wallet')}}">{{ trans('messages.user.wallet')}}</a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{route('front.my_auctions')}}"> {{ trans('messages.user.my_auctions')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
