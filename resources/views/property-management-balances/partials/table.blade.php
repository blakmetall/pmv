<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">{{ __('Credit') }}</th>
                        <th scope="col">{{ __('Charge') }}</th>
                        <th scope="col">{{ __('Pending Audits') }}</th>
                        <th scope="col">{{ __('Subtotal') }}</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($pm_items))
                        @foreach($pm_items as $pm)
                            <tr>
                                <td>
                                    @if ($pm->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$pm->property->id]) }}">
                                            {{ $pm->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- credit -->
                                <td>{{ priceFormat($pm->_balance['totalCredit']) }}</td>

                                <!-- charge -->
                                <td>{{ priceFormat($pm->_balance['totalCharge']) }}</td>

                                <!-- pending audits -->
                                <td>{{ priceFormat($pm->_balance['pendingAuditsSubtotal']) }}</td>

                                <!-- subtotal -->
                                <td>{{ priceFormat($pm->_balance['subtotal']) }}</td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>

    </div>
</div>
