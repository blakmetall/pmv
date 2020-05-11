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
                        <th scope="col">{{ __('Roles') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
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
                                <td>
                                    @if($row->profile)
                                        {{ $row->profile->firstname }}
                                        {{ $row->profile->lastname}}
                                    @else
                                        ...
                                    @endif
                                </td>
                                
                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- roles -->
                                <td>
                                    @foreach (RoleHelper::available($row->id) as $role)
                                        <div>
                                            <span class="badge badge-secondary p-1 mb-1">
                                                {{ $role['name'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                </td>

                                <!-- is_enabled -->
                                <th scope="row">
                                    @php 
                                        $enabledClass = ($row->is_enabled) ? 'success' : 'danger';
                                        $enabledLabel = ($row->is_enabled) ? __('Enabled') : __('Disabled');
                                    @endphp

                                    <span class="badge badge-{{ $enabledClass }} p-1">
                                        {{ $enabledLabel }}
                                    </span>
                                </th>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'agents.show',
                                        'editRoute' => 'agents.edit',
                                        'deleteRoute' => 'agents.destroy',
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
