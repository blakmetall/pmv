<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }} </div>
    <div class="card-body pt-5">
        
        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Bedrooms') }}</th>
                        <th scope="col">{{ __('Baths') }}</th>
                        <th scope="col">{{ __('Enabled') }}</th>
                        <th scope="col">{{ __('Online') }}</th>
                        <th scope="col">{{ __('Owner') }}</th>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->property->id }}
                                </th>

                                <!-- thumbnail -->
                                <th>
                                    @if ($row->property->hasDefaultImage())
                                        @php
                                            $propertyImg = $row->property->getDefaultImage();
                                        @endphp
                                        <a href="{{ asset(getUrlPath($propertyImg->file_url)) }}" target="_blank">
                                            <img src="{{ asset(getUrlPath($propertyImg->file_url, 'small-ls')) }}" alt="" width="100">
                                        </a>
                                    @endif
                                </th>

                                <!-- property name -->
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
                                    @if( !isRole('owner') )
                                        <a 
                                            href="{{ route('property-rates', $row->property->id) }}" 
                                            class="text-primary app-icon-link"
                                            title="{{ __('Rates') }}"
                                            alt="{{ __('Rates') }}">
                                            <i class="nav-icon i-Money-2 font-weight-bold"></i>
                                        </a>
                                    @endif

                                    <!-- property images -->
                                    @if( !isRole('owner') )
                                        <a 
                                            href="{{ route('property-images', $row->property->id) }}"
                                            class="text-primary app-icon-link"
                                            title="{{ __('Images') }}"
                                            alt="{{ __('Images') }}">
                                            <i class="nav-icon i-Old-Camera font-weight-bold"></i>
                                        </a>
                                    @endif

                                    <!-- bookings from specific to property -->
                                    @if( !isRole('owner') )
                                        <a 
                                            href="{{ route('bookings.by-property', $row->property->id) }}" 
                                            class="text-primary app-icon-link"
                                            title="{{ __('Bookings') }}"
                                            alt="{{ __('Bookings') }}">
                                            <i class="nav-icon i-Calendar-2 font-weight-bold"></i>
                                        </a>
                                    @endif

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
                                        'skipEdit' => isRole('owner'),
                                        'skipDelete' => isRole('owner')
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
