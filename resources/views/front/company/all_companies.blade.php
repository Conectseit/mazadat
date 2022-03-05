@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>
    .card-img-data{
        width: 300px;
        height: 200px;
    }
    .card{
        background: transparent;
        border: 0;
    }
    .btn-info {
        font-size: 20px;
        color: #fff;
        background-color: #1e3c48;
        border-color: #1e3c48;
    }
    .btn-info:hover {
        color: #1e3c48;
        background-color: #f9e6c6;
        border-color: #1e3c48;
    }
    </style>
@endsection


@section('content')
    @include('front.layouts.parts.nav_categories')

    @include('front.layouts.parts.alert')


    <section class="categories">

        <div class="container">
            <div class="row">
                <div class=" d-flex justify-content-between" >
                    <h4>قائمة الشركات</h4>
                </div>
            </div><br>



            <div class="row">
                @foreach($companies as $category)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('front.company_auctions',$category->id)}}" class="btn btn-info">
                            <p class="card-text"><img src="{{$category->image_path}}" alt="image" class="card-img-data img-thumbnail"></p>
                          {{$category->user_name}}</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

{{--            @foreach($companies as $category)--}}
{{--            <div class="row">--}}
{{--                    <div class="col-lg-3">--}}
{{--                        <div class="main-image" style="height: 200px;">--}}
{{--                            <img src="{{$category->image_path}}" alt="image" class="img-thumbnail">--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="col-lg-9">--}}


{{--                        <a href="{{route('front.company_auctions',$category->id)}}" class="image">--}}
{{--                            <div class="details" id="details">--}}
{{--                                <h4>{{$category->user_name}}</h4>--}}
{{--                            </div>--}}
{{--                        </a>--}}

{{--                    </div>--}}

{{--            </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}

    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
