@include('partials.form-error-alert')


<!-- load fields -->
@include('account.partials.form-fields', ['row' => $row])


<!-- form actions -->
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