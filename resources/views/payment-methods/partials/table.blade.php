<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

@if (count($rows))
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>

                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">{{ __('Icon') }}</th>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col">{{ __('Description') }}</th>
                    <th scope="col">&nbsp;</th>
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

                            <!-- payment method id -->
                            <th scope="row">
                                {{ $row->paymentMethod->id }}
                            </th>

                            <!-- payment method icon -->
                            <td>
                                {{ $row->paymentMethod->icon }}
                            </td>

                            <!-- payment method title -->
                            <td>
                                {{ $row->title }}
                            </td>

                            <!-- payment method description -->
                            <td>
                                {!! $row->description !!}
                            </td>

                            <td>
                                <!-- payment method view -->
                                <a href="{{ route('payment-methods.show', [$row->paymentMethod->id]) }}"
                                    class="text-primary app-icon-link" title="{{ __('View') }}"
                                    alt="{{ __('View') }}">
                                    <i class="nav-icon i-Eye font-weight-bold"></i>
                                </a>

                            </td>

                            <!-- actions -->
                            <td>
                                @include('components.table.actions', [
                                'params' => [$row->paymentMethod->id],
                                'showRoute' => 'payment-methods.show',
                                'editRoute' => 'payment-methods.edit',
                                'deleteRoute' => 'payment-methods.destroy',
                                'skipShow' => true,
                                'skipEdit' => isRole('owner'),
                                'skipDelete' => isRole('owner'),
                                ])
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
@else
    {{ __('No payment methods found.') }}
@endif

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
