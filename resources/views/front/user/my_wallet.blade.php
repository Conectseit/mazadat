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
                    <li class="breadcrumb-item"  style="padding-right: 10px;"><a href="{{route('front.my_profile')}}"> {{ trans('messages.my_profile') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ trans('messages.user.my_wallet')}}</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance" >
            <div class="container">
                <div class="balance-content">
                    <i class="fal fa-wallet" style="padding:12px; "></i>
                    <h2>{{$user->wallet}} ريال- سعودي</h2>
                </div>

            </div>
        </div>
        <div class="container">
            <ul class="wallet-details">
                <li>
                    <p> {{__('messages.current_wallet')}}</p>
                    <p>{{$user->wallet}} ريال- سعودي</p>
                </li>
                <li>
                    <p> {{__('messages.available_limit')}}</p>
                    <p>{{$user->available_limit}} ريال- سعودي</p>
                </li>
            </ul>

            <div class="limit-choice">
                <h5 class="title"> {{__('messages.choose_available_limit')}}</h5>
                <form action="{{route('front.choose_available_limit')}}" method="post">
                    @csrf
                <div class="bid-input">
                    <span class="minus" id="minus">
                        <i class="fal fa-minus"></i>
                    </span>
                    <h4>ريال </h4>
                    <input type="number" name="available_limit" id="bidInput" value="{{$user->available_limit}}" />
                    <span class="plus" id="plus">
                        <i class="fal fa-plus"></i>
                    </span>
                </div>

                    <button class="submit-btn btn btn-primary submit-btn save-btn"> {{trans('messages.save')}}</button>
                </form>
            </div>
            <div class="payment-method">
                <h5 class="title"> {{__('messages.choose_payment_method')}}</h5>
                <ul class="methods" >
                    <li><a href="{{route('front.cheque_payment')}}">{{__('messages.cheque')}}</a></li>
                    <li><a href="{{route('front.bank_deposit')}}">{{__('messages.bank_deposit')}}</a></li>
                    <li><a href="{{route('front.online_payment')}}">{{__('messages.online_pay')}}</a></li>
                </ul>
            </div>
        </div>
    </section>
@stop

