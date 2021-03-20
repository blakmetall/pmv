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
                        <th scope="col">{{ __('Name') }}</th>
                        <th scope="col">{{ __('Description') }}</th>
                        <th scope="col">{{ __('Properties') }}</th>
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

                                <!-- name -->
                                <td>{{ $row->name }} </td>

                                <!-- description -->
                                <td>{{ $row->description }} </td>

                                <!-- properties -->
                                <td>
                                    @foreach ($row->properties as $property)
                                        <a
                                            href="{{ route('properties.show', $property->id) }}">{{ $property->translate()->name }}</a>
                                    @endforeach
                                </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                    'params' => [$row->id],
                                    'showRoute' => 'buildings.show',
                                    'editRoute' => 'buildings.edit',
                                    'deleteRoute' => 'buildings.destroy',
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
