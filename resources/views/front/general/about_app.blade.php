@extends('front.layouts.master')
@section('title', trans('messages.about_app'))
@section('style')
    <style></style>
@endsection

@section('content')
    @include('front.layouts.parts.nav_categories')

    <section class="about-us-page">
        <div class="container">
            <div class="text">
                <p>
                    {{$about_app}}
                </p>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
