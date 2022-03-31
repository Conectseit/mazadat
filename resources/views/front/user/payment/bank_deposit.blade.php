@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="my-wallet-page" dir="{{ direction() }}">
        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="padding-right: 10px;"><a
                            href="{{route('front.my_profile')}}">{{ trans('messages.my_profile') }}</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{route('front.my_wallet')}}">{{ trans('messages.user.my_wallet')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('messages.bank_deposit')}}</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>{{__('messages.bank_deposit')}}</h2>
                </div>
            </div>
        </div>
        @include('front.layouts.parts.alert')

        <div class="container">
            <div class="wallet-details">
                <div class="row">
                    <div class="col-md-3">
                        <ul>
                            <li>
                                <p> {{trans('messages.account_name')}}:</p>
                                <p>{{$account_name}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.bank_name')}}:</p>
                                <p>{{$bank_name}}</p>
                            </li>
                            <li>
                                <p>{{trans('messages.account_number')}}:</p>
                                <p>{{$account_number}}</p>
                            </li>
                            <li>
                                <p>{{trans('messages.branch')}}:</p>
                                <p>{{$branch}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.swift_code')}}:</p>
                                <p>{{$swift_code}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.routing_number')}}:</p>
                                <p>{{$routing_number}}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        {{--                        <div class="links" style="height: 18px; width:auto;">--}}
                        {{--                            <a href="https://www.riyadbank.com/ar/branches-atms">{{trans('messages.ATM_locations_near_you')}}<br></a>--}}
                        {{--                        </div>--}}
                        <div class="main-links">
                            <a href="{{route('front.send_sms_bank_info')}}">{{trans('messages.send_sms')}} </a><br>

                        </div>
                    </div>
                    <div class="col-md-3">

                            <a href="https://www.riyadbank.com/ar/branches-atms" style="color: darkblue; text-decoration:underline">{{trans('messages.ATM_locations_near_you')}}
                                <br></a>

                            {{--                            <a href="#">ارسال عن طريق البريد<br>الالكترونى</a>--}}
                    </div>
                </div>
            </div>
            <div class="bank-form">
                <form action="{{route('front.upload_receipt')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="title"> {{trans('messages.upload_receipt')}}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="upload-images">
                                <div class="receipt-img" id="myImg" name="image">
                                </div>
                                <div class="text">
                                    <p>{{trans('messages.choose_image')}}</p>
                                    <input type="file" id="myImgUploader" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                {{trans('messages.amount')}}:
                                <input type="number" class="form-control" placeholder="" name="amount" required>
                            </div>
                            <div class="form-group mb-4">
                                {{trans('messages.date')}}:
                                <i class="fal fa-calendar" style="padding-inline: 30px; padding-top: 5px;"></i>
                                <input type="text" class="form-control" placeholder="" id="datepicker"
                                       name="date" required>
                            </div>
                            <button type="submit" class="submit-btn">{{trans('messages.send_receipt')}} </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
