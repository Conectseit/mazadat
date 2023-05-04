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
                            <input type="text" class="form-control"  name="full_name" dir="{{ direction() }}"
                                   placeholder="{{trans('messages.enter_full_name')}}">
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
                    <div class="form-group">
                        <div class="col-lg-12 col-md-12">
                            <input type="text" name="mobile" value="{{ old('mobile') }}"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   placeholder="{{trans('messages.enter_mobile')}} 966  xxxx xxx xx ">
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


<!-- upload-file-modal -->
<div class="modal user-modal bio-modal fade" id="upload-file-modal" tabindex="-1"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true" dir="{{ direction() }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" >
                <form action="{{route('front.addFile')}}" method="post" enctype="multipart/form-data">
                    @csrf

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="auction_id" value="{{$auction->id}}">

                    <div class="form-group ">
                        <div class="col-lg-12 col-md-12">
                            <select name="file_name_id" class="form-select  form-control">
                                <option selected
                                        disabled>{{trans('messages.select_file_name')}}</option>
                                @foreach ($inspection_file_names as $inspection_file_name)
                                    <option
                                        value="{{ $inspection_file_name->id }}"> {{ $inspection_file_name->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <input type="file"  class="form-control" name="inspection_report_images">
                        </div>
                        @error('inspection_report_images')<span
                            style="color: #e81414;">{{ $message }}</span>@enderror
                    </div>
                    <br>

                    <div class="form-group ">
                        <div class="col-lg-12 col-md-12">
                            <textarea  cols="60" name="description" placeholder="{{trans('messages.enter_message')}} "required>
                            </textarea>
                            @error('description')<span
                                style="color: #e81414;">{{ $message }}</span>@enderror
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
<!-- upload-file-modal -->
