@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style>
        .upload-btn {
            text-align: center;
            border: 1px solid #fff;
            padding: 15px;
            color: #1e3c48;
            font-size: 15px;
            background: #d1915c;
        }
    </style>
@endsection
@section('content')
    <main class="categories-bar row">
        @include('front.layouts.parts.nav_categories')
    </main>
    @include('front.layouts.parts.alert')
    <section class="my-profile-page"  dir="{{ direction() }}">
        <div class="container">
            @if(auth()->user()->is_completed==0)
                Not verified account   <h3> {{ trans('messages.please_complete_your_data')}}  </h3>
            @endif
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="slogan-right">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img src="{{auth()->user()->image_path }}" alt="my-image">
                                </div>

                                <div class="upload-btn" >
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit-photo-modal">
                                        {{__(trans('messages.update_personal_image'))}}
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info">
                                    <h4 class="name">{{isset(auth()->user()->full_name)?auth()->user()->full_name :auth()->user()->user_name }}</h4>
                                    <h5 class="email">{{Auth::guard('web')->user()->email}} </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slogan-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="{{route('front.edit_profile')}}"> {{ trans('messages.user.update_profile')}} </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.show_my_addresses')}}">{{ trans('messages.user.addresses')}}</a>
                            </div>
{{--                            <div class="col-sm-6">--}}
{{--                                <a href="{{route('front.show_complete_profile')}}">{{ trans('messages.user.complete_data')}}</a>--}}
{{--                            </div>--}}
                            <div class="col-sm-6">
                                <a href="{{route('front.my_bids')}}"> {{ trans('messages.user.bids')}}</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_watched')}}"> {{ trans('messages.user.watched_auctions')}}</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{route('front.my_wallet')}}">{{ trans('messages.user.wallet')}}</a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{route('front.my_auctions')}}"> {{ trans('messages.user.my_auctions')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit-photo-modal -->
            <div class="modal user-modal edit-profile-modal fade" id="edit-photo-modal" tabindex="-1"
                 aria-labelledby="exampleModalLabel" aria-hidden="true"  dir="{{ direction() }}">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <form action="{{route('front.update_personal_image')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="modal-header" >
                                <h5 class="modal-title" id="exampleModalLabel">{{__(trans('messages.update_personal_image'))}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="upload-images">
                                    <div class="upload-input user-img" id="myImg">
                                        <input type="file" id="myImgUploader" name="image">
                                        <div class="text" id="uploadText"  name="image">
                                            <p id="uploadText">قم بسحب وافلات الصورة هنا او اضغط للتصفح</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary add">{{trans('messages.add')}}</button>
                                <button type="button" class="btn btn-secondary cancel" data-bs-dismiss="modal">{{trans('messages.cancel')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@stop


