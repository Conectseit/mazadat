@extends('front.layouts.master')
@section('title', trans('messages.blog.blogs'))
@section('style')
    <style>
        .our-blog .blog {
            position: relative;
            transition: all .5s ease-in-out;
        }

        .blog .blog-img img {
            margin-bottom: 10px;
        }

        .blog .blog-img img {
            width: 100%;
            height: auto;
            border-radius: 10px;
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
            /*color: var(--paragraph);*/
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

                <br>
                <br>
                <br>
                <div class="our-blog pad-40 fadeIn">
                    <div class="container">
                        <div class="row">
                            {{--                            @foreach($blogs as $blog)--}}
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

                                {{--                            @endforeach--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/ashl-7-khtoat-laaml-tsmym-anfografyk-ahtrafy-123"--}}
                                {{--                                                          class="">--}}
                                {{--                                        <div class="blog-img"><img alt="أسهل 7 خطوات لعمل تصميم انفوجرافيك احترافي"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/ZGI0aA7M7HCUxGyvrHq4vlGQMBkZTQzlZKL5Rnpn.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>أسهل 7 خطوات لعمل تصميم انفوجرافيك احترافي</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2022-02-01</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/ttbyk-mnshat-121" class="">--}}
                                {{--                                        <div class="blog-img"><img alt="تطبيق منشآت"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/WVNaiiChA6elBGlN0oGaiACs3C7kSNK03yDngyge.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>تطبيق منشآت</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2022-01-09</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a--}}
                                {{--                                        href="/blog/astdaf-moakaa-aloyb-aldlyl-alshaml-aan-astdaf-almoakaa-119" class="">--}}
                                {{--                                        <div class="blog-img"><img alt="استضافة مواقع الويب | الدليل الشامل عن استضافة المواقع"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/ggEiRTCHtEnfrhSVwtabytlo0wQYQDxyeg9d8Xyt.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>استضافة مواقع الويب | الدليل الشامل عن استضافة المواقع</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2022-01-04</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/afdl-3-fydyohat-tkhlyk-tfhm-tsoyk-sh-117" class="">--}}
                                {{--                                        <div class="blog-img"><img alt="أفضل 3 فيديوهات تخليك تفهم تسويق صح"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/DykwXf5rvtSU4Sow8vCG3SYK9AOXX8C8wm7rduWG.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>أفضل 3 فيديوهات تخليك تفهم تسويق صح</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2021-12-30</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/afdl-khdm-tsmym-mtagr-alktrony-mn-alaaalmy-alhr-115"--}}
                                {{--                                                          class="">--}}
                                {{--                                        <div class="blog-img"><img alt="أفضل خدمة تصميم متاجر الكترونية من العالمية الحرة"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/pTCnRVjBV8ScHamcB8eb6MQesat8uocAqIZ0nkcU.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>أفضل خدمة تصميم متاجر الكترونية من العالمية الحرة</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2021-12-19</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/alaaalmy-alhr-afdl-shrk-tsmym-ttbykat-algoal-113"--}}
                                {{--                                                          class="">--}}
                                {{--                                        <div class="blog-img"><img alt="العالمية الحرة أفضل شركة تصميم تطبيقات الجوال"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/BKkcdEch31R0A74K78T3wwrOiEJBzGCXVXw0Hy7y.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>العالمية الحرة أفضل شركة تصميم تطبيقات الجوال</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2022-01-18</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/ttbyk-amn-111" class="">--}}
                                {{--                                        <div class="blog-img"><img alt="تطبيق آمنة"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/A99ZDq1D8mke6BK2n1jvwo7o6XyQxTcRM9aJchth.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>تطبيق آمنة</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2021-12-14</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="col-lg-4">--}}
                                {{--                                <div class="blog mb-4"><a href="/blog/braingate-altknologya-altby-althory-109" class="">--}}
                                {{--                                        <div class="blog-img"><img alt="BrainGate التكنولوجيا الطبية الثورية"--}}
                                {{--                                                                   src="https://alalmyia.t-demo.alalmiyalhura.com/storage/images/blog/peEKEDCXT8o8EiDt3I3gL3XfHXDq4wpHkTDhPG6d.jpg"--}}
                                {{--                                                                   class="lazyLoad isLoaded"></div>--}}
                                {{--                                        <div class="blog-des"><h4>BrainGate التكنولوجيا الطبية الثورية</h4>--}}
                                {{--                                            <p class="first-p"></p> <span>2021-11-24</span></div>--}}
                                {{--                                    </a></div>--}}
                                {{--                            </div>--}}


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

