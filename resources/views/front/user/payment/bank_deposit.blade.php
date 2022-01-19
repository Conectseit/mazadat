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
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>ايداع بنكى</h2>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="wallet-details">
                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            <li>
                                <p>account_name:</p>
                                <p>{{$account_name}}</p>
                            </li>
                            <li>
                                <p>bank_name:</p>
                                <p>{{$bank_name}}</p>
                            </li>
                            <li>
                                <p> account_number:</p>
                                <p>{{$account_number}}</p>
                            </li>
                            <li>
                                <p> branch:</p>
                                <p>{{$branch}}</p>
                            </li>
                            <li>
                                <p> iban:</p>
                                <p>{{$iban}}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="main-links">
                            <a href="#">ارسال عن طريق رسالة<br>نصية</a>
                            <a href="#">ارسال عن طريق البريد<br>الالكترونى</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bank-form">
                <form action="">
                    <h5 class="title">قم برفع ايصال الدفع الخاص بك</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="upload-images">
                                <div class="receipt-img" id="myImg">
                                </div>
                                <div class="text">
                                    <p>رفع صورة</p>
                                    <input type="file" id="myImgUploader">
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
