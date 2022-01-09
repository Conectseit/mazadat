@extends('front.layouts.master')
@section('title', 'splash')
@section('style')
    <style> </style>
@endsection
@section('content')
    <section class="categories">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-lg-3 col-md-6">
                    <a href="category-items.html" class="cate-card">
                        <i class="fal fa-city"></i>
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
