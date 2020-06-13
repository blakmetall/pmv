<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Avg. Month') }}</th>
                        <th scope="col">{{ __('Balance') }}</th>
                        <th scope="col">{{ __('Pending Audits') }}</th>
                        <th scope="col">{{ __('Estimated Balance') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($pm_items))
                        @foreach($pm_items as $pm)
                            <tr>
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
                        @endforeach
                    @endif
                    
                    <tr><th colspan="5">&nbsp;</th></tr>

                    <tr>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">&nbsp;</th>
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

    </div>
</div>
