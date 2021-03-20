<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    // custom validation messages
    'is_even_string' => "The :attribute must be odd string lenght.",


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'address' => __('Address'),
        'amount' => __('Amount'),
        'base_price' => __('Price'),
        'baths' => __('Baths'),
        'bedrooms' => __('Bedrooms'),
        'birthday' => __('Birthday'),
        'children' => __('Children'),
        'cleaning_option_id' => __('Cleaning Option'),
        'city' => __('City'),
        'city_id' => __('City'),
        'company' => __('Company'),
        'config_agent_commission' => __('Agent Commission'),
        'contact_name' => __('Contact'),
        'contact_type' => __('Contact Type'),
        'contractor_id' => __('Contractor'),
        'country' => __('Country'),
        'date' => __('Date'),
        'description' => __('Description'),
        'vacation_days' => __('Vacation Days'),
        'email' => __('Email'),
        'emergency_phone' => __('Emergency Phone'),
        'end_date' => __('End Date'),
        'entry_at' => __('Entry Date'),
        'en.cancellation_policies' => __('Cancellation Policies'),
        'en.description' => __('Description'),
        'en.name' => __('Name'),
        'es.cancellation_policies' => __('Cancellation Policies'),
        'es.description' => __('Description'),
        'es.name' => __('Name'),
        'firstname' => __('Firstname'),
        'hour' => __('Hour'),
        'lastname' => __('Lastname'),
        'maid_fee' => __('Maid Fee'),
        'management_fee' => __('Fee'),
        'min_stay' => __('Min Stay'),
        'mobile' => __('Mobile'),
        'monthly' => __('Monthly'),
        'name' => __('Name'),
        'nightly' => __('Nightly'),
        'phone' => __('Phone'),
        'period_start_date' => __('Period Start Date'),
        'period_end_date' => __('Period End Date'),
        'post_date' => __('Post Date'),
        'profile.city' => __('City'),
        'profile.config_agent_commission' => __('Agent Commission'),
        'profile.country' => __('Country'),
        'profile.emergency_phone' => __('Emergency Phone'),
        'profile.firstname' => __('Firstname'),
        'profile.mobile' => __('Mobile'),
        'profile.lastname' => __('Lastname'),
        'profile.phone' => __('Phone'),
        'profile.state' => __('State'),
        'profile.street' => __('Street'),
        'profile.zip' => __('Zip'),
        'property_id' => __('Property'),
        'property_type_id' => __('Property Type'),
        'rental_commission' => __('Rental Commission'),
        'roles_ids' => __('Roles'),
        'start_date' => __('Start Date'),
        'state' => __('State'),
        'state_id' => __('State'),
        'street' => __('Street'),
        'transaction_type_id' => __('Transaction Type'),
        'user_id' => __('User'),
        'vacation_start_date' => __('Vacation Start Date'),
        'vacation_end_date' => __('Vacation End Date'),
        'zip' => __('Zip'),
        'zone_id' => __('Zone'),
        'weekly' => __('Weekly'),
    ],

];
