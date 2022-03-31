<!-- contact-modal -->
<div class="modal user-modal bio-modal fade" id="contact-modal" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true" dir="{{ direction() }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
            <form action="{{route('front.contact_us')}}" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group mb-4 row">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" class="form-control"  name="user_name" dir="{{ direction() }}"
                                   placeholder="{{trans('messages.enter_user_name')}}">
                        </div>
                    </div>
                    <div class="form-group mb-4 row">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" class="form-control"  name="mobile"
                                   placeholder="{{trans('messages.enter_mobile')}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="{{trans('messages.enter_email')}}">
                            @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div><br>
                    {{--                            <div class="form-group mb-4 row">--}}
                    {{--                                <div class="col-lg-10 col-md-9">--}}
                    {{--                                    <input type="email" class="form-control"  name="email"--}}
                    {{--                                           placeholder="{{trans('messages.enter_email')}}">--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    <div class="form-group ">
                        <div class="col-lg-12 col-md-12">
                            <textarea  cols="50" name="message" placeholder="{{trans('messages.enter_message')}} ">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add">{{trans('messages.send')}}</button>
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">{{trans('messages.cancel')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- contact-modal -->



<!-- contact-modal -->
<div class="modal user-modal bio-modal fade" id="contact-modal1" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true" dir="{{ direction() }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('front.auth_contact')}}" method="post">
                @csrf
                <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">{{trans('messages.enter_message')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group ">
                        <p></p>
                        <div class="col-lg-12 col-md-12">
                              <textarea  cols="50" name="message" placeholder="{{trans('messages.enter_message')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add">{{trans('messages.send')}}</button>
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">{{trans('messages.cancel')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- contact-modal -->



<!-- forget_pass-modal -->
<div class="modal user-modal bio-modal fade" id="forget_pass_modal" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true" dir="{{ direction() }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{route('front.forget_pass')}}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('messages.reset_password')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

{{--                    <div class="form-group">--}}
{{--                        <div class="col-lg-12 col-md-12">--}}
{{--                            <input type="text" name="email" value="{{ old('email') }}"--}}
{{--                                   class="form-control @error('email') is-invalid @enderror"--}}
{{--                                   placeholder="{{trans('messages.enter_email')}}">--}}
{{--                            @error('email') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   placeholder="{{trans('messages.enter_mobile')}} 966 xx xxx">
                            @error('mobile') <span class="invalid-feedback"><strong>{{ $message }}</strong></span> @enderror
                        </div>
                    </div>

                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add">{{trans('messages.send')}}</button>
                    <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">{{trans('messages.cancel')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- forget_pass-modal -->
