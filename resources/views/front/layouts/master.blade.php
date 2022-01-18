<!doctype html>
<html lang="ar" dir="rtl">
@include('front.layouts.head')
@yield('style')
@include('front.layouts.nav')
@include('front.layouts.nav_categories')

@include('front.layouts.splash')

<body>
<!--==========================================================================-->
@yield('content')
<!--==========================================================================-->

@include('front.layouts.footer')
@include('front.layouts.script')
@stack('scripts')
</body>
</html>
