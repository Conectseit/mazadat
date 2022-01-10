@extends('front.layouts.master')
@section('title', trans('messages..my_watched_auctions'))
@section('style')
    <style></style>
@endsection

@section('content')
    <section class="watching-page">
        <div class="container">
            <div class="watching-card">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card list-card" id="itemCard">
                            <a href="ad-details.html" class="image">
                                <div class="overlay"></div>
                                <img src="assets/imgs/car-img.jpg" alt="card-img">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">عنوان المزاد</h5>
                                <p class="start-date info-item">
                                    <i class="fal fa-calendar-alt"></i>
                                    يبدأ فى الثلاثاء , 16/11/2021 , 10:10
                                </p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><i class="fal fa-ticket"></i>121</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><i class="fal fa-tag"></i>33.600</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p><i class="fal fa-gavel"></i>1000.000 $</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p><i class="fal fa-clock"></i>3m : 50s</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="buttons">
                            <a href="ad-details.html" class="bid">المزايدة الان</a>
                            <a href="#" class="remove">ازالة</a>
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
