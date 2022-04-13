@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>
        .card-img-data {
            width: 300px;
            height: 200px;
        }

        .card {
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
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>

    @include('front.layouts.parts.alert')


    <section class="categories" dir="{{ direction() }}">
        <div class="container">

            <div class="row">
                <div class=" d-flex justify-content-between">
                    <h4>
                        <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                                class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i>
                        </a>
                        {{__('messages.company.list')}}
                    </h4>
                </div>
            </div>
            <br>
            <div class="row">
                @foreach($companies as $company)
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{route('front.company_auctions',$company->id)}}" class="btn btn-info">
                                    <p class="card-text"><img src="{{$company->image_path}}" alt="image"
                                                              class="card-img-data img-thumbnail"></p>
                                    {{$company->user_name}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@stop

