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
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Refundable') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $row)
                            <tr>
                                <!-- id -->
                                <th scope="row">
                                    {{ $row->damageDeposit->id }}
                                </th>

                                <!-- price -->
                                <td>
                                    {{ priceFormat($row->damageDeposit->price) }}
                                </td>

                                <!-- is_refundable -->
                                <td>
                                    {!! getStatusIcon($row->damageDeposit->is_refundable) !!}
                                </td>

                                <!-- description -->
                                <td>
                                    {{ $row->description }}
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->damageDeposit->id],
                                        'showRoute' => 'damage-deposits.show',
                                        'editRoute' => 'damage-deposits.edit',
                                        'deleteRoute' => 'damage-deposits.destroy',
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
