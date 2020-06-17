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
                        <th scope="col">&nbsp;</th>
                        <th scope="col">{{ __('Property') }}</th>
                        <th scope="col">&nbsp;</th>
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

                                <!-- thumbnail -->
                                <th>
                                    <a href="{{ asset(getUrlPath($row->file_url)) }}" target="_blank">
                                        <img src="{{ asset(getUrlPath($row->file_url, 'small-ls')) }}" alt="" width="100">
                                    </a>
                                </th>

                                <!-- property -->
                                <td>
                                    @if ($row->property->hasTranslation())
                                        <a href="{{ route('properties.show', [$row->property->id]) }}">
                                            {{ $row->property->translate()->name }}
                                        </a>
                                    @endif
                                </td>

                                <!-- property -->
                                <td>
                                    <a href="{{ route('property-images.order-up', [$row->property->id, $row->id]) }}">
                                        <i class="nav-icon i-Up font-weight-bold"></i>
                                    </a>
                                    <a href="{{ route('property-images.order-down', [$row->property->id, $row->id]) }}">
                                        <i class="nav-icon i-Down font-weight-bold"></i>
                                    </a>
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                        'params' => [$row->property->id, $row->id],
                                        'showRoute' => 'property-images.show',
                                        'editRoute' => 'property-images.edit',
                                        'deleteRoute' => 'property-images.destroy',
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