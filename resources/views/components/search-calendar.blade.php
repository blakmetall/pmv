@php
    $url = isset($url) ? $url : '';
@endphp
    <form action="{{ $url }}" action="get" class="col-md-12" style="padding: 0">

        <!-- type_id -->
        <div class="col-md-12 select-filter" style="padding: 0; margin-bottom: 30px">
            <label for="type_id">
                Type Event
            </label>
            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="bookings"
                       name="bookings"
                       id="bookings"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-blue"></span> <span style="margin-left: 25px">(2) | Bookings</span>
                </div>

            </label>

            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="transactions"
                       name="transactions"
                       id="transactions"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-green"></span> <span style="margin-left: 25px">(3) | Transactions</span>
                </div>

            </label>

            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="pending_audits"
                       name="pending_audits"
                       id="pending_audits"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-red"></span> <span style="margin-left: 25px">(5) | Pending Audits</span>
                </div>

            </label>

            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="property_management"
                       name="property_management"
                       id="property_management"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-purple"></span> <span style="margin-left: 25px">(10) | Property Management</span>
                </div>

            </label>

            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="cleaning_services"
                       name="cleaning_services"
                       id="cleaning_services"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-yellow"></span> <span style="margin-left: 25px">(4) | Cleaning Services</span>
                </div>

            </label>

            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="rh_entry_date"
                       name="rh_entry_date"
                       id="rh_entry_date"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <span class="filter-type option-gray"></span> <span style="margin-left: 25px">(24) | R.H. Entry Date</span>
                </div>

            </label>
        </div>

        <!-- status -->
        <div class="col-md-12 select-filter" style="padding: 0; margin-bottom: 30px">
            <label for="status">
                Status
            </label>
            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="active"
                       name="status_active"
                       id="active"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <i class='nav-icon i-Yes font-weight-bold text-success'></i> Active/Enabled
                </div>

            </label>
            <label class="checkbox checkbox-primary">

                <input type="checkbox" value="inactive"
                       name="status_active"
                       id="active"
                       checked
                />

                <span class="checkmark app-checkmark"></span>

                <div class="app-form-checkbox-label">
                    <i class='nav-icon i-Close font-weight-bold text-danger'></i> Inactive/Disabled
                </div>

            </label>
        </div>

        <!-- start_date -->
        <div class="col-md-12 select-filter" style="padding: 0; margin-bottom: 10px">
            <label for="start_date">
                Start Date
            </label>
            <input id="start_date" type="date" name="start_date" class="form-control">
        </div>

        <!-- end_date -->
        <div class="col-md-12 select-filter" style="padding: 0; margin-bottom: 10px">
            <label for="end_date">
                End Date
            </label>
            <input id="end_date" type="date" name="end_date" class="form-control">
        </div>

        <button class="btn btn-dark btn-icon mr-2" type="submit">
            Search
            <span class="ul-btn__icon">
                <i class="i-Magnifi-Glass1"></i>
            </span>
        </button>

        @if(isset($_GET['search']))
            <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                Clean
                <span class="ul-btn__icon">
                    <i class="i-Restore-Window"></i>
                </span>
            </a>
        @endif

    </form>
