@extends('front.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('style')
@stop
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="my-wallet-page"  dir="{{ direction() }}">
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-md-6" >
                        <a href="{{route('front.pages')}}">
                            <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                                {{trans('messages.page.pages')}}
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6" >
                        <a href="{{route('front.blogs')}}">
                            <div class="submit-btn btn btn-primary submit-btn save-btn mx-auto">
                                {{trans('messages.blog.blogs')}}<br>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

