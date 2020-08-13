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
                        <th scope="col">{{ __('Owner') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
                    </tr>

                </thead>
                <tbody>
                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- full_name -->
                                <td>{{ $row->full_name }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

                                <!-- mobile -->
                                <td>{{ $row->mobile }}</td>

                                <!-- mobile -->
                                <td>{{ $row->emergency_phone }}</td>

                                <!-- address -->
                                <td>{{ $row->address }}</td>

                                <!-- contact_type -->
                                <td>{{ getContactTypeBySlug($row->contact_type) }}</td>

                                <!-- owner -->
                                <td>
                                    @if($row->owner)
                                        {{ $row->owner->profile->full_name }}
                                    @endif
                                </td>

                                <!-- is_active -->
                                <td>
                                    {!! getStatusIcon($row->is_active) !!}
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</div>
