@component('mail::message')
Mazadat
{{--@component('mail::button', ['url' => ''])--}}
{{--Button Text--}}
{{--@endcomponent--}}
<p> كود التاكيد{{$code}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
