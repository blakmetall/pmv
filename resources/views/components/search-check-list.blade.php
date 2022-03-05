<form action="{{ $url }}" action="get">

    <div class="row row-xs">
        <!-- id -->
        <div class="col-md-1 select-filter">
            <label for="property_id">
                {{ __('ID') }}
            </label>
            <input id="property_id" type="text" name="property_id" value="{{ $propertyId }}" class="form-control">
        </div>

        <!-- from_date -->
        <div class="col-md-2 select-filter">
            <label for="from_date">
                {{ __('From Date') }}
            </label>
            <input id="from_date" type="date" name="from_date" value="{{ $fromDate }}"
                class="form-control">
        </div>

        <!-- register by -->
        <div class="col-md-2 select-filter">
            <label for="register_by">
                {{ __('Register By') }}
            </label>
            <input id="register_by" type="text" name="register_by" value="{{ $registerBy }}" class="form-control">
        </div>
        <div class="col-md-2 app-search-buttons">
            <div style="display: block; margin-bottom: 7px">
                &nbsp;
            </div>
            <button class="btn btn-dark btn-icon mr-2" type="submit">
                <span class="ul-btn__icon">
                    <i class="i-Magnifi-Glass1"></i>
                </span>
            </button>
            @if (isset($_GET['property_id']))
                <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                    <span class="ul-btn__icon">
                        <i class="i-Restore-Window"></i>
                    </span>
                </a>
            @endif
        </div>
    </div>

</form>
