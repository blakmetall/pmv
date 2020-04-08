<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- city -->
        <div class="form-group row">
            <label for="field_city" class="col-sm-2 col-form-label">
                {{ __('City') }}
            </label>

            <div class="col-sm-10">
                <select id="field_city" name="city_id" class="form-control">
                    <option value="">{{ __('Select City') }}</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}" @if(old('contractor.city_id', $contractor->city_id) == $city->id)
                        selected
                        @endif
                        >{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- company -->
        <div class="form-group row">
            <label for="field_company" class="col-sm-2 col-form-label">
                {{ __('Company') }}
            </label>

            <div class="col-sm-10">
                <input type="text" id="field_company" value="{{ old('contractor.company', $contractor->company) }}" name="company" class="form-control" />
            </div>
        </div>

        <!-- contact_name -->
        <div class="form-group row">
            <label for="field_contact_name" class="col-sm-2 col-form-label">
                {{ __('Contact Name') }}
            </label>

            <div class="col-sm-10">
                <input type="text" id="field_contact_name" value="{{ old('contractor.contact_name', $contractor->contact_name) }}" name="contact_name" class="form-control" />
            </div>
        </div>

        <!-- phone -->
        <div class="form-group row">
            <label for="field_phone" class="col-sm-2 col-form-label">
                {{ __('Phone') }}
            </label>

            <div class="col-sm-10">
                <input type="text" id="field_phone" value="{{ old('contractor.phone', $contractor->phone) }}" name="phone" class="form-control" />
            </div>
        </div>

        <!-- mobile -->
        <div class="form-group row">
            <label for="field_mobile" class="col-sm-2 col-form-label">
                {{ __('Mobile') }}
            </label>

            <div class="col-sm-10">
                <input type="text" id="field_mobile" value="{{ old('contractor.mobile', $contractor->mobile) }}" name="mobile" class="form-control" />
            </div>
        </div>

        <!-- email -->
        <div class="form-group row">
            <label for="field_email" class="col-sm-2 col-form-label">
                {{ __('Email') }}
            </label>

            <div class="col-sm-10">
                <input type="text" id="field_email" value="{{ old('contractor.email', $contractor->email) }}" name="email" class="form-control" />
            </div>
        </div>

        <!-- address -->
        <div class="form-group row">
            <label for="field_address" class="col-sm-2 col-form-label">
                {{ __('Address') }}
            </label>

            <div class="col-sm-10">
                <textarea id="field_address" cols="30" rows="10" name="address" class="form-control">
                {{ old('contractor.address', $contractor->address) }}
                </textarea>
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
