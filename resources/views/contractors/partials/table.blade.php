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
                        <th scope="col">{{ __('Company') }}</th>
                        <th scope="col">{{ __('Contact') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Mobile') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
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

                                <!-- city -->
                                <td>
                                    {{ $row->city->name }}
                                </td>

                                <!-- company -->
                                <td>{{ $row->company }}</td>

                                <!-- contact_name -->
                                <td>{{ $row->contact_name }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

                                <!-- mobile -->
                                <td>{{ $row->mobile }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'contractors.show',
                                        'editRoute' => 'contractors.edit',
                                        'deleteRoute' => 'contractors.destroy',
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
