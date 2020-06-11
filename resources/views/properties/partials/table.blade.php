<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }} </div>
    <div class="card-body pt-5">

        <!-- Export Link -->
        {{-- @include('partials.buttons.export-button',[
            'label' =>false,
            'url' => getCurrentUrlFull('shouldGenerateExcel'),
            'icon' => 'i-File-Excel',
        ]) --}}
        
        
        
        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Bedrooms') }}</th>
                        <th scope="col">{{ __('Baths') }}</th>
                        <th scope="col">{{ __('Enabled') }}</th>
                        <th scope="col">{{ __('Online') }}</th>
                        <th scope="col">{{ __('Owner') }}</th>
                        <th scope="col">&nbsp;</th>
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

                                <td>
                                    {{ $row->name }}
                                </td>

                                <td>
                                    {{ $row->property->bedrooms }}
                                </td>

                                <td>
                                    {{ $row->property->baths }}
                                </td>

                                <td>
                                    {!! getStatusIcon($row->property->is_enabled) !!}
                                </td>

                                <td>
                                    {!! getStatusIcon($row->property->is_online) !!}
                                </td>

                                <td>
                                    @if ($row->property->user)
                                        <a href="{{ route('users.show', [$row->property->user->id]) }}">
                                            {{ $row->property->user->profile->full_name }}
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    <!-- property notes -->
                                    <a 
                                        href="{{ route('property-notes', $row->property->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Notes') }}"
                                        alt="{{ __('Notes') }}">
                                        <i class="nav-icon i-Notepad font-weight-bold"></i>
                                    </a>

                                    <!-- property contacts -->
                                    <a 
                                        href="{{ route('property-contacts', $row->property->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Contacts') }}"
                                        alt="{{ __('Contacts') }}">
                                        <i class="nav-icon i-Administrator font-weight-bold"></i>
                                    </a>

                                    <!-- property rates -->
                                    <a 
                                        href="{{ route('property-rates', $row->property->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Rates') }}"
                                        alt="{{ __('Rates') }}">
                                        <i class="nav-icon i-Money-2 font-weight-bold"></i>
                                    </a>

                                    <!-- property images -->
                                    <a 
                                        href="{{ route('property-images', $row->property->id) }}"
                                        class="text-primary app-icon-link"
                                        title="{{ __('Images') }}"
                                        alt="{{ __('Images') }}">
                                        <i class="nav-icon i-Old-Camera font-weight-bold"></i>
                                    </a>

                                    <!-- bookings from specific to property -->
                                    <a 
                                        href="{{ route('bookings.by-property', $row->property->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Bookings') }}"
                                        alt="{{ __('Bookings') }}">
                                        <i class="nav-icon i-Calendar-2 font-weight-bold"></i>
                                    </a>

                                    <!-- property management -->
                                    <a 
                                        href="{{ route('property-management', $row->property->id) }}" 
                                        class="text-primary app-icon-link"
                                        title="{{ __('Property Management') }}"
                                        alt="{{ __('Property Management') }}">
                                        <i class="nav-icon i-Building font-weight-bold"></i>
                                    </a>

                                          

                                    
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id],
                                        'showRoute' => 'properties.show',
                                        'editRoute' => 'properties.edit',
                                        'deleteRoute' => 'properties.destroy',
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
