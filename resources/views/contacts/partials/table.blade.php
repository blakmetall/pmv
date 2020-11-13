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
                        @foreach($rows as $row)
                            {{-- Filtro provisional para que solo muestre usuarios de tipo contacto --}}
                            @foreach($row->roles as $role)
                                @php
                                    if($role->id == 14){
                                        $isContact = true;
                                    }else{
                                        $isContact = false;
                                    }
                                @endphp
                            @endforeach
                            @php
                                if(!$isContact){
                                    continue;
                                }
                            @endphp
                            {{-- Termina filtro provisional para que solo muestre usuarios de tipo contacto --}}
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- full_name -->
                                <td>{{ $row->profile->full_name }} </td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- contact -->
                                <td>
                                    {!! preparePhoneContacts([$row->profile->phone, $row->profile->mobile]) !!}
                                </td>

                                <!-- emergency_phone -->
                                <td>{{ $row->profile->emergency_phone }}</td>

                                <!-- contact_type -->
                                <td>{{ getContactTypeBySlug($row->profile->contact_type) }}</td>

                                <!-- owner -->
                                <td>
                                    @foreach ($row->profile->owners() as $owner)
                                        {{ $owner->profile->full_name }}
                                    @endforeach
                                </td>

                                <!-- is_enabled -->
                                <td>
                                    {!! getStatusIcon($row->is_enabled) !!}
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

    </div>
</div>
