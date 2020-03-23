<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
    
        <div class="form-group row">
            <label for="field_damage_deposit_price" class="col-sm-2 col-form-label">
                {{ __('Price') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('price'), $damage_deposit->price) }}"
                    name="price"
                    class="form-control" 
                    id="field_damage_deposit_price"
                />
            </div>
        </div>
        
        <div class="form-group row">
            <label class="switch pr-5 switch-primary mr-3">
                <span>{{ __('Enabled') }}</span>

                @php $checked = ($damage_deposit->is_refundable)  ? 'checked="checked"' : ''; @endphp
                <input  type="checkbox" {{ $checked }} name="is_refundable" id="field_damage_deposit_is_refundable"/>
                <span class="slider"></span>
            </label>
        </div>
        


    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
