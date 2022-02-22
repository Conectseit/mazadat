@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>
        .add-auction.btn{
            text-align: center;
            border: 1px solid #fff;
            padding: 8px;
            color: #fff;
            font-size: 20px;
            background: #1e3c48;
        }
        .carousel-item img{
            height: 320px;
            padding-top:20px;
        }
    </style>
@endsection


@section('content')
    @include('front.layouts.parts.alert')
    <div class="p-1">
        <div id="carouselExample" class="carousel slide w-100" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Social Facilities Center</h5>
                        <p>University Campus</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide2.jpg" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Anastasios G. Leventis</h5>
                        <p>University House</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://www.cs.ucy.ac.cy/courses/EPL425/labs/LAB10/slide3.jpg" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Faculty of Engineering</h5>
                        <p>University Campus</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" data-bs-target="#carouselExample" type="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" data-bs-target="#carouselExample" type="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <section class="categories">

        <div class="container">
            <div class="row">
                <div class=" d-flex justify-content-between" >
                    <a href="{{route('front.show_add_auction')}}" class="add-auction btn "><b>  <i class="fal fa-plus-circle"></i>  </b>{{ trans('messages.auction.add') }}</a>

                    <a href="{{route('front.company_auctions')}}" class="add-auction btn"><b>  <i class="fal fa-gavel"></i>  </b>{{ trans('messages.company.companies_auctions') }}</a>
                </div>
            </div><br>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-lg-3 col-md-6">
                    <a href="{{route('front.category_auctions',$category->id)}}" class="cate-card">
{{--                        <i class="fal fa-city"></i>--}}
                        <img src="{{ $category->ImagePath }}" alt="" width="50" height="50" class="img-circle">

                        <h4>{{$category->$name}}</h4>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @include('front.layouts.splash')

@stop

@push('scripts')
    <script>

    </script>
@endpush
