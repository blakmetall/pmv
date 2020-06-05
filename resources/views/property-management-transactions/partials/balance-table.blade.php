<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }}</div>
    <div class="card-body pt-5">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">{{ __('Credit') }}</th>
                        <th scope="col">{{ __('Charge') }}</th>
                        <th scope="col">{{ __('Pending Audits') }}</th>
                        <th scope="col">{{ __('Subtotal') }}</th>
                    </tr>

                </thead>
                <tbody>

                    <tr>

                        <!-- credit -->
                        <td>{{ priceFormat($balance['totalCredit']) }}</td>

                        <!-- charge -->
                        <td>{{ priceFormat($balance['totalCharge']) }}</td>

                        <!-- pending audits -->
                        <td>{{ priceFormat($balance['pendingAuditsSubtotal']) }}</td>

                        <!-- subtotal -->
                        <td>{{ priceFormat($balance['subtotal']) }}</td>

                    </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>
