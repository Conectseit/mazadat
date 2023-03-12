{{--@component('mail::message')--}}
{{--Mazadat--}}
{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}
{{--<p> كود التفعيل{{$code}}</p>--}}
{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}






@component('mail::message')
    {{ config('app.name') }}
    # Hi Dear welcome from MAZADAT website

    Your Activation Code is: {{$code}}

    Thanks,
    {{ config('app.name') }}
@endcomponent
