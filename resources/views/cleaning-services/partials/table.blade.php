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
                        <th scope="col">{{ __('Maid Fee') }}</th>

                        @if(!isProduction())
                            <th scope="col">{{ __('Booking') }}</th>
                        @endif

                        <th scope="col">{{ __('Audited By') }}</th>
                        <th scope="col">{{ __('Finished') }}</th>
                        <th scope="col">&nbsp;</th>
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
                                            {{ $staff->full_name }} <br>
                                        @endforeach
                                    @endif
                                </td>

                                <!-- date -->
                                <td>{{ $row->date }}</td>

                                <!-- total_cost -->
                                <td>${{ number_format($row->total_cost, 2) }}</td>

                                @if(!isProduction())
                                    <!-- booking_id -->
                                    <td>{{ $row->booking_id }}</td>
                                @endif

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
                                        'skipEdit' => isRole('owner'),
                                        'skipDelete' => isRole('owner'),
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
