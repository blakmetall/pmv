<!-- load city fields -->
@include('cities.partials.form-fields', [
    'row' => $row
])

<!-- load states fields -->
@include('cities.partials.form-fields-states', [
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
                        @if( ! $row )
                            {{ __('Create') }}
                        @else
                            {{ __('Update') }}
                        @endif
                    </button>

                    <a href="{{ route('cities') }}" class="btn btn-outline-secondary m-1" role="button">
                        {{  __('Cancel') }}
                    </a>

                    <!-- if editing might be a chance to delete -->
                    @if( $row )
                        <button type="button" class="btn  btn-danger m-1 footer-delete-right">
                            {{ __('Delete') }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>