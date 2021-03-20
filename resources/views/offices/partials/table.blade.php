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
                        <th scope="col">{{ __('Email') }}</th>
                        <th scope="col">{{ __('Phone') }}</th>
                        <th scope="col">{{ __('Address') }}</th>
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

                                <!-- email -->
                                <td>{{ $row->email }} </td>

                                <!-- phone -->
                                <td>{{ $row->phone }} </td>

                                <!-- address -->
                                <td>{!! $row->address !!} </td>

                                <!-- actions -->
                                <td>
                                    @include('components.table.actions', [
                                    'params' => [$row->id],
                                    'showRoute' => 'offices.show',
                                    'editRoute' => 'offices.edit',
                                    'deleteRoute' => 'offices.destroy',
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
