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
                    id="field_email"
                    value="{{ old(('user.email'), (isset($user) ? $user->email : '')) }}"
                    name="email"
                    class="form-control" 
                />
            </div>
        </div>

        <!-- password -->
        <div class="form-group row">
            <label for="field_password" class="col-sm-2 col-form-label">
                {{ __('Password') }}
            </label>

            <div class="col-sm-10">
                <input 
                    id="field_password"
                    type="password" 
                    value=""
                    name="password"
                    class="form-control" 
                />
            </div>
        </div>

        <!-- confirm password -->
        <div class="form-group row">
            <label for="field_password_confirmation" class="col-sm-2 col-form-label">
                {{ __('Confirm Password') }}
            </label>

            <div class="col-sm-10">
                <input 
                    id="field_password_confirmation"
                    type="password" 
                    value=""
                    name="password_confirmation"
                    class="form-control" 
                />
            </div>
        </div>

        <!-- enabled -->
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="switch switch-success mr-3">
                    <span>{{ __('Is Enabled?') }}</span>

                    <input 
                        type="checkbox"
                        name="is_enabled"
                        {{ ($user->is_enabled) ? 'checked' : '' }}/>
                    <span class="slider"></span>
                </label>
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>