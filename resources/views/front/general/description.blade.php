@extends('front.layouts.master')
@section('title', trans('messages.description'))
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
            <div class="text"style="height: 500px;overflow-y: auto !important;" >
                <h3 style="color: var(--main-color)">{{trans('messages.description')}}</h3>{!! $app_description!!}

            </div>
        </div>
    </section>
@stop

