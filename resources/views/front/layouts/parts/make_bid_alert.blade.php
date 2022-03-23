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

{{--@if(session('warning'))--}}
{{--    <div class="alert alert-warning alert-dismissible fade show" role="alert">--}}
{{--        <strong>Warning! </strong>--}}
{{--        {{session('warning')}}--}}
{{--        <br><br><a href="{{route('front.edit_profile')}}" style="color:firebrick ;"> اذهب لرفع صورة جواز السفر--}}
{{--            والوثائق-> </a>--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--@endif--}}

@if(session('warning1'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning! </strong>
        {{session('warning1')}}
        <br><br><a href="{{route('front.my_wallet')}}" style="color:firebrick ;"> اذهب لاضافة رصيد لمحفظتك -> </a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('warning_comp'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Warning! </strong>
        {{session('warning_comp')}}
        <br>
        <br><a href="{{route('front.show_complete_profile')}}" style="color:firebrick ;"> اذهب لتكملة معلومات حسابك الشخصي -> </a>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
