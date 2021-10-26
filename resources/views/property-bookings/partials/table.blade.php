@php
    $lang = LanguageHelper::current();
@endphp

<div class="mb-5"></div>

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
                <th scope="col">{{ __('Damage Deposit') }}</th>
                <th scope="col">{{ __('Subtotal') }}</th>
                <th scope="col">{{ __('Total') }}</th>
                <th scope="col">{{ __('Paid') }}</th>
                <th scope="col">{{ __('Balance due') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Register By') }}</th>
                <th scope="col">{{ __('Created') }}</th>
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
                        <td>
                            @if($row->arrival_date)
                                {{ getReadableDate($row->arrival_date) }} <br> 
                            @else
                                {{ $row->arrival_date }}<br>
                            @endif

                            @if($row->departure_date)
                                {{ getReadableDate($row->departure_date) }} <br> 
                            @else
                                {{ $row->departure_date }}<br>
                            @endif
                            {{ $row->nights }} {{ __('Nights') }}
                        </td>

                        <!-- nightly_rate -->
                        <td>{{ priceFormat($row->price_per_night) }}</td>

                        <!-- damage_deposits -->
                        <td>{{ priceFormat($row->subtotal_damage_deposit) }}</td>

                        <!-- subtotal -->
                        <td>{{ priceFormat($row->total) }}</td>

                        <!-- total_stay -->
                        <td>{{ priceFormat($row->total + $row->subtotal_damage_deposit) }}</td>

                        {{-- paid --}}
                        <td>
                            @php $paid = 0; @endphp
                            @if($row->payments()->where('is_paid', 1)->count())
                                @foreach($row->payments()->where('is_paid', 1)->get() as $payment)
                                    @php $paid += $payment->amount; @endphp
                                @endforeach
                            @endif

                            {{ priceFormat($paid, 2) }}
                        </td>

                        {{-- balance due  --}}
                        <td>
                            @php
                                $balanceDue = $row->total + $row->subtotal_damage_deposit - $paid;
                            @endphp

                            <span style="<?=($balanceDue > 0) ? 'color:red' : '';?>">
                                {{ priceFormat($row->total + $row->subtotal_damage_deposit - $paid) }}
                            </span>
                        </td>

                        <td class="uppercase bold">{{ getBookingStatus($row, App::getLocale()) }}</td>

                        <!-- register_by -->
                        <td>
                            {{ __($row->register_by) }}
                        </td>

                        <!-- created/updated cols -->
                        @include('components.table.created-updated', [
                        'created_at' => getReadableDate($row->created_at, '', true),
                        // 'updated_at' => $row->updated_at,
                        'trimTime' => true,
                        ])

                        <!-- actions -->
                        <td>
                            @php
                                $skipDelete = false;
                                $skipEdit = false;

                                if(isRole('owner')) {
                                    if($row->register_by != 'Owner') {
                                        $skipEdit = true;
                                    }
                                }else if(!can('edit', 'property-bookings')) {
                                    $skipEdit = true;
                                }

                                if(!can('delete', 'property-bookings')) {
                                    $skipDelete = true;
                                }
                            @endphp

                            @include('components.table.actions-bookings', [
                                'params' => [$row->id],
                                'paymentsRoute' => 'property-booking-payments',
                                'showRoute' => 'property-bookings.show',
                                'editRoute' => 'property-bookings.edit',
                                'deleteRoute' => 'property-bookings.destroy',
                                'skipDelete' => $skipDelete,
                                'skipEdit' => $skipEdit,
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
