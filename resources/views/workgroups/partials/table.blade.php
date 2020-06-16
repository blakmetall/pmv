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
                        <th scope="col">{{ __('City') }}</th>
                        <th scope="col">{{ __('Users') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>

                                <!-- name -->
                                <td>{{ $row->city->name }}</td>

                                <td>
                                    <!-- workgroup users -->
                                    <a 
                                        href="{{ route('workgroup-users', $row->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Users') }}"
                                        alt="{{ __('Users') }}">
                                        <i class="nav-icon i-Administrator font-weight-bold"></i>
                                    </a>
                                </td>

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
