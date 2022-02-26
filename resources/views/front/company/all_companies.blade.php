@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style>

    </style>
@endsection


@section('content')
    @include('front.layouts.parts.alert')


    <section class="categories">

        <div class="container">
            <div class="row">
                <div class=" d-flex justify-content-between" >
                    <h4>قائمة الشركات</h4>
                </div>
            </div><br>

            @foreach($companies as $category)
            <div class="row">
                    <div class="col-lg-3">
                        <div class="main-image" style="height: 200px;">
                            <img src="{{$category->image_path}}" alt="image" class="img-thumbnail">
                        </div>
                    </div>

                    <div class="col-lg-9">


                        <a href="{{route('front.company_auctions',$category->id)}}" class="image">
                            <div class="details" id="details">
                                <h4>{{$category->user_name}}</h4>
                            </div>
                        </a>

                    </div>

            </div>
                @endforeach
            </div>

    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
