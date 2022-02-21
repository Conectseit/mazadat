@extends('front.layouts.master')
@section('title', trans('messages.home'))
@section('style')
    <style> </style>
@endsection
@section('content')
    @include('front.layouts.parts.alert')
    @include('front.layouts.splash')

    <section class="categories">

        <div class="container">
            <div class="row">
                <div class="" >
                    <a href="{{route('front.show_add_auction')}}" class="add-auction"><b><i class="icon-plus2"></i></b>{{ trans('messages.auction.add') }}</a>
                </div>
            </div><br>
            <div class="row">
                <div class="" >
                    <a href="{{route('front.company_auctions')}}" class="add-auction"><b><i class="icon-plus2"></i></b>{{ trans('messages.company.auctions') }}</a>
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
@stop

@push('scripts')
    <script>

    </script>
@endpush
