@php
    $lang = LanguageHelper::current();
@endphp
<div class="mb-5"></div>
<div class="card">
    <div class="card-header">
        <a href="#" class="float-right btn-print" data-table="table-print-bookings" data-title="{{ __('Arrivals & Departures') }}">
            <i class="nav-icon i-Billing"></i>
            {{ __('Print') }}
        </a>
    </div>
    <div class="card-body">
        <div id="table-print-bookings" class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th colspan="8" class="title-th">
                            {{ $label_arrivals. __(' between  ') .$fromDate. __(' and ') . $toDate. __(' at ') .$currentLocation->name}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Guest') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Arrival') }}</th>
                        <th scope="col">{{ __('Check-in') }}</th>
                        <th scope="col">{{ __('Flight') }}</th>
                        <th scope="col">{{ __('Booked') }}</th>
                        <th scope="col">{{ __('Notes') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($arrivals))
                        @foreach($arrivals as $arrival)
                            @php
                                $occupants = __('Occupants:').' '.$arrival->adults.' Adult(s) - '.$arrival->kids.' Child(ren)';
                                $managed = ($arrival->property->management)?__('*** MANAGED ***'):'';
                                $flight = $arrival->arrival_airline . ' ' . $arrival->arrival_flight_number;
                                $arrival_transportation = ($arrival->arrival_transportation)?__('YES'):__('NO');
                                $transportation = __('Transportation?'). ' ' . $arrival_transportation;
                                $booked = $arrival->created_at;
                                $owner = $arrival->user->profile->full_name;
                            @endphp
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $arrival->id }}
                                </th>

                                <!-- guest -->
                                <td>
                                    {{ $arrival->firstname }} {{ $arrival->lastname }}<br />
                                    {{ $occupants }}<br />
                                    {{ $arrival->phone }}<br />
                                    {{ $arrival->mobile }}<br />
                                    <a href="mailto:{{ $arrival->email }}">{{ $arrival->email }}</a>
                                </td>

                                <!-- property -->
                                <td>
                                {{ $arrival->property->translations()->where('language_id', $lang->id)->first()->name . ' ('.$arrival->property->id.')' }}<br />
                                {{ $managed }}
                                </td>

                                <!-- arrival -->
                                <td>
                                    <strong>{{ $arrival->arrival_date }}</strong> - {{ $arrival->departure_date }}<br />
                                    {{ $arrival->nights }} {{ __('Nights') }}
                                </td>

                                <!-- check_in -->
                                <td>{{ $arrival->check_in }}</td>

                                <!-- flight -->
                                <td>
                                    {{ $flight }}<br />
                                    {{ $transportation }}
                                </td>

                                <!-- booked -->
                                <td>
                                    {{ $booked }}<br />
                                    {{ $owner }}
                                </td>

                                <!-- comments -->
                                <td>
                                    {{ $arrival->comments }}
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
                <thead>
                    <tr>
                        <th colspan="8" class="title-th">
                            {{ $label_departures. __(' between  ') .$fromDate. __(' and ') . $toDate. __(' at ') .$currentLocation->name}}
                        </th>
                    </tr>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('Guest') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Departure') }}</th>
                        <th scope="col">{{ __('Check-out') }}</th>
                        <th scope="col">{{ __('Flight') }}</th>
                        <th scope="col">{{ __('Booked') }}</th>
                        <th scope="col">{{ __('Notes') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($departures))
                        @foreach($departures as $departure)
                            @php
                                $occupants = __('Occupants:').' '.$departure->adults.' Adult(s) - '.$departure->kids.' Child(ren)';
                                $managed = ($departure->property->management)?__('*** MANAGED ***'):'';
                                $flight = $departure->departure_airline . ' ' . $departure->departure_flight_number;
                                $departure_transportation = ($departure->departure_transportation)?__('YES'):__('NO');
                                $transportation = __('Transportation?'). ' ' . $departure_transportation;
                                $booked = $departure->created_at;
                                $owner = $departure->user->profile->full_name;
                            @endphp
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $departure->id }}
                                </th>

                                <!-- guest -->
                                <td>
                                    {{ $departure->firstname }} {{ $departure->lastname }}<br />
                                    {{ $occupants }}<br />
                                    {{ $departure->phone }}<br />
                                    {{ $departure->mobile }}<br />
                                    <a href="mailto:{{ $departure->email }}">{{ $departure->email }}</a>
                                </td>

                                <!-- property -->
                                <td>
                                {{ $departure->property->translations()->where('language_id', $lang->id)->first()->name . ' ('.$departure->property->id.')' }}<br />
                                {{ $managed }}
                                </td>

                                <!-- departure -->
                                <td>
                                    {{ $departure->arrival_date }} - <strong>{{ $departure->departure_date }}</strong><br />
                                    {{ $departure->nights }} {{ __('Nights') }}
                                </td>

                                <!-- check_out -->
                                <td>{{ $departure->check_out }}</td>

                                <!-- flight -->
                                <td>
                                    {{ $flight }}<br />
                                    {{ $transportation }}
                                </td>

                                <!-- booked -->
                                <td>
                                    {{ $booked }}<br />
                                    {{ $owner }}
                                </td>

                                <!-- comments -->
                                <td>
                                    {{ $departure->comments }}
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</div>
