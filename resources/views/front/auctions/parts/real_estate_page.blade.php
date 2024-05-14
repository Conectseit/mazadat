<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="city_id" class="form-label">
            @lang('messages.city.city')
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <select class="form-select form-control" name="city_id" class="select">
            <option selected disabled>{{trans('messages.select')}}</option>
            <optgroup label="{{ trans('messages.city.city') }}">
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->$name}}</option>
                @endforeach
            </optgroup>
        </select>
        @error('city_id')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="district" class="form-label">{{trans('messages.auction.district')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="district" name="district"
               class="form-control   @error('district') is-invalid @enderror"
               value="{{ old('district') }}"
               placeholder="{{trans('messages.auction.enter_district')}}">
        @error('district')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="street" class="form-label">{{trans('messages.auction.street')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="street" name="street"
               class="form-control   @error('street') is-invalid @enderror"
               value="{{ old('street') }}"
               placeholder="{{trans('messages.auction.enter_street')}}">
        @error('street')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_facade"
               class="form-label">{{trans('messages.auction.property_facade')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_facade" name="property_facade"
               class="form-control   @error('property_facade') is-invalid @enderror"
               value="{{ old('property_facade') }}"
               placeholder="{{trans('messages.auction.enter_property_facade')}}">
        @error('property_facade')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="space"
               class="form-label">{{trans('messages.auction.space')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="space" name="space"
               class="form-control   @error('space') is-invalid @enderror"
               value="{{ old('space') }}"
               placeholder="{{trans('messages.auction.enter_space')}}">
        @error('space')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="purpose" class="form-label">
            {{ trans('messages.auction.purpose') }}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <select class="form-select form-control" name="purpose" class="select" required>
            <option selected disabled>{{trans('messages.select')}}</option>

            <optgroup label="{{ trans('messages.auction.purpose') }}">

                <option value="residential">
                    {{trans('messages.auction.residential')}}
                </option>
                <option value="commercial">
                    {{trans('messages.auction.commercial') }}
                </option>

            </optgroup>
        </select>
        @error('purpose')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>


<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="price_per_meter_of_land"
               class="form-label">{{trans('messages.auction.price_per_meter_of_land')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="price_per_meter_of_land" name="price_per_meter_of_land"
               class="form-control   @error('price_per_meter_of_land') is-invalid @enderror"
               value="{{ old('price_per_meter_of_land') }}"
               placeholder="{{trans('messages.auction.enter_price_per_meter_of_land')}}">
        @error('price_per_meter_of_land')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="unit_price"
               class="form-label">{{trans('messages.auction.unit_price')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="unit_price" name="unit_price"
               class="form-control   @error('unit_price') is-invalid @enderror"
               value="{{ old('unit_price') }}"
               placeholder="{{trans('messages.auction.enter_unit_price')}}">
        @error('unit_price')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_type"
               class="form-label">{{trans('messages.auction.property_type')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_type" name="property_type"
               class="form-control   @error('property_type') is-invalid @enderror"
               value="{{ old('property_type') }}"
               placeholder="{{trans('messages.auction.enter_villa_apartment_land')}}">
        @error('property_type')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="age_of_the_property"
               class="form-label">{{trans('messages.auction.age_of_the_property')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="age_of_the_property" name="age_of_the_property"
               class="form-control   @error('age_of_the_property') is-invalid @enderror"
               value="{{ old('age_of_the_property') }}"
               placeholder="{{trans('messages.auction.enter_age_of_the_property')}}">
        @error('age_of_the_property')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="services_related"
               class="form-label">{{trans('messages.auction.services_related_to_the_property')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="services_related" name="services_related"
               class="form-control   @error('services_related') is-invalid @enderror"
               value="{{ old('services_related') }}"
               placeholder="{{trans('messages.auction.enter_services_related_to_the_property')}}">
        @error('services_related')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="purpose_of_the_advertisement" class="form-label">
            {{ trans('messages.auction.purpose_of_the_advertisement') }}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <select class="form-select form-control" name="purpose_of_the_advertisement" class="select" required>
            <option selected disabled>{{trans('messages.select')}}</option>

            <optgroup label="{{ trans('messages.auction.purpose_of_the_advertisement') }}">

                <option value="sale">
                    {{trans('messages.auction.sale')}}
                </option>
                <option value="rent">
                    {{trans('messages.auction.rent') }}
                </option>

            </optgroup>
        </select>
        @error('purpose_of_the_advertisement')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
