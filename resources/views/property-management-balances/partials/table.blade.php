@php
    $modalID = 'pm-notification-' . strtotime('now') . rand(1, 99999);
@endphp

<a href="#" id="show_finished_balances" data-status="open" data-show-text="<?= __('Show finished') ?>" data-hide-text="<?= __('Hide finished') ?>" class="text-success">
    <?= __('Show finished') ?>
</a>
<div class="ml-3 d-inline">
    <?= __('Properties') ?> - ({{ $total }})
</div>
<div class="ml-3 d-inline">
    <?= __('Active') ?> - ({{ $active }})
</div>
<div class="ml-3 d-inline">
    <?= __('Finished') ?> - ({{ $finished }})
</div>

<div class="mb-2"></div>

@include('property-management-balances.partials.modal-notification')

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col">{{ __('Avg. Month') }}</th>
                <th scope="col">{{ __('Balance') }}</th>
                <th scope="col">{{ __('Pending Audits') }}</th>
                <th scope="col">{{ __('Estimated Balance') }}</th>
            </tr>
        </thead>

        <tbody>
            @if (count($pm_items))
                @php
                    $ipm = 1;
                @endphp

                @foreach ($pm_items as $i => $pm)
                    <tr class="<?= $pm->is_finished ? 'tr-finished-balance' : '' ?>">
                        <!-- index -->
                        <td>
                            {{ $ipm }}
                        </td>

                        <!-- pm ID -->
                        <td>
                            <b>{{ $pm->id }}</b>
                        </td>

                        <!-- balances -->
                        <td>
                            @if (!isRole('owner'))
                                <!-- sent transaction email -->
                                <a href="#" data-toggle="modal" data-source="{{ $pm->id }}" data-target="#{{ $modalID }}"
                                    data-cancel-button="{{ __('Cancel') }}"
                                    data-text-button="{{ __('Send') }}" data-text-custom-msg="{{ __('Additional Msg') }}"
                                    data-route="{{ route('property-management-balances.email', [$pm->id]) }}" class="text-primary mr-2">
                                        <img src="/images/email.svg" alt="" style="width: 17px; position: relative; top: -3px;">
                                </a>
                            @endif

                            <a href="{{ route('property-management-transactions', [$pm->id]) }}" alt="{{ __('Transactions') }}" class="text-primary mr-2">
                                <i class="nav-icon i-Receipt-3 font-weight-bold"></i>
                            </a>
                        </td>

                        <td>
                            @if ($pm->property->hasTranslation())
                                <a href="{{ route('property-management-transactions', [$pm->id]) }}">
                                    {{ $pm->property->translate()->name }}
                                </a>
                            @endif
                        </td>

                        <!-- average_month -->
                        <td>
                            {{ priceFormat($pm->average_month) }}
                        </td>

                        <!-- balance -->
                        <td>
                            @php
                                $isUnderAverage = $pm->average_month > $pm->_balance['balance'];
                                $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                            @endphp

                            <span class="{{ $underAverageClass }}">
                                {{ priceFormat($pm->_balance['balance']) }}
                            </span>
                        </td>

                        <!-- pending audits -->
                        <td>{{ priceFormat($pm->_balance['pendingAudit']) }}</td>

                        <!-- estimated balance -->
                        <td>
                            @php
                                $isUnderAverage = $pm->average_month > $pm->_balance['estimatedBalance'];
                                $underAverageClass = $isUnderAverage ? 'app-price-red' : '';
                            @endphp

                            <span class="{{ $underAverageClass }}">
                                {{ priceFormat($pm->_balance['estimatedBalance']) }}
                            </span>
                        </td>
                    </tr>

                    @php
                        $ipm++;
                    @endphp
                @endforeach
            @endif

            <tr>
                <th colspan="8">&nbsp;</th>
            </tr>

            <tr>
                <th scope="col" colspan="5">&nbsp;</th>
                <th scope="col">
                    {{ priceFormat($totalBalances['balances']) }}
                </th>
                <th scope="col">
                    {{ priceFormat($totalBalances['pendingAudits']) }}
                </th>
                <th scope="col">
                    {{ priceFormat($totalBalances['estimatedBalances']) }}
                </th>
            </tr>
        </tbody>
    </table>
</div>
