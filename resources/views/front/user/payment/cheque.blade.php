@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="my-wallet-page" dir="{{ direction() }}">
        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="padding-right: 10px;"><a href="{{route('front.my_profile')}}">{{ trans('messages.my_profile') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.my_wallet')}}">{{ trans('messages.user.my_wallet')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.cheque')}}</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h3>{{ trans('messages.visit_our_offices')}}</h3>
                </div>
            </div>
        </div>
        <div class="container">
            <ul class="wallet-details">
                <li>
                    <p>{{ trans('messages.mobile')}} : </p>
                    <p>{{$mobile}}</p>
                </li>
                <li>
                    <p>{{ trans('messages.fax')}} : </p>
                    <p>{{$fax}}</p>
                </li>
                <li>
                    <p>{{ trans('messages.email')}} : </p>
                    <p>{{$email}}</p>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-6">
                    <div class="payment-method payment-country">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <ul class="methods">
                                <li>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                {{ trans('messages.address')}}
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                {{$address}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><br><br>
            <div class="terms">
                <div class="terms">
                    <h4>{{ trans('messages.our_address_on_map')}}:</h4>
                    <iframe id="map" src="https://maps.google.com/maps?q={{ $latitude }},{{ $longitude }}&hl=es&z=14&output=embed" width="100%" frameborder="0" style="border:0;height: 400px;" allowfullscreen="allowfullscreen"></iframe>

                </div>
            </div>
        </div>
    </section>
@stop
