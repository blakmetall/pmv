@php
    $lang = LanguageHelper::current();
@endphp

<div class="mb-5"></div>
<div class="card">
    <div class="card-header">
        <div class="btns-container">
            <a href="{{ route('property-calendar', [$property->id, $prevYear]) }}" class="btn btn-dark">
                {{ __('Prev Year') }}
            </a>
            <span>{{ $currYear }}</span>
            <a href="{{ route('property-calendar', [$property->id, $nextYear]) }}"class="btn btn-dark">
                {{ __('Next Year') }}
            </a>
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
                        <th scope="col">{{ __('Register By') }}</th>
                        <th scope="col">{{ __('Created') }}</th>
                        <th scope="col">{{ __('Updated') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($bookings))
                        @foreach ($bookings as $i => $booking)
                            @php
                                if($booking->register_by == 'Client' || $booking->register_by == 'Cliente'){
                                    $skipEdit = true;
                                    $skipDestroy = true;
                                }else{
                                    $skipEdit = false;
                                    $skipDestroy = false;
                                }
                            @endphp
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $i + 1 }}
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
                                <td>
                                    {{ $booking->property->translations()->where('language_id', $lang->id)->first()->name }}
                                </td>

                                <!-- travel_dates -->
                                <td>
                                    {{ getReadableDate($booking->arrival_date) }} -
                                    {{ getReadableDate($booking->departure_date) }}
                                    <br />
                                    {{ $booking->nights }} {{ __('Nights') }}
                                </td>

                                <!-- nightly_rate -->
                                <td>{{ priceFormat($booking->price_per_night) }}</td>

                                <!-- total_stay -->
                                <td>{{ priceFormat($booking->total) }}</td>

                                <!-- is_cancelled -->
                                <td>
                                    {!! getStatusIcon(!$booking->is_cancelled) !!}
                                </td>

                                <!-- register_by -->
                                <td>
                                    {{ __($booking->register_by) }}
                                </td>

                                <!-- created/updated cols -->
                                @include('components.table.created-updated', [
                                    'created_at' => getReadableDate($booking->created_at, '', true),
                                    'updated_at' => getReadableDate($booking->updated_at, '', true),
                                    'trimTime' => true,
                                ])

                                <!-- actions -->
                                <td>
                                    @if ($booking->property->users->isNotEmpty())
                                        @php
                                            $propertyUser = false;
                                        @endphp

                                        @foreach ($booking->property->users as $user)
                                            @if ($user->id == \UserHelper::getCurrentUserID())
                                                @php
                                                    $propertyUser = true;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($propertyUser || isRole('super') || isRole('admin'))
                                            @include('components.table.actions-bookings', [
                                                'params' => [$booking->id],
                                                'paymentsRoute' => 'property-booking-payments',
                                                'showRoute' => 'property-bookings.show',
                                                'editRoute' => 'property-bookings.edit',
                                                'deleteRoute' => 'property-bookings.destroy',
                                                'skipEdit' => $skipEdit,
                                                'skipDelete' => $skipDestroy,
                                            ])
                                        @endif
                                    @else
                                        @if ($booking->property->user->id == \UserHelper::getCurrentUserID() || isRole('super') || isRole('admin'))
                                            @include('components.table.actions-bookings', [
                                                'params' => [$booking->id],
                                                'paymentsRoute' => 'property-booking-payments',
                                                'showRoute' => 'property-bookings.show',
                                                'editRoute' => 'property-bookings.edit',
                                                'deleteRoute' => 'property-bookings.destroy',
                                                'skipEdit' => $skipEdit,
                                                'skipDelete' => $skipDestroy,
                                            ])
                                        @endif
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
