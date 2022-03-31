@extends('front.layouts.master')
@section('title', trans('messages.about_app'))
@section('style')
    <style></style>
@endsection

@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    <section class="about-us-page" dir="{{ direction() }}">
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
