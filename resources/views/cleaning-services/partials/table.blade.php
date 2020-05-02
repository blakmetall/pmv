<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Staff') }}</th>
                        <th scope="col">{{ __('Booking') }}</th>
                        <th scope="col">{{ __('Date') }}</th>
                        <th scope="col">{{ __('Hour') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Maid Fee') }}</th>
                        <th scope="col">{{ __('Audit Date') }}</th>
                        <th scope="col">{{ __('Auditor') }}</th>
                        <th scope="col">{{ __('Notes') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Actions') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- property_id -->
                                <td>{{ $row->property_id }}</td>

                                <!-- cleaning_staff_id -->
                                <td>{{ $row->cleaning_staff_id }}</td>

                                <!-- booking_id -->
                                <td>{{ $row->booking_id }}</td>

                                <!-- date -->
                                <td>{{ $row->date }}</td>

                                <!-- hours -->
                                <td>{{ $row->hour }}</td>

                                <!-- description -->
                                <td>{{ $row->description }}</td>

                                <!-- maid_fee -->
                                <td>{{ $row->maid_fee }}</td>

                                <!-- audit_datetime -->
                                <td>{{ $row->audit_datetime }}</td>

                                <!-- audit_user_id -->
                                <td><a href="{{ route('users.edit', $row->audit_user_id) }}">{{ $row->auditedBy->profile->firstname }}</a></td>

                                <!-- notes -->
                                <td>{{ $row->notes }}</td>

                                <!-- is_finished -->
                                <th scope="row">
                                    @php
                                        $enabledClass = ($row->is_finished) ? 'success' : 'danger';
                                        $enabledLabel = ($row->is_finished) ? __('Finished') : __('Not Finished');
                                    @endphp

                                    <span class="badge badge-{{ $enabledClass }} p-1">
                                        {{ $enabledLabel }}
                                    </span>
                                </th>
                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'cleaning-services.show',
                                        'editRoute' => 'cleaning-services.edit',
                                        'deleteRoute' => 'cleaning-services.destroy',
                                    ])
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
