@extends('front.layouts.master')
@section('title', trans('messages.login'))
@section('style')
    <style>
        .register {
            text-decoration: underline;
            text-align: center;
            padding-top: 10px;
        }
    </style>
@endsection

@section('content')
    {{--    @include('front.auctions.parts.head')--}}
    <section class="sign-up-page">
        @include('front.layouts.parts.alert')
        <div class="container" dir="{{ direction() }}">
            <h4 class="title"> {{ trans('messages.login') }}</h4>
            <div class="row">
                <form method="POST" action="{{ route('nafath.login') }}">
                    @csrf
                    <div>
                        <label for="nationalId">National ID</label>
                        <input type="text" id="nationalId" name="nationalId" required>
                    </div>
                    <button type="submit">Login with Nafath</button>
                </form>
                {{--<form action="/" class="box validate" id="nafathform"--}}
                      {{--method="post" novalidate="novalidate">--}}
                    {{--<div class="col-md-6">--}}
                        {{--<h3>دخول الأفراد من مواطنين ومقيمين</h3>--}}
                        {{--<fieldset style="height: 720.1px;">--}}
                            {{--<legend>الدخول بإستخدام النفاذ الوطني الموحد</legend>--}}
                            {{--<div class="login-indiv-nafaz">--}}
                                {{--<img src="{{asset('assets/nafaz.png')}}">--}}
                                {{--<p>الدخول عبر</p>--}}
                                {{--<h4>النفاذ الوطني الموحد</h4>--}}
                            {{--</div>--}}
                            {{--<div class="margin-top-15">--}}
                                {{--<div id="dv_Nafath_Message" class="alert alert-danger my-3"--}}
                                     {{--role="alert" style="display: none;">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="loginByNafathDiv" class="text-center" style="">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-md-8 col-md-offset-2">--}}
                                        {{--<input type="text" inputmode="numeric" class="form-control valid"--}}
                                               {{--pattern="\d{10}" maxlength="10" placeholder="رقم الهوية" id="NafathID"--}}
                                               {{--name="NafathID" autofocus="" wfd-id="id0">--}}
                                        {{--<label class="error hidden" id="lblNafathIdRequired">حقل إجباري</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="form-actions d-grid gap-2 text-center">--}}
                                    {{--<button type="button" class="btn btn-green-line" name="button" id="LoginNafath">--}}
                                        {{--تسجيل الدخول--}}
                                        {{--<span id="nafathlogin_loading" class="mx-3 text-light hidden">--}}
                                        {{--<img src="{{asset('assets/loading.svg')}}">--}}
                                    {{--</span>--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="div_ReceivedCode" style="display: none;">--}}
                                {{--<div class="note note-info note-bordered  my-3">--}}
                                    {{--من فضلك قم بفتح تطبيق نفاذ على جوالك واختر الرقم الموضح--}}
                                {{--</div>--}}
                                {{--<label class="label-status-no" id="NumberOne">48</label>--}}
                                {{--<div class="text-center my-3 nafath-count-text hidden" id="dv_waitingStatus">--}}
                                    {{--اختر الرقم الظاهر امامك على الجوال خلال--}}
                                    {{--<div class="countDown-wrapper">--}}
                                        {{--<div class="countDown"></div>--}}
                                    {{--</div>--}}
                                    {{--ثانية--}}
                                {{--</div>--}}
                                {{--<div class="text-center my-3" id="dv_waitingTimeout">--}}
                                    {{--<input class="btn btn-secondary" name="button"--}}
                                           {{--id="ReturnToResignId"--}}
                                           {{--value="قم باعادة تسجيل الدخول مرة اخرى نظرا لانتهاء المهله المخصصة للطلب الحالى"--}}
                                           {{--type="button" wfd-id="id1">--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</fieldset>--}}
                    {{--</div>--}}
                    {{--<input name="__RequestVerificationToken" type="hidden"--}}
                           {{--value="hXEi2zU0EEOKH1mQ1f-qCR47V12E7RPvnLW_bSw9XQ-PgIz6ii7mFoL7Yj4ERvdR2GSe0Wnu9mzHS7KMfcJuLxNt3hj4AwzeAzSKmt4iLc41"--}}
                           {{--wfd-id="id2">--}}
                {{--</form>--}}

                {{--<form action="/Account/LoginIndividuals" class="box validate" id="myform" method="post"--}}
                      {{--novalidate="novalidate">--}}
                    {{--<input id="_TOKEN_KEY_" name="_TOKEN_KEY_" type="hidden"--}}
                           {{--value="MDI0NTc0MTA3MDc1MzQ1Mw==" wfd-id="id3">--}}
                    {{--<input data-val="true"--}}
                           {{--data-val-number="The field Int32 must be a number."--}}
                            {{--data-val-required="The Int32 field is required."--}}
                           {{--id="SecondsCountToEnableAskNewRandom"--}}
                            {{--name="SecondsCountToEnableAskNewRandom"--}}
                           {{--type="hidden" value="60" wfd-id="id4">--}}
                    {{--<input id="SessionId" name="SessionId" type="hidden" value="MDI0NTc0MTA3MDc1MzQ1Mw==" wfd-id="id5">--}}
                    {{--<input id="hdnHayya" name="hayya" type="hidden" value="" wfd-id="id8">--}}

                    {{--<input name="__RequestVerificationToken"--}}
                           {{--type="hidden"--}}
                           {{--value="hXEi2zU0EEOKH1mQ1f-qCR47V12E7RPvnLW_bSw9XQ-PgIz6ii7mFoL7Yj4ERvdR2GSe0Wnu9mzHS7KMfcJuLxNt3hj4AwzeAzSKmt4iLc41"--}}
                           {{--wfd-id="id13"></form>--}}
            </div>

        </div>
    </section>

@stop

@section('js')
    <script>
        let globalIntervalId;
        let counter = document.getElementById("SecondsCountToEnableAskNewRandom").value;


        $(document).ready(function () {
            OnNafathLoginDocumentReady();
        });

        function OnNafathLoginDocumentReady() {
            $("#LoginNafath").click(function () {
                LoginByNafath();
            });

            $("#btnDisplayNafathLogin").click(function () {
                ShowNafathLogin();
            });

            $("#ReturnToResignId").click(function () {
                HideDivReceivedCode();
                ShowLoginByNafathDiv();
                HideNafathErrorMessage();
            });


            $('#NafathID').on('keypress', function (event) {
                if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault();
                    LoginByNafath();
                }
                $("#NafathID").removeClass("error");
                $("#lblNafathIdRequired").addClass("hidden");
            });

        }


        function OnSuccessNafathAjaxPost(response) {


            if (response.RedirectTo) {
                RedirectToClientApplicationFromNafath();
                window.location.href = response.RedirectTo;
            }
            else if (response.ErrorMessage) {
                ShowNafathErrorMessage(response.ErrorMessage);
            }

            if (!response.RedirectTo) {

                OnNafathLoginDocumentReady();
            }

        }

        function RedirectToClientApplicationFromNafath() {
            $("#RedirectToClientApplicationFromNafath").removeClass("hidden");
        }

        function LoginByNafath() {

            HideNafathErrorMessage();
            ShowNafathLoadingIcon();
            var id = document.getElementById("NafathID").value;
            var sessionId = document.getElementById("SessionId").value;

            if (id == null || id == "") {
                ShowRequiredErrorMessage();
                HideNafathLoadingIcon();
                return;
            } else {
                if ($("#NafathID").valid()) {
                    $.ajax({
                        url: `/Account/GetNafathTransactionAndRandomById_Js`,
                        type: "POST",
                        headers: {

                            "Accept-Language": _language
                        },
                        data: {"Id": id, sessionId: sessionId},
                        success: function (response) {
                            if (response.ErrorMessage != null) {
                                ShowNafathErrorMessage(response.ErrorMessage);
                                HideNafathLoadingIcon();
                            }
                            else {
                                HideLoginByNafathDiv();
                                HideNafathLoadingIcon();
                                ShowDivReceivedCode();

                                counter = response.SecondsCountToEnableAskNewRandom;

                                $("#NumberOne").text(response.Random);

                                setTimeout(() => {
                                    CheckUserIsValid();
                                }, 7000);
                            }
                        },
                        error: function (xhr, status, error) {
                            // Handle errors, if any
                            // console.error("Error:", status, error);
                        }
                    });
                } else {
                    $("#LoginNafath").removeAttr("disabled");
                    $("#nafathlogin_loading").addClass("hidden");
                }
            }

        }


        function CheckUserIsValid() {

            HideNafathErrorMessage();

            var id = document.getElementById("NafathID").value;
            var sessionId = document.getElementById("SessionId").value;
            $.ajax({
                url: `/Account/CheckUserIsValid_Js`,
                type: "POST",
                headers: {

                    "Accept-Language": _language
                },
                data: {id: id, sessionId: sessionId},
                success: function (response) {
                    //console.log(response);
                    if (response.ErrorMessage) {
                        ShowNafathErrorMessage(response.ErrorMessage);
                        /*console.error(response.ErrorMessage);*/
                    }
                    else if (response.Status.toLowerCase() == "completed") {
                        RedirectToProfile();
                        //$('#myform').submit();
                    }
                    else if (response.Status.toLowerCase() == "waiting") {
                        setTimeout(() => {
                            CheckUserIsValid()
                        }, "7000");
                    }

                },
                error: function (xhr, Status, error) {

                    //console.error("Error:", Status, error);
                }
            });
        }

        function RedirectToProfile() {
            var url = ROOT + '/Individuals/index';
            //$.ajax({
            //    type: "GET",
            //    url: url,
            //    success: function (data) {
            window.location.href = url;
            //    }
            //});
        }

        function StartCounter() {

            globalIntervalId = setInterval(function () {
                counter--;
                //console.log(counter);
                if (counter === 0) {
                    clearInterval(globalIntervalId);
                    WaitingTimeOut();
                }
            }, 1000);

        }


        function WaitingTimeOut() {
            $("#dv_waitingTimeout").removeClass("hidden");
            $("#dv_waitingStatus").addClass("hidden");
            EnableReturnToResignIdButton();
        }

        function EnableReturnToResignIdButton() {
            $("#ReturnToResignId").removeAttr("disabled");

        }

        function GetExpirationTimeOfCurrentRandom() {
            return $("#ExpirationTimeOfRandom").val();
        }

        function HideLoginByNafathDiv() {
            $("#loginByNafathDiv").hide();

        }

        function ShowLoginByNafathDiv() {
            $("#loginByNafathDiv").show();
        }

        function ShowNafathErrorMessage(msg) {
            //$("#dv_alert_server_side").hide().html('');
            $("#dv_Nafath_Message").removeClass("hidden").fadeIn().html(msg);
        }

        function ShowRequiredErrorMessage() {
            //$("#NafathID").addClass("error");
            $("#lblNafathIdRequired").removeClass("hidden");
            $("#lblNafathIdRequired").css("display", "block");
        }

        function HideNafathErrorMessage() {
            $("#dv_alert_server_side").hide().html('');
            $("#dv_Nafath_Message").hide().html('');
        }


        function ShowNafathLoadingIcon() {
            $("#LoginNafath").attr("disabled", "disabled");
            $("#nafathlogin_loading").removeClass("hidden");
        }

        function HideNafathLoadingIcon() {
            $("#LoginNafath").removeAttr("disabled");
            $("#nafathlogin_loading").addClass("hidden");
        }


        function ShowNafathLogin() {
            $("#formNafathLogin").removeClass("hidden");
            $("#ReturnToResignId").attr("disabled", "disabled");

            HideBtnDisplayNafathLogin();
            ShowDisplayAccountLogin();

            HideUserLogin();
            HideNafathLoadingIcon();
        }

        function HideBtnDisplayNafathLogin() {
            $("#btnDisplayNafathLogin").slideUp();

        }

        function ShowDisplayAccountLogin() {
            $("#btnDisplayAccountLogin").removeClass("hidden");
            $("#btnDisplayAccountLogin").slideDown();
        }

        function HideUserLogin() {

            $("#formUserLogin").slideUp();
        }

        function HideDivReceivedCode() {
            $("#div_ReceivedCode").css("display", "none");

        }

        function ShowDivReceivedCode() {
            $("#div_ReceivedCode").fadeIn("1000");
            StartCounter();
            $("#dv_waitingTimeout").addClass("hidden");
            $("#dv_waitingStatus").removeClass("hidden");
        }
    </script>
@stop
