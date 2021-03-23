<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Email') }}</th>
                <th scope="col">{{ __('Phones') }}</th>
                <th scope="col">{{ __('Emergency Phone') }}</th>
                <th scope="col">{{ __('Contact Type') }}</th>
                <th scope="col">{{ __('Owner') }}</th>
                <th scope="col">{{ __('Active') }}</th>
                <th scope="col">{{ __('Created') }}</th>
                <th scope="col">{{ __('Updated') }}</th>
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

                        <!-- full_name -->
                        <td>{{ $row->full_name }} </td>

                        <!-- email -->
                        <td>{{ $row->email }}</td>

                        <!-- contact -->
                        <td>
                            {!! preparePhoneContacts([$row->phone, $row->mobile]) !!}
                        </td>

                        <!-- emergency_phone -->
                        <td>{{ $row->emergency_phone }}</td>

                        <!-- contact_type -->
                        <td>{{ getContactTypeBySlug($row->contact_type) }}</td>

                        <!-- owner -->
                        <td>
                            @if($row->owner)
                                {{ $row->owner->full_name }}
                            @endif
                        </td>

                        <!-- is_active -->
                        <td>
                            {!! getStatusIcon($row->is_active) !!}
                        </td>

                        <!-- created/updated cols -->
                        @include('components.table.created-updated', [
                            'created_at' => $row->created_at,
                            'updated_at' => $row->updated_at,
                            'trimTime' => true,
                        ])

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
