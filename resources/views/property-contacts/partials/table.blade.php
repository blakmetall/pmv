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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Mobile') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
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

                                <!-- name -->
                                <td>{{ $row->name }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

                                <!-- mobile -->
                                <td>{{ $row->mobile }}</td>

                                <!-- property -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id, $row->id],
                                        'showRoute' => 'property-contacts.show',
                                        'editRoute' => 'property-contacts.edit',
                                        'deleteRoute' => 'property-contacts.destroy',
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
