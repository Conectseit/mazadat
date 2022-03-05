@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style>
        .save-btn {
            width: 55.5%;
            padding: 24px;
            margin: 12px;
        }
        #z{padding-right: 370px;}

        .my-2 {
            margin-top: .5rem !important;
            margin-bottom: .5rem !important;
            padding-top: 56px;
        }

    </style>
@endsection

@section('content')
    @include('front.auctions.parts.head')
    <section class="my-wallet-page">
        <div class="container">
            <h3 class="title">اهلا بك في موقع مزادات ....</h3><br><br>


            <div class="">
                <div class="row">
                    <div class="col-md-6" >
                        <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                            <a href="{{route('front.show_register_person')}}">{{trans('messages.register_person')}}</a>
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                            <a href="{{route('front.show_register_company')}}">{{trans('messages.register_company')}}<br></a>
                        </div>
                    </div>
                </div>
                <div class="row d-flex align-items-center my-2">
                    <h5 class="title text-center">
                        <a class="text-dark" href="{{route('front.home')}}">{{trans('messages.login_as_visitor')}}</a> |
                        <a class="text-primary" href="{{route('front.show_login')}}">{{trans('messages.already_has_account')}}<br></a>
                    </h5>
                </div>


            </div>
            <br><br>








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






