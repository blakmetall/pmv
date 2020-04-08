<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <div class="form-group row">
            <label for="field_amenity_name_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Name') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(($lang . 'name'), $cleaning_option->{$lang}->name) }}"
                    name="{{ $lang }}[name]"
                    class="form-control" 
                    id="field_amenity_name_{{ $lang }}"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>