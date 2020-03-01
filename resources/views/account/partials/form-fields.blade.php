<!-- fields form -->
<div class="card">
    <div class="card-body">

        <!-- email -->
        <div class="form-group row">
            <label for="field_email" class="col-sm-2 col-form-label">
                {{ __('Email') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('user.email'), $user->email) }}"
                    name="email"
                    class="form-control" 
                    id="field_email"
                />
            </div>
        </div>

        <!-- password -->
        <div class="form-group row">
            <label for="field_password" class="col-sm-2 col-form-label">
                {{ __('Password') }}
            </label>

            <div class="col-sm-10">
                <input type="password" 
                    value=""
                    name="password"
                    class="form-control" 
                    id="field_password"
                />
            </div>
        </div>

        <!-- confirm password -->
        <div class="form-group row">
            <label for="field_password_confirmation" class="col-sm-2 col-form-label">
                {{ __('Confirm Password') }}
            </label>

            <div class="col-sm-10">
                <input type="password" 
                    value=""
                    name="password_confirmation"
                    class="form-control" 
                    id="field_password_confirmation"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>