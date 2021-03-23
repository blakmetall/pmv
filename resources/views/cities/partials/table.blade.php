<div class="mb-5"></div>

<!-- pagination is loaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

        <tr>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">&nbsp;</th>
        </tr>

        </thead>
        <tbody>

        @if(count($rows))
            @foreach($rows as $row)
                <tr>

                    <!-- name -->
                    <td>{{ $row->name }}</td>

                    <!-- actions -->
                    <td>
                        @include('components.table.actions', [
                            'params' => [$row->id],
                            'showRoute' => 'cities.show',
                            'editRoute' => 'cities.edit',
                            'deleteRoute' => 'cities.destroy',
                        ])
                    </td>

                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
</div>

<!-- pagination is loaded here -->
@include('partials.pagination', ['rows' => $rows])
