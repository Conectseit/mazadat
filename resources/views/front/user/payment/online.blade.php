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
                    <li class="breadcrumb-item active" aria-current="page">الدفع الالكترونى</li>
                </ol>
            </nav>
        </div>
        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>الدفع الالكترونى</h2>
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
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad voluptatibus illo
                            officiis ducimus alias vel perspiciatis esse hic dolore in atque porro iusto impedit
                            mollitia
                            facilis, earum voluptate placeat? Quos?
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="pay-link">ادفع</a>
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
