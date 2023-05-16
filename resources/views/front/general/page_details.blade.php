@extends('front.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('style')
    <style>
        .title-blog-page .blog-title {
            width: 65%;
        }

        .title-blog-page span {
            color: #8f98c5;
            font-size: 15px;
        }

        .title-blog-page h1 {
            font-size: 40px;
            color: var(--main-color);
            /*font-family: "Mon-bold";*/
            margin-bottom: 0;
            line-height: 50px;
        }

        .icons-share {
            position: relative;
        }

        .btn-14 {
            background: transparent;
            border: 1px solid #2a398c;
            border: 1px solid var(--main-color);
            z-index: 1;
        }

        .custom-btn {
            color: var(--main-color);
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
            transition: all .3s ease;
            position: relative;
            display: inline-block;
            box-shadow: inset 2px 2px 2px 0 hsl(0deg 0% 100% / 50%), 7px 7px 20px 0 rgb(0 0 0 / 10%), 4px 4px 5px 0 rgb(0 0 0 / 10%);
            outline: none;
        }


        .all-title h1, .all-title h2 {
            letter-spacing: 5px;
            color: red;
            font-size: 25px;
        }

        .all-title h2 span.tit-color {
            color: #ffc907;
        }

        .rtl .blog-sidebar h3:after {
            right: 0;
            left: auto;
        }

        .pad-40 {
            padding-top: 60px;
            padding-bottom: 30px;
        }


        .blog-sidebar .blog-side .media {
            padding-bottom: 15px;
            margin-top: 15px;
            align-items: center;
            border-bottom: 1px solid #d1915c;
        }

        .media {
            display: flex;
            align-items: flex-start;
        }

        .blog-sidebar .blog-side .media img {
            width: 90px;
            height: 90px;
            -o-object-fit: cover;
            object-fit: cover;
            border-radius: 10px;
        }

        .blog-side .media .media-body {
            margin-right: 20px;
            margin-left: 0;
            padding: 0px 10px;
        }

        .blog-sidebar .blog-side .media .media-body h4 {
            font-size: 22px;
            transition: .5s;
            color: #2a398c;
            line-height: 20px;
        }

        .blog-sidebar .blog-side .media .media-body span {
            font-size: 14px;
            color: #8f98c5;
        }

        .text a {
            text-decoration: underline;
            color: #464b8d;
            font-size: 25px;
        }

        .text h1 {
            color: #2a398c;
            font-size: 30px;
        }


        .blog-head .page-image img {
            width: 80%;
            height: 400px;

            margin:5px;
            -o-object-fit: cover;
            object-fit: cover;
        }
    </style>


@stop
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="notifications-page" dir="{{ direction() }}">
        <div class="container">
            <div class="blog-page">
                <div class="our-blog pad-40 fadeIn">

                    <div class="row">

                        <div class="col-sm-9">
                            <div class="pad-40">
                                <div class="title-blog-page d-flex justify-content-between">
                                    <div class="blog-title"><h1>{{$page_details->$name}}</h1> <span
                                            class="d-block mb-5 mt-3">{{$page_details->created_at->format('Y-m-d')}}</span>
                                    </div>
                                    <div class="icons-share float-right">
                                        <div class="share-button"><small
                                                class="custom-btn btn-14">{{trans('messages.share')}}</small></div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                @foreach($page_images as $page_image)

                                    <div class="row">
                                        <div class="text">
                                            <h3></h3>
                                            {!!$page_image->$description !!}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="blog-head">
                                            <div class="page-image">
                                                <img alt="{{$page_image->$name}}" src="{{$page_image->image_path}}"
                                                     class="lazyLoad isLoaded"></div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-sm-3" style="padding-right: 50px;">
                            <div class="pad-40">
                                <div class="blog-sidebar">
                                    <div class="all-title">
                                        <h2>  {{trans('messages.blog.related_blogs')}}<span class="tit-color">.</span>
                                        </h2>
                                    </div>

                                    @foreach($related_pages as $related_page)
                                        <div class="blog-side">
                                            <a href="{{route('front.page_details',$related_page->id)}}" class="">
                                                <div class="media"><img alt="{{$related_page->$name}}"
                                                                        src="{{$related_page->main_image_path}}"
                                                                        class="lazyLoad isLoaded">
                                                    <div class="media-body"><h4>{{$related_page->$name}}</h4>
                                                        <span>{{$related_page->created_at->format('Y-m-d')}}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@stop

