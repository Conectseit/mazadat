
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
        <strong>Sorry! </strong>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sorry! </strong>
        {{session('message')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
