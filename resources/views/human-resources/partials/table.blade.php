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
                        <th scope="col">{{ __('City') }}</th>
                        <th scope="col">{{ __('Firstname') }}</th>
                        <th scope="col">{{ __('Lastname') }}</th>
                        <th scope="col">{{ __('Department') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
                        <th scope="col">{{ __('Birthday') }}</th>
                        <th scope="col">{{ __('Vacations Start At') }}</th>
                        <th scope="col">{{ __('Vacations End At') }}</th>
                        <th scope="col">{{ __('Days Vacation') }}</th>
                        <th scope="col">{{ __('Children') }}</th>
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

                                <!-- city_id -->
                                <td>{{ $row->city->name }}</td>

                                <!-- firstname -->
                                <td>{{ $row->firstname }}</td>

                                <!-- lastname -->
                                <td>{{ $row->lastname }}</td>

                                <!-- department -->
                                <td>{{ $row->department }}</td>

                                <!-- entry_at -->
                                <td>{{ $row->entry_at }}</td>

                                <!-- birthday -->
                                <td>{{ $row->birthday }}</td>

                                <!-- vacations_start_at -->
                                <td>{{ $row->vacations_start_at }}</td>

                                <!-- vacations_end_at -->
                                <td>{{ $row->vacations_end_at }}</td>

                                <!-- days_vacations -->
                                <td>{{ $row->days_vacations }}</td>

                                <!-- children -->
                                <td>{{ $row->children }}</td>

                                <!-- is_active -->
                                <td>
                                    {!! getStatusIcon($row->is_active) !!}
                                </td>
                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'human-resources.show',
                                        'editRoute' => 'human-resources.edit',
                                        'deleteRoute' => 'human-resources.destroy',
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
