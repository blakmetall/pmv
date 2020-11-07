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
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Audited by') }}</th>
                        <th scope="col">&nbsp;</th>
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

                                <!-- description -->
                                <td>{{ $row->description }}</td>

                                <!-- property -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- audit_user_id -->
                                <td>
                                    
                                    @if($row->audit_user_id)
                                        <a href="{{ route('users.edit', $row->audit_user_id) }}">
                                            {{ $row->auditedBy->profile->firstname }}
                                        </a>
                                    @endif
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id, $row->id],
                                        'showRoute' => 'property-notes.show',
                                        'editRoute' => 'property-notes.edit',
                                        'deleteRoute' => 'property-notes.destroy',
                                        'skipEdit' => isRole('owner') || isRole('contact'),
                                        'skipDelete' => isRole('owner') || isRole('contact'),
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
