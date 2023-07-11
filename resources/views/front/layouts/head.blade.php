<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />



    <meta name="google-site-verification" content="19Kfi14EEMfk6neUWxz7RSKvsXnAXQEaBqz5cHrJddc" />
    <meta name="google-site-verification" content="O-IsvjsFUeuJMYfdKVO6FXZj45J7yaGXzNOF9ypXe-k" />

{{--    //connect--}}
    <meta name="google-site-verification" content="qMicb0sCDsx3OuwzR6qh50sNFTBWEKhNiGIKkLIxvmo" />

    <!-- google-site-verification -->
    @yield('meta_description')
    @yield('meta_title')
    @yield('meta_keywords')
    <meta name="msvalidate.01" content="AD410815756F6B5FCF147F390A696886" />
    {{--=======================================================================================--}}

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css"
          integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{asset('Front/assets/css/bootstrap/bootstrap.min.css')}}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="{{asset('Front/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('Front/assets/css/owl.theme.default.css')}}">

    <link rel="icon" href="{{asset('Front/assets/imgs/mini-logo.svg')}}">

    <link rel="stylesheet" href="{{asset('Front/assets/css/splash-animation.min.css')}}">
    <link rel="stylesheet" href="{{asset('Front/assets/css/style.css')}}"/>

    <link href="{{asset('Front/assets/css/lightbox.min.css')}}" rel="stylesheet"/>


{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">--}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

{{--    <link rel="icon" href="{{asset('Front/assets/imgs/mini-logo.svg')}}">--}}


    <title>{{trans('messages.site_name')}}/@yield('title')</title>

    {{--    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">--}}

    {{--    // dropzon --}}

</head>



