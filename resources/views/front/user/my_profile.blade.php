@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
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
                                    <h4 class="name">{{auth()->user()->full_name }}</h4>
                                    <h5 class="email">{{Auth::guard('web')->user()->email}} </h5>
                                    <p>
                                        {{trans('messages.bio')}}:
                                        {{auth()->user()->bio }}
                                    </p>
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
                                <a href="{{route('front.my_bids')}}">مزاداتي</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_watched')}}">مشاهدة</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_wallet')}}">المحفظة</a>
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
