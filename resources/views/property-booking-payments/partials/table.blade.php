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
                        <th scope="col">{{ __('Transaction Source') }}</th>
                        <th scope="col">{{ __('Amount') }}</th>
                        <th scope="col">{{ __('Exchange Rate') }}</th>
                        <th scope="col">{{ __('Damage Insurance') }}</th>
                        <th scope="col">{{ __('Comission') }}</th>
                        <th scope="col">{{ __('Bank Fees') }}</th>
                        <th scope="col">{{ __('Net Comission') }}</th>
                        <th scope="col">{{ __('Paid') }}</th>
                        <th scope="col">{{ __('Post Date') }}</th>
                        <th scope="col">&nbsp;</th>
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

                                <!-- transaction_source_id -->
                                <td>
                                    @if ($row->transactionSource->hasTranslation())
                                        {{ $row->transactionSource->translate()->name }}
                                    @endif
                                </td>

                                <!-- amount -->
                                <td>
                                    {{ $row->amount }}
                                </td>

                                <!-- exchange_rate -->
                                <td>
                                    {{ $row->exchange_rate }}
                                </td>

                                <!-- damage_insurance -->
                                <td>
                                    {{ $row->damage_insurance }}
                                </td>

                                <!-- comission -->
                                <td>
                                    {{ $row->comission }}
                                </td>

                                <!-- bank_fees -->
                                <td>
                                    {{ $row->bank_fees }}
                                </td>

                                <!-- net_comission -->
                                <td>
                                    {{ $row->net_comission }}
                                </td>

                                <!-- is_paid -->
                                <td>
                                    {!! getStatusIcon($row->is_paid) !!}
                                </td>

                                <!-- post_date -->
                                <td>
                                    {{ $row->post_date }}
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->id],
                                        'showRoute' => 'property-booking-payments.show',
                                        'editRoute' => 'property-booking-payments.edit',
                                        'deleteRoute' => 'property-booking-payments.destroy',
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
