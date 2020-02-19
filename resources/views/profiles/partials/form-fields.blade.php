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
                    value="{{ old(('profile.firstname'), (isset($profile) ? $profile->firstname : '')) }}"
                    name="firstname"
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
                    value="{{ old(('profile.lastname'), (isset($profile) ? $profile->lastname : '')) }}"
                    name="lastname"
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
                    value="{{ old(('profile.country'), (isset($profile) ? $profile->country : '')) }}"
                    name="country"
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
                    value="{{ old(('profile.state'), (isset($profile) ? $profile->state : '')) }}"
                    name="state"
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
                    value="{{ old(('profile.city'), (isset($profile) ? $profile->city : '')) }}"
                    name="city"
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
                    value="{{ old(('profile.street'), (isset($profile) ? $profile->street : '')) }}"
                    name="street"
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
                    value="{{ old(('profile.zip'), (isset($profile) ? $profile->zip : '')) }}"
                    name="zip"
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
                    value="{{ old(('profile.phone'), (isset($profile) ? $profile->phone : '')) }}"
                    name="phone"
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
                    value="{{ old(('profile.mobile'), (isset($profile) ? $profile->mobile : '')) }}"
                    name="mobile"
                    class="form-control" 
                    id="field_mobile"
                />
            </div>
        </div>

        <!-- config lang -->
        <div class="form-group row">
            <label for="field_config_language" class="col-sm-2 col-form-label">
                {{ __('Config Lang') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('profile.config_language'), (isset($profile) ? $profile->config_language : '')) }}"
                    name="config_language"
                    class="form-control" 
                    id="field_config_language"
                />
            </div>
        </div>

        <!-- config agent commission -->
        <div class="form-group row">
            <label for="field_config_agent_commission" class="col-sm-2 col-form-label">
                {{ __('Config Agent Commission') }}
            </label>

            <div class="col-sm-10">
                <input type="text" 
                    value="{{ old(('profile.config_agent_commission'), (isset($profile) ? $profile->config_agent_commission : '')) }}"
                    name="config_agent_commission"
                    class="form-control" 
                    id="field_config_agent_commission"
                />
            </div>
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>