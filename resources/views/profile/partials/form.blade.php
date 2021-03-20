@include('partials.form-error-alert')


<fieldset>

    <!-- load fields -->
    @include('profile.partials.form-fields', ['row' => $row])

</fieldset>

<div class="card">
    <div class="card-footer bg-transparent">
        <div class="mc-footer">
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn  btn-primary m-1">
                            {{ __('Update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
