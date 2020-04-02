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
                        <th scope="col">{{ __('City') }}</th>
                        <th scope="col">{{ __('Company') }}</th>
                        <th scope="col">{{ __('Contact Name') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Mobile') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
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

                                <!-- city -->
                                <td>
                                    {{ $row->city->name }}
                                </td>

                                <!-- company -->
                                <td>{{ $row->company }}</td>

                                <!-- contact_name -->
                                <td>{{ $row->contact_name }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

                                <!-- mobile -->
                                <td>{{ $row->mobile }}</td>

                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- address -->
                                <td>{{ $row->address }}</td>

                                <!-- actions -->
                                <td>
                                    <a href="{{ route('contractors.show', [$row->id]) }}" class="text-primary mr-2">
                                        <i class="nav-icon i-Eye font-weight-bold"></i>
                                    </a>

                                    <a href="{{ route('contractors.edit', [$row->id]) }}" class="text-success mr-2">
                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                    </a>

                                    <a href="{{ route('contractors.destroy', [$row->id]) }}" class="text-danger mr-2">
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
