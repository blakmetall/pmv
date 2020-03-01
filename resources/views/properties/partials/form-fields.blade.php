@foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach

<div class="card">
    <div class="card-body">
        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif 
        
        <div class="row">
            <!-- property name -->
            <div class="col-md-12 form-group mb-3">
                <label for="field_name_{{ $lang }}">
                    {{ __('Property Name') }}
                </label>
                <input 
                    id="field_name_{{ $lang }}"
                    class="form-control" 
                    type="text" 
                    name="name[{{ $lang }}]" 
                    value="{{ old(('property.' . $lang), (isset($property[$lang]) ? $property[$lang]->name : '')) }}"/>
            </div>

            <!-- description -->
            <div class="col-md-12 form-group mb-3">
                <label for="field_description_{{ $lang }}">
                    {{ __('Description') }}
                </label>
                <textarea 
                    id="field_description_{{ $lang }}"
                    class="form-control" 
                    name="description[{{ $lang }}]">{{ 
                        old(('property.' . $lang), (isset($property[$lang]) ? $property[$lang]->description : '')) 
                    }}</textarea>           
            </div>

            <div class="col-md-12 form-group mb-3">
                <label for="field_cancellation_policies_{{ $lang }}">
                    {{ __('Cancellation Policies') }}
                </label>
                <textarea 
                    id="field_cancellation_policies_{{ $lang }}"
                    class="form-control" 
                    name="cancellation_policies[{{ $lang }}]">{{
                        old(('property.' . $lang), (isset($property[$lang]) ? $property[$lang]->cancellation_policies : '')) 
                    }}</textarea>           
            </div>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>