<form action="{{ $url }}" action="get">

    <div class="row row-xs">
        <!-- from_date -->
        <div class="col-md-3 select-filter">
            <label for="from_date">
                {{ __('From Date') }}*
            </label>
            <input id="from_date" type="date" name="from_date" value="{{ $fromDate }}" class="form-control" required>
        </div>

        <!-- to_date -->
        <div class="col-md-3 select-filter">
            <label for="to_date">
                {{ __('To Date') }}*
            </label>
            <input id="to_date" type="date" name="to_date" value="{{ $toDate }}" class="form-control" required>
        </div>

        <!-- location -->
        <div class="col-md-2 select-filter">
            <label for="location">
                {{ __('Location') }}*
            </label>

            <select name="location" class="form-control" required>
                <option value="">{{ __('Select') }}</option>
                @if ($locations)
                    @foreach ($locations as $location)
                        @php
                            $selected = $searchedLocation == $location->id ? 'selected' : '';
                        @endphp

                        <option value="{{ $location->id }}" {{ $selected }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        @if(isRole('owner'))
            @if(isset($propertiesSearch))
                <div class="col-md-2 select-filter">
                    <label for="reservation_id">
                        {{ __('Property') }}
                    </label>

                    <!-- property_id -->
                    @include('components.form.select', [
                        'group' => 'booking-search',
                        'label' => '',
                        'name' => 'property_id',
                        'value' => isset($_GET['property_id']) ? $_GET['property_id'] : '',
                        'options' => $propertiesSearch,
                        'optionValueRef' => 'property_id',
                        'optionLabelRef' => 'name',
                        'hideLabel' => true,
                    ])
                </div>
            @endif
        @endif
        <div class="col-md-2 app-search-buttons">
            <div style="display: block; margin-bottom: 7px">
                &nbsp;
            </div>

            <button class="btn btn-dark btn-icon mr-2" type="submit">
                <span class="ul-btn__icon">
                    <i class="i-Magnifi-Glass1"></i>
                </span>
            </button>

            @if (isset($_GET['location']))
                <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                    <span class="ul-btn__icon">
                        <i class="i-Restore-Window"></i>
                    </span>
                </a>
            @endif
        </div>
    </div>

</form>
       