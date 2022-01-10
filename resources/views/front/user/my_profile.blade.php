@extends('front.layouts.master')
@section('title', trans('messages.my_profile'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="my-profile-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="slogan-right">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="image">
                                    <img src="assets/imgs/user-img.jpg" alt="my-image">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="info">
                                    <h4 class="name">User Name</h4>
                                    <h5 class="email">username@mail.com</h5>
                                    <p>
                                        سيت يتبيرسبايكياتيس يوندي أومنيس أستي ناتيس أيررور سيت فوليبتاتيم أكيسأنتييوم
                                        دولاريمكيو لايودانتيوم,توتام ريم أبيرأم,أيكيو أبسا كيواي أب أللو أنفينتوري
                                        فيرأتاتيس ايت
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="slogan-left">
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="edit-profile.html">تعديل الحساب</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="my-bids.html">مزاداتي</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="watching.html">مشاهدة</a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">المحفظة</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@push('scripts')
    <script>

    </script>
@endpush
