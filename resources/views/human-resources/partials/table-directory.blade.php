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
                        <th scope="col">{{ __('Firstname') }}</th>
                        <th scope="col">{{ __('Lastname') }}</th>
                        <th scope="col">{{ __('City') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
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

                                <!-- firstname -->
                                <td>{{ $row->firstname }}</td>

                                <!-- lastname -->
                                <td>{{ $row->lastname }}</td>

                                <!-- city_id -->
                                <td>{{ $row->city->name }}</td>

                                <!-- phone -->
                                <td>{{ $row->phone }}</td>

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
