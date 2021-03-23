<div class="mb-5"></div>


<!-- pagination is loeaded here -->
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
                                'params' => [$row->amenity->id],
                                'showRoute' => 'amenities.show',
                                'editRoute' => 'amenities.edit',
                                'deleteRoute' => 'amenities.destroy',
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
