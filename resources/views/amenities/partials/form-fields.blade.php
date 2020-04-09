<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <!-- name -->
        <div class="form-group row">
            <label for="field_amenity_name_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Name') }}
                <span>*</span>
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(($lang . '.name'), $amenity->{$lang}->name) }}"
                    name="{{ $lang }}[name]"
                    class="form-control" 
                    id="field_amenity_name_{{ $lang }}"
                />

                @if ($errors->has($lang . '.name'))
                    <div class="app-form-input-error">
                        {{ $errors->first($lang . '.name') }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>