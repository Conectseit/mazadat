@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style>
        .save-btn {
            width: 55.5%;
            padding: 24px;
            margin: 12px;
            color: #fff;
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
    <section class="my-wallet-page"  dir="{{ direction() }}">
        <div class="container">
            <h3 class="title"> {{trans('messages.welcome_in_mazadat')}}</h3><br><br>

            <div class="">
                <div class="row">
                    <div class="col-md-6" >
                        <a href="{{route('front.show_register_person')}}">
                            <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                                {{trans('messages.register_person')}}
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6" >
                        <a href="{{route('front.show_register_company')}}">
                            <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                                {{trans('messages.register_company')}}<br>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="row d-flex align-items-center my-2">
                    <h5 class="title text-center">
                        <a class="text-primary" href="{{route('front.show_login')}}">already have account{{trans('messages.already_has_account')}}<br></a>
                    </h5>
                </div>
                <div class="row d-flex align-items-center my-1">
                    <h5 class="title text-center">
                        <a class="text-dark" href="{{route('front.home')}}">{{trans('messages.login_as_visitor')}}</a> ...
                    </h5>
                </div>
            </div>
        </div>
    </section>

@stop






