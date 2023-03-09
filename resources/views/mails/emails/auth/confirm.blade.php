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

    <p>Your Activation_code is: {{$code}}</p>

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
