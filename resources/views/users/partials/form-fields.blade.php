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
        <div class="card-body">
            <label class="switch pr-5 switch-primary mr-3">
                <span>{{ __('Enabled') }}</span>

                @php $checked = $user->is_enabled ? 'checked="checked"' : ''; @endphp
                <input  type="checkbox" {{ $checked }}  name="is_enabled" />
                <span class="slider"></span>
            </label>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>

<!-- fields form -->
<div class="card">
    <div class="card-body">
        <!-- first name -->
        <div class="form-group row">
            <label for="field_firstname" class="col-sm-2 col-form-label">
                {{ __('First Name') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.firstname'), $user->profile['firstname']) }}"
                       name="profile[firstname]"
                       class="form-control"
                       id="field_firstname"
                />
            </div>
        </div>

        <!-- last name -->
        <div class="form-group row">
            <label for="field_lastname" class="col-sm-2 col-form-label">
                {{ __('Last Name') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.lastname'), $user->profile['lastname']) }}"
                       name="profile[lastname]"
                       class="form-control"
                       id="field_lastname"
                />
            </div>
        </div>

        <!-- country -->
        <div class="form-group row">
            <label for="field_country" class="col-sm-2 col-form-label">
                {{ __('Country') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.country'), $user->profile['country']) }}"
                       name="profile[country]"
                       class="form-control"
                       id="field_country"
                />
            </div>
        </div>

        <!-- state -->
        <div class="form-group row">
            <label for="field_state" class="col-sm-2 col-form-label">
                {{ __('State') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.state'), $user->profile['state']) }}"
                       name="profile[state]"
                       class="form-control"
                       id="field_state"
                />
            </div>
        </div>

        <!-- city -->
        <div class="form-group row">
            <label for="field_city" class="col-sm-2 col-form-label">
                {{ __('City') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.city'), $user->profile['city']) }}"
                       name="profile[city]"
                       class="form-control"
                       id="field_city"
                />
            </div>
        </div>

        <!-- street -->
        <div class="form-group row">
            <label for="field_street" class="col-sm-2 col-form-label">
                {{ __('Street') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.street'), $user->profile['street']) }}"
                       name="profile[street]"
                       class="form-control"
                       id="field_street"
                />
            </div>
        </div>

        <!-- zip -->
        <div class="form-group row">
            <label for="field_zip" class="col-sm-2 col-form-label">
                {{ __('ZIP') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.zip'), $user->profile['zip']) }}"
                       name="profile[zip]"
                       class="form-control"
                       id="field_zip"
                />
            </div>
        </div>

        <!-- phone -->
        <div class="form-group row">
            <label for="field_phone" class="col-sm-2 col-form-label">
                {{ __('Phone') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.phone'), $user->profile['phone']) }}"
                       name="profile[phone]"
                       class="form-control"
                       id="field_phone"
                />
            </div>
        </div>

        <!-- mobile -->
        <div class="form-group row">
            <label for="field_mobile" class="col-sm-2 col-form-label">
                {{ __('Mobile') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.mobile'), $user->profile['mobile']) }}"
                       name="profile[mobile]"
                       class="form-control"
                       id="field_mobile"
                />
            </div>
        </div>

        <!-- config lang -->
        <div class="form-group row">
            <label for="field_config_language" class="col-sm-2 col-form-label">
                {{ __('Language') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value=""
                       name="profile[config_language]"
                       class="form-control"
                       id="field_config_language"
                />
            </div>
        </div>

        <!-- config agent commission -->
        <div class="form-group row">
            <label for="field_config_agent_commission" class="col-sm-2 col-form-label">
                {{ __('Agent Commission') }}
            </label>

            <div class="col-sm-10">
                <input type="text"
                       value="{{ old(('profile.config_agent_commission'), $user->profile['config_agent_commission']) }}"
                       name="profile[config_agent_commission]"
                       class="form-control"
                       id="field_config_agent_commission"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
