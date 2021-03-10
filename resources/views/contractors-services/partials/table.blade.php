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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Price') }}</th>
                        <th scope="col">{{ __('Previous Price') }}</th>
                        <th scope="col">{{ __('Contractor') }}</th>
                        <th scope="col">&nbsp;</th>
                    </tr>

                </thead>
                <tbody>

                    @if(count($rows))
                        @foreach($rows as $i => $row)
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $i+1 }}
                                </th>

                                <!-- id -->
                                <th scope="row">
                                    {{ $row->contractorService->id }}
                                </th>

                                <!-- name -->
                                <td>{{ $row->name }}</td>

                                <!-- price -->
                                <td>
                                    {{ priceFormat($row->contractorService->base_price) }}
                                </td>

                                <!-- previous price -->
                                <td>
                                    @if ($row->contractorService->previous_base_price)
                                        {{ priceFormat($row->contractorService->previous_base_price) }}
                                    @endif
                                </td>

                                <!-- previous price -->
                                <td>
                                    @php 
                                        $contractorID= $row->contractorService->contractor->id;
                                        $contractorName = $row->contractorService->contractor->company;
                                    @endphp

                                    <a href="{{ route('contractors.show', [$contractorID]) }}">
                                        {{ ($contractorName) }}
                                    </a>
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->contractorService->id],
                                        'showRoute' => 'contractors-services.show',
                                        'editRoute' => 'contractors-services.edit',
                                        'deleteRoute' => 'contractors-services.destroy',
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
