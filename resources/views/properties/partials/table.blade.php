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
                        <th scope="col">{{ __('Bedrooms') }}</th>
                        <th scope="col">{{ __('Baths') }}</th>
                        <th scope="col">{{ __('Enabled') }}</th>
                        <th scope="col">{{ __('Online') }}</th>
                        <th scope="col">{{ __('Owner') }}</th>
                        <th scope="col">{{ __('Property Management') }}</th>
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

                                <td>
                                    {{ $row->name }}
                                </td>

                                <td>
                                    {{ $row->property->bedrooms }}
                                </td>

                                <td>
                                    {{ $row->property->baths }}
                                </td>

                                <td>
                                    {!! getStatusIcon($row->property->is_enabled) !!}
                                </td>

                                <td>
                                    {!! getStatusIcon($row->property->is_online) !!}
                                </td>

                                <td>
                                    @if ($row->property->user)
                                        {{ $row->property->user->profile->full_name }}
                                    @endif
                                </td>

                                <td>
                                    <a href="#to-property-management-with-id" class="text-primary">
                                        <b>{{ __('PM') }}</b>
                                    </a>
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id],
                                        'showRoute' => 'properties.show',
                                        'editRoute' => 'properties.edit',
                                        'deleteRoute' => 'properties.destroy',
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
