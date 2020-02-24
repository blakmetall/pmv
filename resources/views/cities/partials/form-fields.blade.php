<div class="card">
    <div class="card-body">
       
        <div class="form-group row">
            <label for="field_city" class="col-sm-2 col-form-label">
                {{ __('City') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('city'), (isset($city) ? $city : '')) }}"
                    name="city"
                    class="form-control" 
                    id="field_city"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>