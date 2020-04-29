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
                        <th scope="col">{{ __('Description') }}</th>
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

                                <!-- company -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        {{ $row->property->translate()->name }}
                                    @endif
                                </td>

                                <!-- description -->
                                <td>{{ $row->description }}</td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id, $row->id],
                                        'showRoute' => 'property-notes.show',
                                        'editRoute' => 'property-notes.edit',
                                        'deleteRoute' => 'property-notes.destroy',
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
