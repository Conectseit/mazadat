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
                <i class="fal fa-exclamation-circle"></i>
                <div class="text">
                    <p>{{$notification->text}} </p>
                    <small class="date">{{$notification->created_at->diffForHumans()}}</small>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <center><h2> @lang('messages.you_dont_have_notifications_yet') </h2></center>
        @endif
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush

































{{--@extends('front.layouts.master')--}}
{{--@section('title', trans('messages.user_passport'))--}}
{{--@section('style')--}}
{{--    <style></style>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <section class="my-wallet-page">--}}
{{--        <div class="container">--}}
{{--            <nav class="breadcrumb-nav" aria-label="breadcrumb">--}}
{{--                <ol class="breadcrumb">--}}
{{--                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>--}}
{{--                    <li class="breadcrumb-item active" aria-current="page"> user_passport</li>--}}
{{--                </ol>--}}
{{--            </nav>--}}
{{--        </div>--}}

{{--        @include('Dashboard.layouts.parts.validation_errors')--}}
{{--        <div class="container">--}}
{{--            <div class="bank-form">--}}
{{--                <form action="{{route('front.upload_passport')}}" method="post" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <h5 class="title">قم برفع  جواز السفر الخاص بك</h5>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="upload-images">--}}
{{--                                <div class="receipt-img" id="myImg"  name="passport_image">--}}
{{--                                    <img src={{Auth::guard('web')->user()->passport_image_path}} alt="my-image">--}}
{{--                                </div>--}}
{{--                                <div class="text">--}}
{{--                                    <p>رفع صورة</p>--}}
{{--                                    <input type="file" id="myImgUploader"  name="passport_image">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <div class="form-group mb-4">--}}
{{--                                <i class="fal fa-calendar"></i>--}}
{{--                                <input type="text" class="form-control" placeholder="select passport_expiry_date" id="datepicker"--}}
{{--                                       name="passport_expiry_date" required>--}}
{{--                            </div>--}}
{{--                            <button type="submit" class="submit-btn">ارسال </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <hr>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@stop--}}

{{--@push('scripts')--}}
{{--    <script>--}}

{{--    </script>--}}
{{--@endpush--}}
