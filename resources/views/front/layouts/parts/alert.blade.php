
{{--@if ($errors->has('g-recaptcha-response'))--}}
{{--    <span class="help-block">--}}
{{--        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
{{--    </span>--}}
{{--@endif--}}


@if(count($errors)>0)

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong>
        @foreach($errors->all() as $error)
            <li> {{$error}} </li>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong>
        {{session('error')}}

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

@endif


@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong>
        {{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif













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
