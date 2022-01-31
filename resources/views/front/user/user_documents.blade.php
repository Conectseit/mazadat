@extends('front.layouts.master')
@section('title', trans('messages.user_documents'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="my-wallet-page">
        <div class="container">
            <nav class="breadcrumb-nav" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('front.my_profile')}}">حسابى</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{trans('messages.user_documents')}}</li>
                </ol>
            </nav>
        </div>
        @include('front.layouts.parts.alert')

        <div class="container">
            <div class="bank-form">
                <form action="{{route('front.upload_documents')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h5 class="title">قم برفع  وثائق رسمية الخاص بك</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="upload-images">
                                <div class="receipt-img" id="myImg"  name="front_side_image">
                                </div>
                                <div class="text">
                                    <p>رفع صورة</p>
                                    <input type="file" id="myImgUploader"  name="front_side_image">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <i class="fal fa-calendar"></i>
                                <input type="text" class="form-control" placeholder="select passport_expiry_date" id="datepicker"
                                       name="expiry_date" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="number" class="form-control" placeholder="id" name="Id_type" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="text" class="form-control" placeholder="document_name" name="document_name" required>
                            </div>
                            <button type="submit" class="submit-btn">ارسال </button>
                        </div>
                    </div>
                </form>
            </div>
            <hr>
        </div>
    </section>
@stop

@push('scripts')
    <script>

    </script>
@endpush
