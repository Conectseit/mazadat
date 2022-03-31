@extends('front.layouts.master')
@section('title', trans('messages.question.questions'))
@section('style')
    <style></style>
@endsection

@section('content')
    <main class="categories-bar row" >
        @include('front.layouts.parts.nav_categories')
    </main>
    <section class="notifications-page" dir="{{ direction() }}">
        <div class="container">
            @foreach($questions as $questionn)
                <div class="notification-item">
                    <i class="fal fa-question-circle"></i>
                    <div class="text">
                        <p>
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

@push('scripts')
    <script>

    </script>
@endpush
