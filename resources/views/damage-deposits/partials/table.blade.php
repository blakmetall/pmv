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
                        <th scope="col">{{ __('Actions') }}</th>
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
                                    ${{ number_format($row->damageDeposit->price, 2) }}
                                </td>

                                <!-- is_refundable -->
                                <td>
                                    @if($row->damageDeposit->is_refundable)
                                        <i class="nav-icon i-Yes font-weight-bold text-success"></i>
                                    @else 
                                        <i class="nav-icon i-Close font-weight-bold text-danger"></i>
                                    @endif
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
