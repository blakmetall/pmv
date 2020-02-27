<!-- load english fields -->
@include('properties.partials.form-fields', [
    'label' => __('ENGLISH'),
    'lang' => 'en',
    'row' => $row
])

<!-- load spanish fields -->
@include('properties.partials.form-fields', [
    'label' => __('SPANISH'),
    'lang' => 'es',
    'row' => $row
])

<!-- load spanish fields -->
@include('properties.partials.form-fields-property', [
    'label' => __('PROPERTY DETAILS'),
    'lang' => 'es',
    'row' => $row
])


<!-- form actions -->
<div class="card">
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12">

                    <!-- create button -->
                    <button type="submit" class="btn  btn-primary m-1">
                        @if( ! $row->id )
                            {{ __('Create') }}
                        @else
                            {{ __('Update') }}
                        @endif
                    </button>

                    <a href="{{ route('properties') }}" class="btn btn-outline-secondary m-1" role="button">
                        {{  __('Cancel') }}
                    </a>

                    <!-- if editing might be a chance to delete -->
                    @if( $row->id )
                        <button type="button" class="btn  btn-danger m-1 footer-delete-right">
                            {{ __('Delete') }}
                        </button>
                    @endif

                    
                </div>
            </div>
        </div>
    </div>
</div>