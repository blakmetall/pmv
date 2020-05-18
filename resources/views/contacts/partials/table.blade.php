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
                        <th scope="col">{{ __('Phones') }}</th>
                        <th scope="col">{{ __('Contact Type') }}</th>
                        <th scope="col">{{ __('Active') }}</th>
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

                                <!-- full_name -->
                                <td>{{ $row->full_name }} </td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- contact -->
                                <td>
                                    {!! preparePhoneContacts([$row->phone, $row->mobile]) !!}
                                </td>

                                <!-- contact_type -->
                                <td>{{ $row->contact_type }}</td>

                                <!-- is_active -->
                                <td>
                                    {!! getStatusIcon($row->is_active) !!}
                                </td>
                                
                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'contacts.show',
                                        'editRoute' => 'contacts.edit',
                                        'deleteRoute' => 'contacts.destroy',
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
