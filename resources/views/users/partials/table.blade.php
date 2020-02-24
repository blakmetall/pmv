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
                                <td>{{ $row->profile->firstname }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- roles -->
                                <td>
                                    @foreach (RoleHelper::roles($row->id) as $role)
                                        <a href="{{ route('roles.edit', $role['id']) }}"> <i class="nav-icon i-Pen-2 font-weight-bold text-success mr-2"></i> <span class="badge badge-secondary">{{ $role['name'] }}</span></a>
                                    @endforeach
                                </td>

                                <!-- is_enabled -->
                                <th scope="row">
                                    <span class="badge badge-{{ ($row->is_enabled) ?'success' : 'danger' }}">{{ ($row->is_enabled) ? 'Enabled' : 'Disabled' }}</span>
                                </th>

                                <!-- actions -->
                                <td>
                                    <!-- profile -->
                                    <a href="{{ route('profiles.edit', [$row->profile->id]) }}" class="text-primary mr-2">
                                        <i class="nav-icon i-File-Edit font-weight-bold"></i>
                                    </a>
                                    <!-- edit -->
                                    <a href="{{ route('users.edit', [$row->id]) }}" class="text-success mr-2">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
                                    <!-- delete -->
                                    <a href="{{ route('users.destroy', [$row->id]) }}" class="text-danger mr-2">
                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                    </a>
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
