@extends('front.layouts.master')
@section('title', trans('messages.question.questions'))
@section('content')
    <main class="categories-bar row" >
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="notifications-page" dir="{{ direction() }}">
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
            @foreach($questions as $questionn)
                <div class="notification-item">
                    <i class="fal fa-question-circle"></i>
                    <div class="text">
                        <p style="color: var(--main-color);">
                            {{$questionn->$question}}
                        </p><hr>
                        <p>
                            {{$questionn->$replay}}
                        </p>

                    </div>
                </div>
            @endforeach
        </div>
    </section>

@stop

