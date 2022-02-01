@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style> #map { height: 400px;} </style>
@endsection

@section('content')
    <section class="my-wallet-page">

        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>
                    <li class="breadcrumb-item"><a href="{{route('front.my_wallet')}}">محفظتى</a></li>
                    <li class="breadcrumb-item active" aria-current="page">شيك</li>
                </ol>
            </nav>
        </div>

        <div class="wallet-balance">
            <div class="container">
                <div class="balance-content">
                    <h2>مكاتبنا</h2>
                </div>

            </div>
        </div>
        <div class="container">
            <ul class="wallet-details">
                <li>
                    <p>الهاتف:</p>
                    <p>{{$mobile}}</p>
                </li>
                <li>
                    <p>فاكس:</p>
                    <p>{{$fax}}</p>
                </li>
                <li>
                    <p>البريد الالكترونى:</p>
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
                                                العنوان
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


{{--                                <li>--}}
{{--                                    <div class="accordion-item">--}}
{{--                                        <h2 class="accordion-header" id="flush-headingTwo">--}}
{{--                                            <button class="accordion-button collapsed" type="button"--}}
{{--                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"--}}
{{--                                                    aria-expanded="false" aria-controls="flush-collapseTwo">--}}
{{--                                                El Raiyad--}}
{{--                                            </button>--}}
{{--                                        </h2>--}}
{{--                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"--}}
{{--                                             aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">--}}
{{--                                            <div class="accordion-body">--}}
{{--                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ullam--}}
{{--                                                repellat cupiditate esse! Tenetur, maiores laboriosam sequi dolorem--}}
{{--                                                libero voluptatum reiciendis omnis pariatur, neque consectetur aliquam--}}
{{--                                                dolorum incidunt sit odit!--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <hr><br><br>

            <div class="terms">
                <h4>{{ trans('messages.our_address_on_map')}}:</h4>

                <div class="form-group">
                    <div class="col-lg-12">
                        <input id="searchInput" class=" form-control"  placeholder=" اختر المكان علي الخريطة " name="other">
                        <div id="map"></div>
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="geo_lat" name="latitude" readonly="" placeholder=" latitude" class="form-control hidden d-none">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" id="geo_lng" name="longitude" readonly="" placeholder="longitude" class="form-control hidden d-none">
                    </div>
                </div>

            </div>

        </div>
    </section>
@stop

@push('scripts')
    <script>
            @include('Dashboard.layouts.parts.map')
    </script>
@endpush
