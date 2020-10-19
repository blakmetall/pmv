<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }} </div>
    <div class="card-body">

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

        @if(count($rows))
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">&nbsp;</th>

                            @if(isRole('owner'))
                                <th scope="col">{{ __('Property') }}</th>
                            @endif

                            <th scope="col">{{ __('Bedrooms') }}</th>
                            <th scope="col">{{ __('Baths') }}</th>
                            <th scope="col">{{ __('Building') }}</th>
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
                                    @if(isRole('owner'))
                                        <th>
                                            @if ($row->property->hasDefaultImage())
                                                @php
                                                    $propertyImg = $row->property->getDefaultImage();
                                                @endphp

                                                @include('components.table.file-modal', [
                                                    'fileName' => $propertyImg->file_original_name,
                                                    'filePath' => $propertyImg->file_path,
                                                    'fileUrl' => $propertyImg->file_url,
                                                    'fileSlug' => $propertyImg->file_slug,
                                                    'imgUrl' => $propertyImg->file_url,
                                                    'imgSize' => 'small-ls',
                                                ])
                                            @endif
                                        </th>
                                    @endif

                                    <!-- property name -->
                                    <td>
                                        {{ $row->name }}

                                        @php
                                            $activePM = $row->property->getActivePM();
                                        @endphp

                                        @if($activePM !== false && isset($activePM->id))
                                            - <a href="<?= route('property-management-transactions', [$activePM->id])?>" class="text-success">PM</a>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $row->property->bedrooms }}
                                    </td>

                                    <td>
                                        {{ $row->property->baths }}
                                    </td>

                                    <td>
                                        @if ($row->property->building()->count())
                                            {{ $row->property->building->name }}
                                        @endif
                                    </td>

                                    <td>
                                        {!! getStatusIcon($row->property->is_enabled) !!}
                                    </td>

                                    <td>
                                        {!! getStatusIcon($row->property->is_online) !!}
                                    </td>

                                    <td>
                                        @if ($row->property->user)
                                            @if(!isRole('owner'))
                                                <a href="{{ route('users.show', [$row->property->user->id]) }}">
                                                    {{ $row->property->user->profile->full_name }}
                                                </a>
                                            @else
                                                {{ $row->property->user->profile->full_name }}
                                            @endif
                                        @endif
                                    </td>

                                    <td>
                                        <!-- property view -->
                                        <a
                                            href="{{ route('properties.show', $row->property->id) }}"
                                            class="text-primary app-icon-link"
                                            title="{{ __('View') }}"
                                            alt="{{ __('View') }}">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>

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
                                        @if(!isProduction())
                                            <a
                                                {{-- comenté la url temporalmente para poner que no funcione el link de momento --}}
                                                {{-- href="{{ route('bookings.by-property', $row->property->id) }}"  --}}
                                                href="{{ route('maintenance') }}"
                                                class="text-primary app-icon-link"
                                                title="{{ __('Reservations') }}"
                                                alt="{{ __('Reservations') }}">
                                                <i class="nav-icon i-Calendar-2 font-weight-bold"></i>
                                            </a>
                                        @endif

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

                                        <!-- property contacts -->
                                        <a
                                            href="{{ route('property-contacts', $row->property->id) }}"
                                            class="text-primary app-icon-link"
                                            title="{{ __('Contacts') }}"
                                            alt="{{ __('Contacts') }}">
                                            <i class="nav-icon i-Administrator font-weight-bold"></i>
                                        </a>

                                        <!-- property notes -->
                                        @if( !isRole('owner') )
                                            <a
                                                href="{{ route('property-notes', $row->property->id) }}"
                                                class="text-primary app-icon-link"
                                                title="{{ __('Notes') }}"
                                                alt="{{ __('Notes') }}">
                                                <i class="nav-icon i-Notepad font-weight-bold"></i>
                                            </a>
                                        @endif

                                        <!-- property calendar -->
                                        <a
                                            href="{{ route('property-calendar', $row->property->id) }}"
                                            class="text-primary app-icon-link"
                                            title="{{ __('Calendar') }}"
                                            alt="{{ __('Calendar') }}">
                                            <i class="nav-icon i-Calendar-4 font-weight-bold"></i>
                                        </a>

                                        <!-- property preview -->
                                        @if( !isRole('owner') )
                                            <a
                                                href="{{ route('maintenance') }}"
                                                class="text-primary app-icon-link"
                                                title="{{ __('Preview') }}"
                                                alt="{{ __('Preview') }}">
                                                <i class="nav-icon i-Right font-weight-bold"></i>
                                            </a>
                                        @endif

                                        <!-- property management -->
                                        @if( !isRole('owner') )
                                            <a
                                                href="{{ route('property-management', $row->property->id) }}"
                                                class="text-primary app-icon-link"
                                                title="{{ __('Property Management') }}"
                                                alt="{{ __('Property Management') }}">
                                                <i class="nav-icon i-Building font-weight-bold"></i>
                                            </a>
                                        @endif

                                    </td>

                                    <!-- actions -->
                                    <td>
                                        @include('components.table.actions', [
                                            'params' => [$row->property->id],
                                            'showRoute' => 'properties.show',
                                            'editRoute' => 'properties.edit',
                                            'deleteRoute' => 'properties.destroy',
                                            'skipShow' => true,
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
        @else
            {{ __('No properties found.') }}
        @endif

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
