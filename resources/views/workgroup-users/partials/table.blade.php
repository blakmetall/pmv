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
                        <th scope="col">{{ __('User') }}</th>
                        <th scope="col">{{ __('Workgroup') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>

                                <!-- user -->
                                <td>
                                    @if ($row->user)
                                        <a href="{{ route('users.show', [$row->user->id]) }}">
                                            {{ $row->user->profile->full_name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- workgroup -->
                                <td>
                                    @if ($row->workgroup)
                                        <a href="{{ route('workgroups.show', [$row->workgroup->id]) }}">
                                            {{ $row->workgroup->city->name }}
                                        </a>
                                    @endif
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
