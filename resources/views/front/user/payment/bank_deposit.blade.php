@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="my-wallet-page">
        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.my_wallet')}}">محفظتى</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ايداع بنكى</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance" >
            <div class="container" >
                <div class="balance-content">
                    <h2>ايداع بنكى</h2>
                </div>
            </div>
        </div>
        @include('Dashboard.layouts.parts.validation_errors')
        <div class="container">
            <div class="wallet-details">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <p> {{trans('messages.account_name')}}:</p> <p>{{$account_name}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.bank_name')}}:</p> <p>{{$bank_name}}</p>
                            </li>
                            <li>
                                <p>{{trans('messages.account_number')}}:</p> <p>{{$account_number}}</p>
                            </li>
                            <li>
                                <p>{{trans('messages.branch')}}:</p> <p>{{$branch}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.swift_code')}}:</p> <p>{{$swift_code}}</p>
                            </li>
                            <li>
                                <p> {{trans('messages.routing_number')}}:</p> <p>{{$routing_number}}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
{{--                        <div class="links" style="height: 18px; width:auto;">--}}
{{--                            <a href="https://www.riyadbank.com/ar/branches-atms">{{trans('messages.ATM_locations_near_you')}}<br></a>--}}
{{--                        </div>--}}
                        <div class="main-links">
                            <a href="{{route('front.send_sms_bank_info')}}">ارسال عن طريق رسالة<br>نصية</a>
                            <a href="https://www.riyadbank.com/ar/branches-atms">{{trans('messages.ATM_locations_near_you')}}<br></a>

                            {{--                            <a href="#">ارسال عن طريق البريد<br>الالكترونى</a>--}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bank-form">
                <form action="{{route('front.upload_receipt')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="title">قم برفع ايصال الدفع الخاص بك</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="upload-images">
                                <div class="receipt-img" id="myImg"  name="image">
                                </div>
                                <div class="text">
                                    <p>رفع صورة</p>
                                    <input type="file" id="myImgUploader"  name="image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <input type="number" class="form-control" placeholder="القيمة" name="amount" required>
                            </div>
                            <div class="form-group mb-4">
                                <i class="fal fa-calendar"></i>
                                <input type="text" class="form-control" placeholder="التاريخ" id="datepicker"
                                       name="date" required>
                            </div>
                            <button type="submit" class="submit-btn">ارسال الايصال</button>
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
