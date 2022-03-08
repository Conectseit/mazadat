<div class="row">
    <div class=" d-flex justify-content-between">
        <div  class="add-auction btn "><b> <i
                    class="fal fa-plus-circle"></i> </b>{{ trans('messages.additional_address') }}</div>
    </div>


    <div class="row">
        <div class="edit-form">
            <form action="{{route('front.add_address')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="inputs-group">
                        <div class="form-group mb-4 row">
                            <div class="col-lg-2 col-md-3 d-flex align-items-center">
                                <label for="name" class="form-label">{{trans('messages.location')}}</label>
                            </div>
                            <div class="col-lg-10 col-md-9">
                                <div id="map"></div>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="lat" name="latitude" readonly="" value="{{ isset(auth()->user()->latitude)?auth()->user()->latitude:'' }}"
                                       placeholder=" latitude" class="form-control hidden d-none">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" id="lng" name="longitude" readonly="" value=" {{ isset(auth()->user()->longitude)?auth()->user()->longitude:'' }}"
                                       placeholder="longitude" class="form-control hidden d-none">
                            </div><br>

{{--                            <div class="col-lg-6">--}}
{{--                                <input type="text" id="lat" name="person_latitude" readonly=""--}}
{{--                                       placeholder=" latitude" class="form-control hidden d-none">--}}
{{--                            </div>--}}
{{--                            <div class="col-lg-6">--}}
{{--                                <input type="text" id="lng" name="person_longitude" readonly=""--}}
{{--                                       placeholder="longitude" class="form-control hidden d-none">--}}
{{--                            </div><br>--}}

                        </div><br>

                    <button type="submit" class="btn btn-primary submit-btn">اضافة</button>
                </div>
            </form>
        </div>
    </div>
</div>
