<!-- english -->
<div class="card">
    <div class="card-body">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <div class="form-group row">
            <label for="field_role_{{ $lang }}" class="col-sm-2 col-form-label">
                {{ __('Role') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('role.' . $lang), (isset($role[$lang]) ? $role[$lang]->name : '')) }}"
                    name="role[{{ $lang }}]"
                    class="form-control" 
                    id="field_role_{{ $lang }}"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>