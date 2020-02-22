<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 

        {{ $zone[$lang] }}

        
        <div class="form-group row">
            <label for="field_zone_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Zone') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('zone.' . $lang), (isset($zone[$lang]) ? $zone[$lang]->translations->name : '')) }}"
                    name="zone[{{ $lang }}]"
                    class="form-control" 
                    id="field_zone_{{ $lang }}"
                />
            </div>
                 
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>