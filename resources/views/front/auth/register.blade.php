@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style>
        .save-btn {
            width: 70.5%;
            padding: 40px;
            margin: 16px;
        }
        #z{padding-right: 370px;}

    </style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="my-wallet-page">
        <div class="container">
            <h3 class="title">اهلا بك في موقع مزادات ....</h3><br>


            <div class="">
                <div class="row">
                    <div class="col-md-6" id="zz">
                        <div class="submit-btn btn btn-primary submit-btn save-btn">
                            <a href="{{route('front.show_register_person')}}">{{trans('messages.register_person')}}</a>
                        </div>
                    </div>
                    <div class="col-md-6" id="zzz">
                        <div class="submit-btn btn btn-primary submit-btn save-btn">
                            <a href="{{route('front.show_register_company')}}">{{trans('messages.register_company')}}<br></a>
                        </div>
                    </div>
{{--                    <div id="z">--}}
{{--                        <h5 class="title">--}}
{{--                            <a href="{{route('front.home')}}">{{trans('messages.login_as_visitor')}}</a>--}}
{{--                            <a href="{{route('front.show_login')}}">{{trans('messages.already_has_account')}}<br></a>--}}
{{--                        </h5>--}}
{{--                    </div>--}}

                </div>

            </div>









{{--            <div class="row" style="padding-top: 20px;">--}}
{{--                <div class="col-lg-12">--}}
{{--                        <form action="{{route('front.show_register_person')}}" method="get">--}}
{{--                            @csrf--}}
{{--                            <button--}}
{{--                                class="submit-btn btn btn-primary submit-btn save-btn"> {{trans('messages.register_person')}}</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                <div class="row" style="padding-top: 20px;">--}}
{{--                    <div class="col-lg-12">--}}
{{--                            <form action="{{route('front.show_register_company')}}" method="get">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="fcm_web_token" value="">--}}
{{--                                <button--}}
{{--                                    class="submit-btn btn btn-primary submit-btn save-btn"> {{trans('messages.register_company')}}</button>--}}
{{--                            </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                </div>--}}

{{--            <h5 class="title">الدخول كزائر</h5>--}}

        </div>
    </section>

@stop

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        messaging.getToken()--}}
{{--            .then(currentToken => {--}}
{{--                if (currentToken){--}}
{{--                    $('input[name=fcm_web_token]').val(currentToken);--}}
{{--                } else {--}}
{{--                    console.log('No Instance ID token available. Request permission to generate one.');--}}
{{--                }--}}
{{--            })--}}
{{--            .catch(err => console.log('An error occurred while retrieving token. ', err));--}}
{{--    </script>--}}
{{--@endpush--}}





