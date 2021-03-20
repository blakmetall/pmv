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
                        <th scope="col">{{ __('Voucher') }}</th>
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

                                <!-- voucher -->
                                <td>
                                    @if ($row->file_url)
                                        @include('components.table.file-modal', [
                                        'fileName' => '',
                                        'filePath' => '',
                                        'fileUrl' => $row->file_url,
                                        'fileSlug' => 'payment'.$row->id,
                                        ])
                                    @endif
                                </td>

                                <!-- transaction_source_id -->
                                <td>
                                    @if ($row->transactionSource->hasTranslation())
                                        {{ $row->transactionSource->translate()->name }}
                                    @endif
                                </td>

                                <!-- amount -->
                                <td>
                                    {{ priceFormat($row->amount) }}
                                </td>

                                <!-- exchange_rate -->
                                <td>
                                    {{ priceFormat($row->exchange_rate) }}
                                </td>

                                <!-- damage_insurance -->
                                <td>
                                    {{ priceFormat($row->damage_insurance) }}
                                </td>

                                <!-- comission -->
                                <td>
                                    {{ priceFormat($row->comission) }}
                                </td>

                                <!-- bank_fees -->
                                <td>
                                    {{ priceFormat($row->bank_fees) }}
                                </td>

                                <!-- net_comission -->
                                <td>
                                    {{ priceFormat($row->net_comission) }}
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
