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
                    <li class="breadcrumb-item active" aria-current="page">محفظتى</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <i class="fal fa-wallet"></i>
                    <h2>3000 د.إ</h2>
                </div>

            </div>
        </div>
        <div class="container">
            <ul class="wallet-details">
                <li>
                    <p>الإيداع الحالي:</p>
                    <p>3000 د.إ</p>
                </li>
                <li>
                    <p>الحد المتاح:</p>
                    <p>3000 د.إ</p>
                </li>
            </ul>

            <div class="limit-choice">
                <h5 class="title">اختر الحد الخاص بك</h5>
                <div class="bid-input">
                    <span class="minus" id="minus">
                        <i class="fal fa-minus"></i>
                    </span>
                    <h4>د.إ</h4>
                    <input type="number" name="bid-value" id="bidInput" value="26000" />
                    <span class="plus" id="plus">
                        <i class="fal fa-plus"></i>
                    </span>
                </div>
            </div>
            <div class="payment-method">
                <h5 class="title">اختر طريقة الدفع</h5>
                <ul class="methods">
                    <li><a href="{{route('front.cheque_payment')}}">شيك</a></li>
                    <li><a href="{{route('front.bank_deposit')}}">ايداع بنكى</a></li>
                    <li><a href="{{route('front.online_payment')}}">الدفع عبر الإنترنت (بطاقة الائتمان)</a></li>
                </ul>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
