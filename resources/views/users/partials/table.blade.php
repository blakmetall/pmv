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
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Roles') }}</th>
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

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- name -->
                                <td>
                                    @if($row->profile)
                                        {{ $row->profile->full_name }}
                                    @endif
                                </td>

                                <!-- is_enabled -->
                                <th scope="row">
                                    @php 
                                        $enabledClass = ($row->is_enabled) ? 'secondary' : 'danger';
                                        $enabledLabel = ($row->is_enabled) ? __('Enabled') : __('Disabled');
                                    @endphp

                                    <span class="badge badge-{{ $enabledClass }} p-1">
                                        {{ $enabledLabel }}
                                    </span>
                                </th>

                                <!-- roles -->
                                <td>
                                    @foreach (RoleHelper::available($row->id) as $role)
                                        <div>
                                            <span class="badge badge-primary p-1 mb-1">
                                                {{ $role['name'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                </td>

                                <!-- created/updated cols -->
                                @include('components.table.created-updated', [
                                    'created_at' => $row->created_at,
                                    'updated_at' => $row->updated_at,
                                ])

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions-email', [
                                        'params' => [$row->id],
                                        'emailRoute' => 'users.email',
                                        'showRoute' => 'users.show',
                                        'editRoute' => 'users.edit',
                                        'deleteRoute' => 'users.destroy',
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
