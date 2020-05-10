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
                        <th scope="col">{{ __('Date') }}</th>
                        <th scope="col">{{ __('Hour') }}</th>
                        <th scope="col">{{ __('Booking') }}</th>
                        <th scope="col">{{ __('Audited by') }}</th>
                        <th scope="col">{{ __('Finished') }}</th>
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
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- staff -->
                                <td>
                                    @if ($row->cleaningStaff()->count())
                                        @foreach ($row->cleaningStaff as $staff)
                                            <a href="{{ route('cleaning-staff.show', $staff->id) }}">
                                                {{ $staff->full_name }} 
                                            </a>
                                            <br>
                                        @endforeach
                                    @endif
                                </td>

                                <!-- date -->
                                <td>{{ $row->date }}</td>

                                <!-- hours -->
                                <td>{{ $row->hour }}</td>

                                <!-- booking_id -->
                                <td>{{ $row->booking_id }}</td>

                                <!-- audit_user_id -->
                                <td>
                                    
                                    @if($row->audit_user_id)
                                        <a href="{{ route('users.edit', $row->audit_user_id) }}">
                                            {{ $row->auditedBy->profile->firstname }}
                                        </a>
                                    @endif
                                </td>

                                <!-- is_finished -->
                                <td>
                                    {!! getStatusIcon($row->is_finished) !!}
                                </td>
                                
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
