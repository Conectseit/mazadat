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
        <label for="district_ar" class="form-label">{{trans('messages.product.district_ar')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="district_ar" name="district_ar"
               class="form-control   @error('district_ar') is-invalid @enderror"
               value="{{ old('district_ar') }}"
               placeholder="{{trans('messages.product.enter_district_ar')}}">
        @error('district_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="district_en" class="form-label">{{trans('messages.product.district_en')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="district_en" name="district_en"
               class="form-control   @error('district_en') is-invalid @enderror"
               value="{{ old('district_en') }}"
               placeholder="{{trans('messages.product.enter_district_en')}}">
        @error('district_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="street_ar" class="form-label">{{trans('messages.product.street_ar')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="street_ar" name="street_ar"
               class="form-control   @error('street_ar') is-invalid @enderror"
               value="{{ old('street_ar') }}"
               placeholder="{{trans('messages.product.enter_street_ar')}}">
        @error('street_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="street_en" class="form-label">{{trans('messages.product.street_en')}}</label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="street_en" name="street_en"
               class="form-control   @error('street_en') is-invalid @enderror"
               value="{{ old('street_en') }}"
               placeholder="{{trans('messages.product.enter_street_en')}}">
        @error('street_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_facade_ar"
               class="form-label">{{trans('messages.product.property_facade_ar')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_facade_ar" name="property_facade_ar"
               class="form-control   @error('property_facade_ar') is-invalid @enderror"
               value="{{ old('property_facade_ar') }}"
               placeholder="{{trans('messages.product.enter_property_facade_ar')}}">
        @error('property_facade_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_facade_en"
               class="form-label">{{trans('messages.product.property_facade_en')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_facade_en" name="property_facade_en"
               class="form-control   @error('property_facade_en') is-invalid @enderror"
               value="{{ old('property_facade_en') }}"
               placeholder="{{trans('messages.product.enter_property_facade_en')}}">
        @error('property_facade_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>

<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="space"
               class="form-label">{{trans('messages.product.space')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="space" name="space"
               class="form-control   @error('space') is-invalid @enderror"
               value="{{ old('space') }}"
               placeholder="{{trans('messages.product.enter_space')}}">
        @error('space')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="purpose" class="form-label">
            {{ trans('messages.product.purpose') }}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <select class="form-select form-control" name="purpose" class="select" required>
            <option selected disabled>{{trans('messages.select')}}</option>

            <optgroup label="{{ trans('messages.product.purpose') }}">

                <option value="residential">
                    {{trans('messages.product.residential')}}
                </option>
                <option value="commercial">
                    {{trans('messages.product.commercial') }}
                </option>

            </optgroup>
        </select>
        @error('purpose')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>


<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="price_per_meter_of_land"
               class="form-label">{{trans('messages.product.price_per_meter_of_land')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="price_per_meter_of_land" name="price_per_meter_of_land"
               class="form-control   @error('price_per_meter_of_land') is-invalid @enderror"
               value="{{ old('price_per_meter_of_land') }}"
               placeholder="{{trans('messages.product.enter_price_per_meter_of_land')}}">
        @error('price_per_meter_of_land')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="unit_price"
               class="form-label">{{trans('messages.product.unit_price')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="unit_price" name="unit_price"
               class="form-control   @error('unit_price') is-invalid @enderror"
               value="{{ old('unit_price') }}"
               placeholder="{{trans('messages.product.enter_unit_price')}}">
        @error('unit_price')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_type_ar"
               class="form-label">{{trans('messages.product.property_type_ar')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_type_ar" name="property_type_ar"
               class="form-control   @error('property_type_ar') is-invalid @enderror"
               value="{{ old('property_type_ar') }}"
               placeholder="{{trans('messages.product.enter_villa_apartment_land_ar')}}">
        @error('property_type_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="property_type_en"
               class="form-label">{{trans('messages.product.property_type_en')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="property_type_en" name="property_type_en"
               class="form-control   @error('property_type_en') is-invalid @enderror"
               value="{{ old('property_type_en') }}"
               placeholder="{{trans('messages.product.enter_villa_apartment_land_en')}}">
        @error('property_type_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="age_of_the_property"
               class="form-label">{{trans('messages.product.age_of_the_property')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="number" id="age_of_the_property" name="age_of_the_property"
               class="form-control   @error('age_of_the_property') is-invalid @enderror"
               value="{{ old('age_of_the_property') }}"
               placeholder="{{trans('messages.product.enter_age_of_the_property')}}">
        @error('age_of_the_property')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="services_related_ar"
               class="form-label">{{trans('messages.product.services_related_to_the_property_ar')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="services_related_ar" name="services_related_ar"
               class="form-control   @error('services_related_ar') is-invalid @enderror"
               value="{{ old('services_related_ar') }}"
               placeholder="{{trans('messages.product.enter_services_related_to_the_property_ar')}}">
        @error('services_related_ar')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="services_related_en"
               class="form-label">{{trans('messages.product.services_related_to_the_property_en')}}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <input type="text" id="services_related_en" name="services_related_en"
               class="form-control   @error('services_related_en') is-invalid @enderror"
               value="{{ old('services_related_en') }}"
               placeholder="{{trans('messages.product.enter_services_related_to_the_property_en')}}">
        @error('services_related_en')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
<div class="form-group mb-4 row">
    <div class="col-lg-2 col-md-3 d-flex align-items-center">
        <label for="purpose_of_the_advertisement" class="form-label">
            {{ trans('messages.product.purpose_of_the_advertisement') }}
        </label>
    </div>
    <div class="col-lg-10 col-md-9">
        <select class="form-select form-control" name="purpose_of_the_advertisement" class="select" required>
            <option selected disabled>{{trans('messages.select')}}</option>

            <optgroup label="{{ trans('messages.product.purpose_of_the_advertisement') }}">

                <option value="sale">
                    {{trans('messages.product.sale')}}
                </option>
                <option value="rent">
                    {{trans('messages.product.rent') }}
                </option>

            </optgroup>
        </select>
        @error('purpose_of_the_advertisement')<span style="color: #e81414;">{{ $message }}</span>@enderror
    </div>
</div>
