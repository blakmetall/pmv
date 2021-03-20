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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phones') }}</th>
                        <th scope="col">{{ __('Active Agent') }}</th>
                        <th scope="col">{{ __('Active User') }}</th>
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

                                <!-- name -->
                                <td>
                                    @if($row->profile)
                                        <a href="{{ route('users.show', [$row->profile->user->id]) }}">
                                            {{ $row->profile->full_name }}
                                        </a>
                                    @else
                                        ...
                                    @endif
                                </td>
                                
                                <!-- email -->
                                <td>{{ $row->email }}</td>

                                <!-- phones -->
                                <td>
                                    @if($row->profile)
                                        {!! preparePhoneContacts([$row->profile->phone, $row->profile->mobile]) !!}
                                    @endif
                                </td>

                                <!-- is_enabled -->
                                <td>
                                    {!! getStatusIcon($row->is_active) !!}
                                </td>

                                <!-- user status -->
                                <td>
                                    {!! getStatusIcon($row->is_enabled) !!}
                                </td>

                                <!-- actions -->
                                <td>
                                    {{-- @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'agents.show',
                                        'editRoute' => 'agents.edit',
                                        'deleteRoute' => 'agents.destroy',
                                    ]) --}}
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
