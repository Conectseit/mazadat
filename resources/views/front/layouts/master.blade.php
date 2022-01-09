<!doctype html>
<html lang="ar" dir="rtl">
@include('front.layouts.head')
@include('front.layouts.nav')
@include('front.layouts.splash')

<body>
<!--==========================================================================-->
@yield('content')

@include('front.layouts.footer')
@include('front.layouts.script')
</body>
</html>
