@extends('front.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('style')
    <style>
        .our-blog .blog {
            position: relative;
            transition: all .5s ease-in-out;
            width: 280px;
        }

        .blog .blog-img img {
            margin-bottom: 10px;
        }

        .blog .blog-img img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .our-blog .blog .blog-des {
            padding-top: 7px;
        }

        .our-blog .blog .blog-des h4 {
            font-size: 15px;
            color: #2a398c;
            /*color: var(--main-color);*/
            font-family: "Mon-bold";

            margin-bottom: 10px;
            line-height: 28px;
        }

        .our-blog .blog .blog-des span {
            font-size: 15px;
            color: #8f98c5;
        }
        .our-blog .blog:hover {
            transform: scale(.85);
            transition: .5s;
        }
    </style>


@stop
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')

    <section class="notifications-page" dir="{{ direction() }}"  data-aos="fade-up">
        <div class="container">
            <div class="blog-page">
                <br>
                <br>
                <br>
                <div class="our-blog pad-40 fadeIn">
                    <div class="container">
                        <div class="row">
                            @forelse($blogs as $blog)

                                <div class="col-lg-4">
                                    <div class="blog mb-4"><a href="{{route('front.blog_details',$blog->id)}}"
                                                              class="">
                                            <div class="blog-img"><img alt="{{$blog->$name}}"
                                                                       src="{{$blog->image_path}}" class="lazyLoad isLoaded"></div>
                                            <div class="blog-des"><h4>{{$blog->$name}}</h4>
                                                <p class="first-p"></p>
                                                <span>{{$blog->created_at->format('Y-m-d')}}</span></div>
                                        </a></div>
                                </div>
                            @empty
                                <div style="text-align: center;">
                                    <h2> @lang('messages.there_is_no_blogs_yet') </h2></div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

