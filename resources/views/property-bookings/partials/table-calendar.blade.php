@php
    $lang = LanguageHelper::current();
@endphp
<div class="mb-5"></div>
<div class="card">
    <div class="card-header">
        <div class="btns-container">
            <a href="{{ route('property-calendar', [$property->id, $prevYear]) }}" class="btn btn-dark">{{ __('Prev Year') }}</a>
            <span>{{ $currYear }}</span>
            <a href="{{ route('property-calendar', [$property->id, $nextYear]) }}" class="btn btn-dark">{{ __('Next Year') }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="calendar-container">
		    {!! $calendar !!}
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('Guest') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Travel Dates') }}</th>
                        <th scope="col">{{ __('Nightly Rate') }}</th>
                        <th scope="col">{{ __('Total') }}</th>
                        <th scope="col">{{ __('Status') }}</th>
                        <th scope="col">{{ __('Created') }}</th>
                        <th scope="col">{{ __('Updated') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($bookings))
                        @foreach($bookings as $i => $booking)
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $i+1 }}
                                </th>

                                <!-- id -->
                                <th scope="row">
                                    {{ $booking->id }}
                                </th>

                                <!-- guest -->
                                <td>
                                    {{ $booking->firstname }} {{ $booking->lastname }}
                                </td>

                                <!-- property -->
                                <td>{{ $booking->property->translations()->where('language_id', $lang->id)->first()->name }} </td>

                                <!-- travel_dates -->
                                <td>{{ $booking->arrival_date }} - {{ $booking->departure_date }}<br>{{ $booking->nights }} {{ __('Nights') }}</td>

                                <!-- nightly_rate -->
                                <td>{{ priceFormat($booking->price_per_night) }}</td>

                                <!-- total_stay -->
                                <td>{{ priceFormat($booking->total) }}</td>

                                <!-- is_cancelled -->
                                <td>
                                    {!! getStatusIcon(!$booking->is_cancelled) !!}
                                </td>

                                <!-- created/updated cols -->
                                @include('components.table.created-updated', [
                                    'created_at' => $booking->created_at,
                                    'updated_at' => $booking->updated_at,
                                    'trimTime' => true,
                                ])

                                    <!-- actions -->
                                <td>
                                    @if($booking->property->user->id == \UserHelper::getCurrentUserID() || isRole('super') || isRole('admin'))
                                        @include('components.table.actions-bookings', [
                                            'params' => [$booking->id],
                                            'paymentsRoute' => 'property-booking-payments',
                                            'showRoute' => 'property-bookings.show',
                                            'editRoute' => 'property-bookings.edit',
                                            'deleteRoute' => 'property-bookings.destroy',
                                        ])
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
