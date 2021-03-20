@php
$lang = LanguageHelper::current();
@endphp
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
                        <th scope="col">ID</th>
                        <th scope="col">{{ __('Guest') }}</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Travel Dates') }}</th>
                        <th scope="col">{{ __('Nightly Rate') }}</th>
                        <th scope="col">{{ __('Total') }}</th>
                        <th scope="col">{{ __('Register By') }}</th>
                        <th scope="col">{{ __('Created') }}</th>
                        <th scope="col">{{ __('Updated') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if (count($rows))
                        @foreach ($rows as $i => $row)
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $i + 1 }}
                                </th>

                                <!-- id -->
                                <th scope="row">
                                    {{ $row->id }}
                                </th>

                                <!-- guest -->
                                <td>
                                    {{ $row->firstname }} {{ $row->lastname }}
                                </td>

                                <!-- property -->
                                <td>{{ $row->property->translations()->where('language_id', $lang->id)->first()->name }}
                                </td>

                                <!-- travel_dates -->
                                <td>{{ $row->arrival_date }} - {{ $row->departure_date }}<br>{{ $row->nights }}
                                    {{ __('Nights') }}
                                </td>

                                <!-- nightly_rate -->
                                <td>{{ priceFormat($row->price_per_night) }}</td>

                                <!-- total_stay -->
                                <td>{{ priceFormat($row->total) }}</td>

                                <!-- register_by -->
                                <td>
                                    {{ $row->register_by }}
                                </td>

                                <!-- created/updated cols -->
                                @include('components.table.created-updated', [
                                'created_at' => $row->created_at,
                                'updated_at' => $row->updated_at,
                                'trimTime' => true,
                                ])

                                <!-- actions -->
                                <td>
                                    @if ($row->property->users->isNotEmpty())
                                        @php
                                            $propertyUser = false;
                                        @endphp

                                        @foreach ($row->property->users as $user)
                                            @if ($user->id == \UserHelper::getCurrentUserID())
                                                @php
                                                    $propertyUser = true;
                                                @endphp
                                            @endif
                                        @endforeach

                                        @if ($propertyUser || isRole('super') || isRole('admin'))
                                            @include('components.table.actions-bookings', [
                                            'params' => [$row->id],
                                            'paymentsRoute' => 'property-booking-payments',
                                            'showRoute' => 'property-bookings.show',
                                            'editRoute' => 'property-bookings.edit',
                                            'deleteRoute' => 'property-bookings.destroy',
                                            ])
                                        @endif
                                    @else
                                        @if ($row->property->user->id == \UserHelper::getCurrentUserID() || isRole('super') || isRole('admin'))
                                            @include('components.table.actions-bookings', [
                                            'params' => [$row->id],
                                            'paymentsRoute' => 'property-booking-payments',
                                            'showRoute' => 'property-bookings.show',
                                            'editRoute' => 'property-bookings.edit',
                                            'deleteRoute' => 'property-bookings.destroy',
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

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
