<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{ __('Company') }}</th>
                <th scope="col">{{ __('Contact') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col">{{ __('Mobile') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('City') }}</th>
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

                        <!-- city -->
                        <td>
                            <b class="text-primary">{{ $row->city->name }}</b>
                        </td>

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
