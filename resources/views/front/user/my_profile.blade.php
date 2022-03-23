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
    <section class="my-profile-page">
        <div class="container">
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
{{--                                    <p>--}}
{{--                                        {{trans('messages.bio')}}:--}}
{{--                                        {{auth()->user()->bio }}--}}
{{--                                    </p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slogan-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{route('front.edit_profile')}}">تعديل الحساب</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.show_complete_profile')}}">تكملة بيانات الحساب</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_bids')}}">مشاركاتي</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_watched')}}">مشاهداتي</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_wallet')}}">المحفظة</a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{route('front.my_auctions')}}">مزاداتي</a>
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
