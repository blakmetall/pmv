<div class="card">
    <div class="card-body">        
        <div class="form-group row">
            <label for="field_city" class="col-sm-2 col-form-label">
                {{ __('City') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('city'), (isset($city) ? $city->name : '')) }}"
                    name="city"
                    class="form-control" 
                    id="field_city"
                />
            </div>
        </div>

        <div class="form-group row">   
            <label for="city_zone" class="col-sm-2 col-form-label">
                {{ __('State') }}
            </label>
            <div class="col-sm-10">
                <select name="state_id" class="form-control">
                    @foreach($states as $state)
                        <option value=" {{ $state->id }}" {{ (($city->state_id == $state->id) ? 'selected' : '' ) }}>{{ $state->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>