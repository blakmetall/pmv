@php
    $lang = LanguageHelper::current();
@endphp

<div class="mb-5"></div>

<a href="#" class="btn-print" data-table="table-print-bookings"
    data-title="{{ __('Arrivals & Departures') }}">
    <i class="nav-icon i-Billing"></i>
    {{ __('Print') }}
</a>

<div class="mb-4"></div>

<div id="table-print-bookings" class="table-responsive">
    <table class="table table-striped mb-5">
        <thead>
            <tr>
                <th colspan="12" class="title-th">
                    {{ $label_arrivals . ' ' . __('Between') . ' ' . $fromDate . ' ' . __('And') . ' ' . $toDate . ' ' . __('At') . ' ' . $nameLocation }}
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="1">#</th>
                <th scope="col" colspan="1">ID</th>
                <th scope="col" colspan="1">{{ __('Guest') }}</th>
                <th scope="col" colspan="1">{{ __('Property') }}</th>
                <th scope="col" colspan="1">{{ __('Arrival') }}</th>
                <th scope="col" colspan="1">{{ __('Check-in') }}</th>
                <th scope="col" colspan="1">{{ __('Flight') }}</th>
                <th scope="col" colspan="1">{{ __('Booked') }}</th>
                <th scope="col" colspan="1">{{ __('Register By') }}</th>
                @if(!isRole('owner'))
                    <th scope="col" colspan="1">{{ __('Notes') }}</th>
                    <th scope="col" colspan="1">{{ __('Comments') }}</th>
                @endif
            </tr>

        </thead>
        <tbody>


            @if (count($arrivals))
                @foreach ($arrivals as $i => $arrival)
                    @php
                        if(isRole('admin') || isRole('super') || isRole('property-management') || isRole('rentals') || isRole('operations-manager') || isRole('operations-assistant') || isRole('administrative-assistant')){
                            if($arrival->register_by !== 'Client' && $arrival->register_by !== 'Cliente' && $arrival->property->management->isEmpty()){
                                continue;
                            }
                        }
                        $occupants = __('Occupants:') . ' ' . $arrival->adults . ' ' . __('Adults') . ' - ' . ceil($arrival->kids) . ' ' . __('Children');
                        $managed = !$arrival->property->management->isEmpty() ? __('MANAGED') : '';
                        $flight = $arrival->arrival_airline . ' ' . $arrival->arrival_flight_number;
                        $arrival_time = $arrival->arrival_time;
                        $arrival_transportation = $arrival->arrival_transportation ? __('YES') : __('NO');
                        $transportation = $arrival_transportation;
                        $booked = $arrival->created_at;
                        if ($arrival->user()->exists()) {
                            $owner = $arrival->user->profile->full_name;
                        } else {
                            $owner = 'Verify';
                        }
                    @endphp

                    <tr>
                        <!-- index -->
                        <th scope="row">
                            {{ $i + 1 }}
                        </th>

                        <!-- id -->
                        <th scope="row">
                            {{ $arrival->id }}
                        </th>

                        <!-- guest -->
                        <td>
                            {{ $arrival->firstname }} {{ $arrival->lastname }}<br />
                            {{ $occupants }}<br />

                            @if (!isRole('owner'))
                                {{ $arrival->phone }}<br />
                                {{ $arrival->mobile }}<br />
                                <a href="mailto:{{ $arrival->email }}">{{ $arrival->email }}</a>
                            @endif
                        </td>

                        <!-- property -->
                        <td>
                            {{ $arrival->property->translations()->where('language_id', $lang->id)->first()->name . ' (' . $arrival->property->id . ')' }}
                            <br />
                            {{ $managed }}
                        </td>

                        <!-- arrival -->
                        <td>
                            <strong>{{ getReadableDate($arrival->arrival_date) }}</strong> -
                            {{ getReadableDate($arrival->departure_date) }}<br />
                            {{ $arrival->nights }} {{ __('Nights') }}
                        </td>

                        <!-- check_in -->
                        <td>{{ $arrival->check_in }}</td>

                        <!-- flight -->
                        <td>
                            {{ $flight }}<br />
                            {{ $arrival_time }}<br />
                            {{ $transportation }}
                        </td>

                        <!-- booked -->
                        <td>
                            {{ $booked }}<br />
                            {{ $owner }}
                        </td>

                        <!-- register_by -->
                        <td>
                            {{ $arrival->register_by }}
                        </td>

                        @if(!isRole('owner'))
                            <!-- notes -->
                            <td>
                                {!! $arrival->arrival_notes !!}
                            </td>
                            <!-- comments -->
                            <td>
                                {!! $arrival->comments !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="12" class="title-th">
                    {{ $label_departures . ' ' . __('Between') . ' ' . $fromDate . ' ' . __('And') . ' ' . $toDate . ' ' . __('At') . ' ' . $nameLocation }}
                </th>
            </tr>
            <tr>
                <th scope="col" colspan="1">#</th>
                <th scope="col" colspan="1">ID</th>
                <th scope="col" colspan="1">{{ __('Guest') }}</th>
                <th scope="col" colspan="1">{{ __('Property') }}</th>
                <th scope="col" colspan="1">{{ __('Departure Arrival') }}</th>
                <th scope="col" colspan="1">{{ __('Check-out') }}</th>
                <th scope="col" colspan="1">{{ __('Flight') }}</th>
                <th scope="col" colspan="1">{{ __('Booked') }}</th>
                <th scope="col" colspan="1">{{ __('Register By') }}</th>
                @if(!isRole('owner'))
                    <th scope="col" colspan="1">{{ __('Notes') }}</th>
                    <th scope="col" colspan="1">{{ __('Comments') }}</th>
                @endif
            </tr>

        </thead>
        <tbody>


            @if (count($departures))
                @foreach ($departures as $i => $departure)
                    @php
                        if(isRole('admin') || isRole('super') || isRole('property-management') || isRole('rentals') || isRole('operations-manager') || isRole('operations-assistant') || isRole('administrative-assistant')){
                            if($departure->register_by !== 'Client' && $departure->register_by !== 'Cliente' && $departure->property->management->isEmpty()){
                                continue;
                            }
                        }
                        $occupants = __('Occupants:') . ' ' . $departure->adults . ' ' . __('Adults') . ' - ' . ceil($departure->kids) . ' ' . __('Children');
                        $managed = !$departure->property->management->isEmpty() ? __('MANAGED') : '';
                        $flight = $departure->departure_airline . ' ' . $departure->departure_flight_number;
                        $departure_time = $departure->departure_time;
                        $departure_transportation = $departure->departure_transportation ? __('YES') : __('NO');
                        $transportation = $departure_transportation;
                        $booked = $departure->created_at;
                        if ($departure->user()->exists()) {
                            $owner = $departure->user->profile->full_name;
                        } else {
                            $owner = 'Verify';
                        }
                    @endphp
                    <tr>
                        <!-- index -->
                        <th scope="row">

                            {{ $i + 1 }}
                        </th>

                        <!-- id -->
                        <th scope="row">
                            {{ $departure->id }}
                        </th>

                        <!-- guest -->
                        <td>
                            {{ $departure->firstname }} {{ $departure->lastname }}<br />
                            {{ $occupants }}<br />

                            @if (!isRole('owner'))
                                {{ $departure->phone }}<br />
                                {{ $departure->mobile }}<br />
                                <a href="mailto:{{ $departure->email }}">{{ $departure->email }}</a>
                            @endif
                        </td>

                        <!-- property -->
                        <td>
                            {{ $departure->property->translations()->where('language_id', $lang->id)->first()->name . ' (' . $departure->property->id . ')' }}
                            <br />
                            {{ $managed }}
                        </td>

                        <!-- departure -->
                        <td>

                            {{ getReadableDate($departure->arrival_date) }} -
                            <strong>{{ getReadableDate($departure->departure_date) }}</strong>
                            <br />
                            {{ $departure->nights }} {{ __('Nights') }}
                        </td>

                        <!-- check_out -->
                        <td>{{ $departure->check_out }}</td>

                        <!-- flight -->
                        <td>
                            {{ $flight }}<br />
                            {{ $departure_time }}<br />
                            {{ $transportation }}
                        </td>

                        <!-- booked -->
                        <td>
                            {{ $booked }}<br />
                            {{ $owner }}
                        </td>

                        <!-- register_by -->
                        <td>
                            {{ $departure->register_by }}
                        </td>

                        @if(!isRole('owner'))
                            <!-- notes -->
                            <td>
                                {!! $departure->departure_notes !!}
                            </td>
                            <!-- comments -->
                            <td>
                                {!! $departure->comments !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
    