<!-- load fields -->
@include('profile.partials.form-fields', ['row' => $row])


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

                    <a href="#" class="btn btn-outline-secondary m-1" role="button">
                        {{  __('Cancel') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>