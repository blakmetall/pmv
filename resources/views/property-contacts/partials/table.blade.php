<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ __('Owner') }}</div>
    <div class="card-body pt-5">
        <div class="table-responsive">
            <table class="table table-striped app-transaction-list-pending">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Mobile') }}</th>
                        <th scope="col">{{ __('Emergency Phone') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
                    </tr>

                </thead>
                <tbody>
                    @if($owner)
                        <tr>
                            <!-- full_name -->
                            <td>{{ $owner->profile->full_name }}</td>

                            <!-- email -->
                            <td>{{ $owner->email }}</td>

                            <!-- phone -->
                            <td>{{ $owner->profile->phone }}</td>

                            <!-- mobile -->
                            <td>{{ $owner->profile->mobile }}</td>

                            <!-- mobile -->
                            <td>{{ $owner->profile->emergency_phone }}</td>

                            <!-- address -->
                            <td>{{ $owner->profile->street }}, {{ $owner->profile->zip }}, {{ $owner->profile->city }}, {{ $owner->profile->state }}, {{ $owner->profile->country }}</td>

                            <!-- is_active -->
                            <td>
                                {!! getStatusIcon($owner->is_enabled) !!}
                            </td>

                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Mobile') }}</th>
                        <th scope="col">{{ __('Emergency Phone') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        <th scope="col">{{ __('Contact Type') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
                    </tr>

                </thead>
                <tbody>
                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- full_name -->
                                <td>{{ $row->profile->full_name }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- phone -->
                                <td>{{ $row->profile->phone }}</td>

                                <!-- mobile -->
                                <td>{{ $row->profile->mobile }}</td>

                                <!-- mobile -->
                                <td>{{ $row->profile->emergency_phone }}</td>

                                <!-- address -->
                                <td>{{ $row->profile->street }}, {{ $row->profile->zip }}, {{ $row->profile->city }}, {{ $row->profile->state }}, {{ $row->profile->country }}</td>

                                <!-- contact_type -->
                                <td>{{ getContactTypeBySlug($row->profile->contact_type) }}</td>

                                <!-- is_enabled -->
                                <td>
                                    {!! getStatusIcon($row->is_enabled) !!}
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</div>
