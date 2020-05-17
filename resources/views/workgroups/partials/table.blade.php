<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <!-- pagination is loaded here -->
        @include('partials.pagination', ['rows' => $rows])

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('City') }}</th>
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
                            <td>{{ $row->city->name }}</td>

                            <!-- actions -->
                            <td>
                                @include('components.table.actions', [
                                    'params' => [$row->id],
                                    'showRoute' => 'workgroups.show',
                                    'editRoute' => 'workgroups.edit',
                                    'deleteRoute' => 'workgroups.destroy',
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

    </div>
</div>
