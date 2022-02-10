@extends('front.layouts.master')
@section('title', trans('messages.register'))
@section('style')
    <style> #map {
            height: 400px;
        } </style>
@endsection

@section('content')
    @include('front.auctions.head')
    <section class="">
        <div class="container">
            <h3 class="title">اهلا بك في موقع مزادات ....</h3>

            <div class="row" style="padding-top: 20px;">
                <div class="col-lg-12">
                        <form action="{{route('front.show_register_person')}}" method="get">
                            @csrf
                            <button
                                class="submit-btn btn btn-primary submit-btn save-btn"> {{trans('messages.register_person')}}</button>
                        </form>
                    </div>
                <div class="row" style="padding-top: 20px;">
                    <div class="col-lg-12">
                            <form action="{{route('front.show_register_company')}}" method="get">
                                @csrf
                                <input type="hidden" name="fcm_web_token" value="">
                                <button
                                    class="submit-btn btn btn-primary submit-btn save-btn"> {{trans('messages.register_company')}}</button>
                            </form>
                    </div>
                </div>
                </div>

            </div>
            <h5 class="title">الدخول كزائر</h5>

        </div>
    </section>

@stop

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        messaging.getToken()--}}
{{--            .then(currentToken => {--}}
{{--                if (currentToken){--}}
{{--                    $('input[name=fcm_web_token]').val(currentToken);--}}
{{--                } else {--}}
{{--                    console.log('No Instance ID token available. Request permission to generate one.');--}}
{{--                }--}}
{{--            })--}}
{{--            .catch(err => console.log('An error occurred while retrieving token. ', err));--}}
{{--    </script>--}}
{{--@endpush--}}




{{--<div ng-model="alert" id="alert0" auto-close="alert.autoClose" name="" class="ng-valid">--}}
{{--    <div ng-show="alert.type === 'danger'" class="alert alert-danger" role="alert">--}}
{{--        <!-- ngIf: alert.closeable --><button id="btnClose_danger_alert0" type="button" class="close" ng-if="alert.closeable" ng-click="runClose()" aria-label="Close">--}}
{{--            <span aria-hidden="true">×</span>--}}
{{--        </button><!-- end ngIf: alert.closeable -->--}}
{{--        <!-- ngIf: hasToggleHandler -->--}}
{{--        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>--}}
{{--        <div class="alert-message">--}}
{{--            <strong class="alert-title" ng-show="errorLabel">Error:</strong>--}}
{{--            <span class="alert-body"><!-- ngIf: alert && alert.message --><span id="txtMessage_danger_alert0" ng-bind-html="alert.message" ng-if="alert &amp;&amp; alert.message">The connection to the server ended in failure at 3:17:01 PM. (ABORTED)</span><!-- end ngIf: alert && alert.message --></span>--}}
{{--            <!-- ngIf: alert.list && alert.list.length -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div ng-show="alert.type === 'info'" class="alert alert-info ng-hide" role="alert">--}}
{{--        <!-- ngIf: alert.closeable --><button id="btnClose_info_alert0" type="button" class="close" ng-if="alert.closeable" ng-click="runClose()" aria-label="Close">--}}
{{--            <span aria-hidden="true">×</span>--}}
{{--        </button><!-- end ngIf: alert.closeable -->--}}
{{--        <!-- ngIf: hasToggleHandler -->--}}
{{--        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>--}}
{{--        <div class="alert-message">--}}
{{--            <strong class="alert-title" ng-show="infoLabel">Information:</strong>--}}
{{--            <span class="alert-body"><!-- ngIf: alert && alert.message --><span id="txtMessage_info_alert0" ng-bind-html="alert.message" ng-if="alert &amp;&amp; alert.message">The connection to the server ended in failure at 3:17:01 PM. (ABORTED)</span><!-- end ngIf: alert && alert.message --></span>--}}
{{--            <!-- ngIf: alert.list && alert.list.length -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div ng-show="alert.type === 'success'" class="alert alert-success ng-hide" role="alert">--}}
{{--        <!-- ngIf: alert.closeable --><button id="btnClose_success_alert0" type="button" class="close" ng-if="alert.closeable" ng-click="runClose()" aria-label="Close">--}}
{{--            <span aria-hidden="true">×</span>--}}
{{--        </button><!-- end ngIf: alert.closeable -->--}}
{{--        <!-- ngIf: hasToggleHandler -->--}}
{{--        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>--}}
{{--        <div class="alert-message">--}}
{{--            <strong class="alert-title" ng-show="successLabel">Success:</strong>--}}
{{--            <span class="alert-body"><!-- ngIf: alert && alert.message --><span id="txtMessage_success_alert0" ng-bind-html="alert.message" ng-if="alert &amp;&amp; alert.message">The connection to the server ended in failure at 3:17:01 PM. (ABORTED)</span><!-- end ngIf: alert && alert.message --></span>--}}
{{--            <!-- ngIf: alert.list && alert.list.length -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div ng-show="alert.type === 'warning'" class="alert alert-warning ng-hide" role="alert">--}}
{{--        <!-- ngIf: alert.closeable --><button id="btnClose_warning_alert0" type="button" class="close" ng-if="alert.closeable" ng-click="runClose()" aria-label="Close">--}}
{{--            <span aria-hidden="true">×</span>--}}
{{--        </button><!-- end ngIf: alert.closeable -->--}}
{{--        <!-- ngIf: hasToggleHandler -->--}}
{{--        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>--}}
{{--        <div class="alert-message">--}}
{{--            <strong class="alert-title" ng-show="warnLabel">Warning:</strong>--}}
{{--            <span class="alert-body"><!-- ngIf: alert && alert.message --><span id="txtMessage_warning_alert0" ng-bind-html="alert.message" ng-if="alert &amp;&amp; alert.message">The connection to the server ended in failure at 3:17:01 PM. (ABORTED)</span><!-- end ngIf: alert && alert.message --></span>--}}
{{--            <!-- ngIf: alert.list && alert.list.length -->--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
