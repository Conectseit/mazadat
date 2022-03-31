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
                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">{{ trans('messages.my_profile') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.my_wallet')}}">{{ trans('messages.user.my_wallet')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('messages.online_pay')}}</li>
                </ol>
            </nav>
        </div>
        @include('front.layouts.parts.alert')

        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>{{__('messages.online_payment')}}</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pay-online">
                <div class="images">
                    <img src="{{asset('Front/assets/imgs/visa-img.svg')}}" alt="visa">
                    <img src="{{asset('Front/assets/imgs/mastercard-img.svg')}}" alt="mastercard">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text">
                            @php($data= 'online_payment_conditions_'.app()->getLocale())

                            {{App\Models\Setting::where('key',$data)->first()->value}}

                        </p>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('front.send_payment') }}" method="post">
                            @csrf
                            <div class="form-group ">
                             <label for="amount" class="form-label">{{trans('messages.enter_amount_you_will_pay')}}</label>
                                <div class=" my-2">
                                    <input type="number" class="form-control"  name="amount" placeholder="{{trans('messages.amount')}}">
                                </div>
                                <input type="submit" class="pay-link" value="{{trans('messages.pay')}}">

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
