<!-- display errors of validation -->

{{--@if ($errors->any()--}}
@if(count($errors)>0)

    <div class="alert alert-danger alert-dismissableth: 350px ;">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <ul>
            @foreach($errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::has('success'))

       <div class="alert alert-success alert-dismissable"  style=" ;">
           <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

           {{Session::get('success')}}
       </div>

@endif
@if(session('error'))

    <div class="alert alert-danger alert-dismissable" style=" ;">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

        {{session('error')}}
    </div>

@endif
@if(session('message'))

    <div class="alert alert-success alert-dismissable" style=" ;">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        {{session('message')}}
    </div>
@endif






