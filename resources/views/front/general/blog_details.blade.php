@extends('front.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('style')
    <style>
        .blog-head .image-blog img {
            width: 100%;
            height: 400px;
            -o-object-fit: cover;
            object-fit: cover;
        }
        .blog-head .image2-blog img {
            width: 100%;
            height: 100%;
        }

        .title-blog-page .blog-title {
            width: 65%;

        }

        .title-blog-page span {
            color: #8f98c5;
            font-size: 15px;
        }

        .title-blog-page h1 {
            font-size: 37px;
            color: var(--main-color);
            font-family: "Mon-bold";
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

        /*.btn-14:after {*/
        /*    position: absolute;*/
        /*    content: "";*/
        /*    width: 100%;*/
        /*    height: 0;*/
        /*    top: 0;*/
        /*    left: 0;*/
        /*    z-index: -1;*/
        /*    border-radius: 25px;*/
        /*    background-color: #2a398c;*/
        /*    background-color: var(--main-color);*/
        /*    background-image: linear-gradient(315deg,#2a398c,#2a398c 74%);*/
        /*    box-shadow: inset 2px 2px 2px 0 7px 7px 20px 0 hsla(0,0%,100%,.5) rgba(0,0,0,.1),4px 4px 5px 0 rgba(0,0,0,.1);*/
        /*    transition: all .3s ease;*/
        /*}*/

        .rtl .blog-sidebar {
            border-right: 1px solid #eee;
            padding: 0 20px 0 0;
            border-left: 0;
        }

        .rtl .all-title h1, .rtl .all-title h3 {
            letter-spacing: 5px;

        }

        .all-title h3 span.tit-color {
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

        /*.blog-sidebar h3:after, .rtl .blog-sidebar h3:after {*/
        /*    content: "";*/
        /*    position: absolute;*/
        /*    width: 70px;*/
        /*    height: 5px;*/
        /*    background: red;*/
        /*    bottom: -300px;*/
        /*    border-radius: 50px;*/
        /*}*/

        .blog-sidebar .blog-side .media {
            padding-bottom: 15px;
            margin-top: 15px;
            align-items: center;
            border-bottom: 1px solid #d1915c;
        }

        .blog-sidebar .blog-side .media img {
            width: 90px;
            height: 90px;
            -o-object-fit: cover;
            object-fit: cover;
            border-radius: 10px;
        }

        .rtl .blog-sidebar .blog-side .media .media-body {
            margin-right: 10px;
            margin-left: 0;
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

    </style>


@stop
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="notifications-page" dir="{{ direction() }}">
        <div class="row">
            <div class="blog-head">
                <div class="image-blog"><img alt="{{$blog_details->$name}}"
                                             src="{{$blog_details->image_path}}"
                                             class="lazyLoad isLoaded"></div>
            </div>
        </div>
        <div class="container">
            <div class="blog-page">
                <div class="our-blog pad-40 fadeIn">

                        <div class="row">

                            <div class="col-sm-8">
                                <div class="pad-40">
                                    <div class="title-blog-page d-flex justify-content-between">
                                        <div class="blog-title"><h1>{{$blog_details->$name}}</h1> <span
                                                class="d-block mb-5 mt-3">{{$blog_details->created_at->format('Y-m-d')}}</span>
                                        </div>
                                        <div class="icons-share float-right">
                                            <div class="share-button"><small class="custom-btn btn-14">
                                                    مشاركة
                                                </small> <!----></div>
                                        </div>
                                    </div>

                                    <div class="text" style="overflow-y: auto !important;">
                                        <h3 style="color: var(--main-color)"></h3>{!! $blog_details->$description !!}

                                    </div>
                                </div>






                                <div class="row">
                                    <div class="blog-head">
                                        <div class="image2-blog"><img alt="{{$blog_details->$name}}"
                                                                     src="{{$blog_details->image2_path}}"
                                                                     class="lazyLoad isLoaded"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4" style="padding-right: 50px;">
                                <div class="pad-40">
                                    <div class="blog-sidebar">
                                        <div class="all-title">
                                            <h2>مقالات ذات صلة<span class="tit-color">.</span></h2>
                                        </div>

                                        @foreach($related_blogs as $related_blog)
                                        <div class="blog-side">
                                            <a href="{{route('front.blog_details',$related_blog->id)}}" class="">
                                                <div class="media"><img alt="{{$related_blog->$name}}"
                                                                        src="{{$related_blog->image_path}}"
                                                                        class="lazyLoad isLoaded">
                                                    <div class="media-body"><h4>{{$related_blog->$name}}</h4> <span>{{$related_blog->created_at->format('Y-m-d')}}</span></div>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach



{{--                                        <div class="blog-side"><a--}}
{{--                                                href="/blog/astdaf-moakaa-aloyb-aldlyl-alshaml-aan-astdaf-almoakaa-119"--}}
{{--                                                class="">--}}
{{--                                                <div class="media"><img--}}
{{--                                                        alt="استضافة مواقع الويب | الدليل الشامل عن استضافة المواقع"--}}
{{--                                                        src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/ggEiRTCHtEnfrhSVwtabytlo0wQYQDxyeg9d8Xyt.jpg"--}}
{{--                                                        class="lazyLoad isLoaded">--}}
{{--                                                    <div class="media-body"><h4>استضافة مواقع الويب | الدليل الشامل عن--}}
{{--                                                            استضافة المواقع</h4> <span>2022-01-04</span></div>--}}
{{--                                                </div>--}}
{{--                                            </a></div>--}}
{{--                                        <div class="blog-side"><a--}}
{{--                                                href="/blog/alaaalmy-alhr-opro-max-shrak-mtog-balngah-49" class="">--}}
{{--                                                <div class="media"><img--}}
{{--                                                        alt="العالمية الحرة وPro Max شراكة متوجة بالنجاح"--}}
{{--                                                        src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/TIlbfwvFIf6Y52P37lahT2cYiuLJmuZwngV95XiS.jpg"--}}
{{--                                                        class="lazyLoad isLoaded">--}}
{{--                                                    <div class="media-body"><h4>العالمية الحرة وPro Max شراكة متوجة--}}
{{--                                                            بالنجاح</h4> <span>2021-06-07</span></div>--}}
{{--                                                </div>--}}
{{--                                            </a></div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>
                {{--                <div class="cookieControl__BlockedIframe" height="0" width="0" style="display: none; visibility: hidden;"><p>--}}
                {{--                        لرؤية هذا ، يرجى تمكين ملفات تعريف الارتباط الوظيفية--}}
                {{--                        <a href="#">هنا</a></p></div>--}}
            </div>
        </div>
    </section>

@stop

