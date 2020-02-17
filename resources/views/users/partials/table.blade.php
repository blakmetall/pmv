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
                                <td>{{ $row->email }}</td>

                                <!-- is_enabled -->
                                <th scope="row">
                                    <span class="badge badge-{{ ($row->is_enabled) ?'success' : 'danger' }}">{{ ($row->is_enabled) ? 'Enabled' : 'Disabled' }}</span>
                                </th>

                                <!-- actions -->
                                <td>
                                    <a href="{{ route('users.edit', [$row->id]) }}" class="text-success mr-2">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>
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
