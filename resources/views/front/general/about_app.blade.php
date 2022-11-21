@extends('front.layouts.master')
@section('title', trans('messages.about_app'))
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="about-us-page" dir="{{ direction() }}">
        <div class="container">
            <div class="row">
                <div class=" d-flex justify-content-between">
                    <h4>
                        <a href="{{ url()->previous() }}" class="mt-2 mx-1 back"> <i
                                class="fal fa-arrow-circle-{{ floating('right','left') }}" style="color: black;"></i>
                        </a>
                    </h4>
                </div>
            </div>
            <br>
            <div class="text">
                <p>
{{--                    {{$about_app}}--}}

                    {!! $about_app !!}</p>
            </div>
        </div>
    </section>
@stop
