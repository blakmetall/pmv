<!-- english -->
<div class="card">
    <div class="card-body">
       

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        <div class="row">
            <div class="col-md-12 form-group mb-3">
                <label for="firstName1">{{ __('Property Name') }}</label>
                <input class="form-control"  type="text" placeholder="Property Name" name="name[{{ $lang }}]" />
            </div>

            <div class="col-md-12 form-group mb-3">
                <label for="firstName1">{{ __('Description') }}</label>
                <textarea class="form-control" aria-label="With textarea" placeholder="Property Description" name="description[{{ $lang }}]"></textarea>           
            </div>
            <div class="col-md-12 form-group mb-3">
                <label for="firstName1">{{ __('Cancellation Policies') }}</label>
                <textarea class="form-control" aria-label="With textarea" placeholder="Cancellation Policies" name="cancellation_policies[{{ $lang }}]"></textarea>           
            </div>
        </div>
        

        

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>