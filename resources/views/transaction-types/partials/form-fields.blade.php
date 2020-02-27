<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <div class="form-group row">
            <label for="field_transaction_type_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Transaction Type') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('$transaction-type.' . $lang), (isset($transaction_type[$lang]) ? $transaction_type[$lang]->name : '')) }}"
                    name="name[{{ $lang }}]"
                    class="form-control" 
                    id="field_transaction_type_{{ $lang }}"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>