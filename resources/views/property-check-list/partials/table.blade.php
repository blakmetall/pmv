<div class="mb-5"></div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{ __('ID') }}</th>
                <th scope="col">{{ __('Register By') }}</th>
                <th scope="col">{{ __('Created') }}</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        
        <tbody>
            @if(count($rows))
                @foreach($rows as $row)
                    @php
                        $user = \App\Models\User::find($row->user_id)->profile->full_name;
                        $skipDelete = isRole('owner') || !can('delete', 'property-check-list') ? true : false;
                    @endphp
                    <tr>
                        <!-- id -->
                        <td>
                            {{ $row->id }}
                        </td>

                        <!-- user_id -->
                        <td>
                            {{ $user }}
                        </td>

                        <!-- created -->
                        <td>{{ $row->created_at->format('d/M/Y H:i:s') }}</td>

                        <!-- actions -->
                        <td>
                            @include('components.table.actions', [
                            'params' => [$row->property->id, $row->id],
                            'showRoute' => 'property-check-list.show',
                            'editRoute' => 'property-check-list.edit',
                            'deleteRoute' => 'property-check-list.destroy',
                            'skipEdit' => isRole('owner'),
                            'skipDelete' => $skipDelete,
                            ])
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
