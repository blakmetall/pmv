<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">{{ __('Property') }}</th>
                
                @if(!isRole('owner'))
                    <th scope="col">{{ __('Staff') }}</th>
                @endif
                
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Maid Fee') }}</th>
                
                @if(!isRole('owner'))
                    <th scope="col">{{ __('Audited by') }}</th>
                    <th scope="col">{{ __('Finished') }}</th>
                @endif

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

                        <!-- property_id -->
                        <td>
                            @if ($row->property->hasTranslation())
                                <a href="{{ route('properties.show', [$row->property->id]) }}">
                                    {{ $row->property->translate()->name }}
                                </a>
                            @endif
                        </td>

                        <!-- staff -->
                        @if(!isRole('owner'))
                            <td>
                                @if ($row->cleaningStaff()->count())
                                    @foreach ($row->cleaningStaff as $staff)
                                        {{ $staff->full_name }} <br>
                                    @endforeach
                                @endif
                            </td>
                        @endif

                        <!-- date -->
                        <td>{{ getReadableDate($row->date) }}</td>

                        <!-- total_cost -->
                        <td>{{ priceFormat($row->total_cost) }}</td>

                        @if(!isRole('owner'))
                            <!-- audit_user_id -->
                            <td>
                                
                                @if($row->audit_user_id)
                                    <a href="{{ route('users.edit', $row->audit_user_id) }}">
                                        {{ $row->auditedBy->profile->firstname }}
                                    </a>
                                @endif
                            </td>

                            <!-- is_finished -->
                            <td>
                                {!! getStatusIcon($row->is_finished) !!}
                            </td>
                        @endif
                        
                        <!-- actions -->
                        <td>
                            @include('components.table.actions', [
                                'params'      => [$row->id],
                                'showRoute'   => 'cleaning-services.show',
                                'editRoute'   => 'cleaning-services.edit',
                                'deleteRoute' => 'cleaning-services.destroy',
                                'skipEdit'    => isRole('owner') || !can('edit', 'cleaning-services'),
                                'skipDelete'  => isRole('owner') || !can('edit', 'cleaning-services'),
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
