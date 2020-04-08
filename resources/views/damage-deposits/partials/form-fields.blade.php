<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <div class="form-group row">
            <label for="field_damage_deposit_description_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Description') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(($lang . 'description'), $damage_deposit->{$lang}->description) }}"
                    name="{{ $lang }}[description]"
                    class="form-control" 
                    id="field_damage_deposit_description_{{ $lang }}"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
