
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{ __('Date') }}</th>
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Description') }}</th>
                <th scope="col">{{ __('Amount') }}</th>
                <th scope="col">{{ __('Paid') }}</th>
                <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th scope="col">&nbsp;</th>
            </tr>

        </thead>
        <tbody>
            @if ($booking->payments()->count())
                @foreach ($booking->payments()->orderBy('post_date', 'asc')->get() as $i => $row)
                    <tr>
                        <!-- payment date -->
                        <td>
                            {{ $row->post_date }}
                        </td>

                        <!-- type -->
                        <td>    
                            {{ __('Credit') }}
                        </td>

                        <!-- description -->
                        <td>
                            {{ $row->transactionSource->translate()->name }}
                        </td>

                        <!-- amount -->
                        <td>{{ priceFormat($row->amount) }}</td>

                        {{-- paid --}}
                        <td>
                            @if($row->is_paid)
                                {{ __('Yes') }}
                            @else
                                {{ 'No' }}
                            @endif
                        </td>

                        <td>
                            @if(!isRole('owner') && can('edit', 'property-bookings'))
                                <!-- email notification for property management transaction -->
                                <a href="{{ route('property-booking-payments.email', [$row->id]) }}" class="text-primary">
                                    <img src="/images/email.svg" alt="" width="16px" style="width: 16px; position: relative; top: -4px;">
                                </a>
                            @endif
                        </td>
                        
                        <!-- actions -->
                        <td>
                            @include('components.table.actions', [
                                'params' => [$row->id],
                                'editRoute' => 'property-booking-payments.edit',
                                'deleteRoute' => 'property-booking-payments.destroy',
                                'skipShow' => true,
                                'skipEdit' => isRole('owner') || !can('edit', 'property-bookings'),
                                'skipDelete' => isRole('owner') || !can('edit', 'property-bookings'),
                            ])
                        </td>

                    </tr>
                @endforeach 
            @endif

            <!-- payment totals -->
            @php
                $total = $booking->total + $booking->subtotal_damage_deposit;
                $payments = $booking->payments;
                $reduced = 0;

                foreach ($payments as $payment) {
                    if($payment->is_paid) {
                        $reduced += $payment->amount;
                    }
                }

                $balance = $total - $reduced;
            @endphp

            <tr>
                <td colspan="7">&nbsp;</td>
            </tr>

            <tr>
                <td colspan="3" class="text-right">
                    {{ __('Insurance deposit') }} (USD)
                </td>
                <td class="bold">
                    {{ priceFormat($booking->subtotal_damage_deposit) }}
                </td>
                <td colspan="3">&nbsp;</td>
            </tr>

            <!-- total row -->
            <tr>
                <td colspan="3" class="text-right">
                    {{ __('Total Booking') }} (USD) 
                </td>
                <td class="bold">
                    {{ priceFormat($total) }}
                </td>
                <td colspan="3">&nbsp;</td>
            </tr>

            <!-- payments completed row -->
            <tr>
                <td colspan="3" class="text-right">
                    {{ __('Total Payments') }} (USD) 
                </td>
                <td class="bold">
                    {{ priceFormat($reduced) }}
                </td>
                <td colspan="3">&nbsp;</td>
            </tr>

            <!-- total due row -->
            <tr>
                <td colspan="3" class="text-right">
                    {{ __('Total Due') }} (USD) 
                </td>
                <td class="bold">
                    {{ priceFormat($balance) }}
                </td>
                <td colspan="3">&nbsp;</td>
            </tr>

            <tr><td colspan="7"></td></tr>

            <tr>
                <td colspan="3" class="text-right">
                    {{ __('Booking Status') }}
                </td>
                <td class="uppercase bold">
                    {{ getBookingStatus($booking, App::getLocale()) }}
                </td>
                <td colspan="3">&nbsp;</td>
            </tr>

        </tbody>
    </table>
</div>
