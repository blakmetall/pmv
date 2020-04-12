<div class="card">
    <div class="card-body">       

        <!-- state_id -->
        <div class="form-group row">   
            <label for="field_state_id" class="col-sm-2 col-form-label">
                {{ __('State') }}
            </label>
            <div class="col-sm-10">
                <select name="state_id" class="form-control">
                    <option value="">{{ __('Select') }}</option>

                    @foreach($states as $state)
                        @php 
                            $selected = (old('state_id', $city->state_id) == $state->id) ? 'selected' : '';
                        @endphp
                        <option value=" {{ $state->id }}" {{ $selected }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('state_id'))
                    <div class="app-form-input-error">
                        {{ $errors->first('state_id') }}
                    </div>
                @endif
            </div>
        </div>

         <!-- name --> 
        <div class="form-group row">
            <label for="field_name" class="col-sm-2 col-form-label">
                {{ __('City') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old('name', $city->name) }}"
                    name="name"
                    class="form-control" 
                    id="field_name"
                />

                @if ($errors->has('name'))
                    <div class="app-form-input-error">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>