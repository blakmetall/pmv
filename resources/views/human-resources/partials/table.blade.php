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
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('Firstname') }}</th>
                        <th scope="col">{{ __('Lastname') }}</th>
                        <th scope="col">{{ __('City') }}</th>
                        <th scope="col">{{ __('Department') }}</th>
                        <th scope="col">{{ __('Birthday') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Vacations') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $i => $row)
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $i+1 }}
                                </th>
                                
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- firstname -->
                                <td>{{ $row->firstname }}</td>

                                <!-- lastname -->
                                <td>{{ $row->lastname }}</td>

                                <!-- city_id -->
                                <td>{{ $row->city->name }}</td>

                                <!-- department -->
                                <td>{{ $row->department }}</td>

                                <!-- birthday -->
                                <td>{{ $row->birthday }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

                                <!-- vacations -->
                                <td>
                                    @if( $row->vacation_start_date && $row->vacation_end_date )
                                        {{ $row->vacation_start_date }}
                                        -
                                        {{ $row->vacation_end_date }}
                                        ({{ $row->vacation_days }})
                                    @endif 
                                </td>

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
