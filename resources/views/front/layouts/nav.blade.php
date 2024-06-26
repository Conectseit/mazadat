<nav class="navbar navbar-expand-lg navbar-light" id="navbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6 nav-col">
                <a class="navbar-brand" href="{{route('front.home')}}">
                    <img src="{{asset('Front/assets/imgs/logo.svg')}}" alt="logo" width="250">
                </a>
            </div>

            <div class="col-lg-3 col-sm-4 col-7 nav-col">
                <div class="time">
                    <h5>توقيت مكة المكرمة</h5>
                    <p class="clock" id="time"></p>
                    <p class="day"><span class="name px-2" id="day_d">الثلاثاء</span><span class="number"
                                                                                           id="day_n">02</span></p>
                    <h3 class="month-year"><span class="month px-2" id="day_m">نوفمبر</span><span class="year" id="year_h"></span>
                    </h3>
                </div>
            </div>

            <button class="navbar-toggler col-4" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="fal fa-bars"></i>
            </button>

            <div class="col-lg-6">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="row">
                        <div class="col-lg-6 nav-col">
                            <div class="site-links">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.about_app')}}">
                                            {{trans('messages.about_app')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.questions')}}">
                                            {{trans('messages.question.questions')}}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.all_companies')}}"><i
                                                class="fal fa-gavel"></i> @lang('messages.company.companies_auctions')
                                        </a>
                                    </li>
                                    @if(auth()->check())
                                        <li class="nav-item">
                                            <a href="#" class="nav-link hvr-shutter-out-horizontal"
                                               data-bs-toggle="modal"
                                               data-bs-target="#contact-modal1">{{trans('messages.contact_us')}}</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal"
                                               href="{{route('front.my_notification')}}">
                                                <i class="fa fa-bell fa-fw"></i>
                                                @if( auth()->user()->notifications->where('is_seen', 0)->count() > 0)
                                                    <span class="text-danger">({{ auth()->user()->notifications->where('is_seen', 0)->count() }})</span>
                                                @endif
                                                {{trans('messages.notification.notifications')}}</a>
                                        </li>

                                    @else
                                        <li class="nav-item">
                                            <a href="#" class="nav-link hvr-shutter-out-horizontal"
                                               data-bs-toggle="modal"
                                               data-bs-target="#contact-modal">@lang('messages.contact_us')</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 nav-col">
                            <div class="user-links">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <div class="nav-link ">
                                            <span class="hvr-shutter-out-horizontal">
                                                    <a href="{{ isLocalized("ar") }}"
                                                       class="arabic {{ app()->isLocale('ar') ? 'active-lang' : '' }}">
                                                        @lang('messages.ar.ar')
                                                    </a>
                                            </span> ||
                                            <span class="hvr-shutter-out-horizontal">
                                                   <a href="{{ isLocalized("en") }}"
                                                      class="arabic {{ app()->isLocale('en') ? 'active-lang' : '' }}">
                                                       @lang('messages.en.en')
                                                   </a>
                                             </span>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link hvr-shutter-out-horizontal"
                                           href="{{route('front.unique_auction')}}" ><b> <i
                                                    class="fal fa-gavel"></i> </b>{{trans('messages.auction.unique')}}</a>
                                    </li>
                                    {{--when authinticate--}}
                                    @if(auth()->check())

                                        @if(auth()->user()->is_verified==1)
                                            <li class="nav-item">
                                                <a class="nav-link hvr-shutter-out-horizontal"
                                                   href="{{route('front.show_add_auction')}}"> <i class="fal fa-plus-circle"> </i> @lang('messages.auction.add')</a>
                                            </li>
                                        @endif

                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal"
                                               href="{{route('front.my_profile')}}"> <i
                                                    class="fa fa-user"></i> {{trans('messages.profile')}}</a>
                                        </li>
                                            <li class="nav-item">
                                                <a class="nav-link hvr-shutter-out-horizontal"
                                                   href="{{route('front.logout')}}">@lang('messages.logout')</a>
                                            </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link hvr-shutter-out-horizontal"
                                               href="{{route('front.show_login')}}">@lang('messages.login')</a>
                                        </li>

                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('front.layouts.parts.modal')
    </div>
</nav>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
    var myVar = setInterval(function () {
        myTimer();
    }, 1000);

    function myTimer() {
        "use strict";
        var time = new Date(),
            show2 = document.getElementById("time"),
            hours = time.getHours(),
            minute = time.getMinutes(),
            second = time.getSeconds();
        if (hours > 12) {
            hours = hours - 12;
            show2.innerHTML = hours + ":" + minute + ":" + second + " " + "PM";
        } else {
            show2.innerHTML = hours + ":" + minute + ":" + second + " " + "AM";
        }
    }

    $(function () {
        var date = new Date();

        var show = document.getElementById("day_d"),

            year_h = document.getElementById("year_h"),
            day_m = document.getElementById("day_m"),

            day = date.getDate(),
            /*because month between 0 to 11 , 0 referring jan, February referring 1 */
            year = date.getFullYear();
        var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var now = new Date();
        var day_m_v = months[now.getMonth()];
        if (day < 10) {
            day = "0" + day;
        }
        if (months < 10) {
            months = "0" + months;
        }
        show.innerHTML = day;
        year_h.innerHTML = year;
        day_m.innerHTML = day_m_v;

        var today = new Date(),
            day = today.getDay(),
            show3 = document.getElementById("day_n"),
            dayList = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        show3.innerHTML = dayList[day];
    });

</script>
@section('script')
    <script>

        $(document).ready(function () {

            function updateFormValidation() {
                var contactNameHasValue    = $('#contact_name').val().trim();
                var contactMobileHasValue  = $('#contact_mobile').val().trim();
                var contactEmailHasValue   = $('#contact_email').val().trim();
                var contactMessageHasValue = $('#contact_message').val().trim();

                if (contactNameHasValue && contactMobileHasValue && contactEmailHasValue &&contactMessageHasValue) {
                    // If any input has a value, remove required and enable properties
                    $('#contact_name, #contact_mobile, #contact_email, #contact_message').prop('required', false);
                    $('#submit_contact_model').prop('disabled', false);
                } else {
                    // If all inputs are empty, set required and disable properties
                    $('#contact_name, #contact_mobile, #contact_email, #contact_message').prop('required', true);
                    $('#submit_contact_model').prop('disabled', true);
                }
            }

            // Bind the function to the shown.bs.modal event of #contact-modal
            $('#contact-modal').on('shown.bs.modal', function () {
                $('#contact_name, #contact_mobile, #contact_email, #contact_message').prop('required', true);
                $('#submit_contact_model').prop('disabled', true);
            });


            // Bind the function to the input event of other input fields
            $(' #contact_name, #contact_mobile, #contact_email, #contact_message').on('input', updateFormValidation);
        });

    </script>
