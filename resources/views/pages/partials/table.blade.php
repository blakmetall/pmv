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
                    <th scope="col">{{ __('Title') }}</th>
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

                            <!-- id -->
                            <th scope="row">
                                {{ $row->page->id }}
                            </th>

                            <!-- page title -->
                            <td>
                                {{ $row->title }}
                            </td>

                            <td>
                                <!-- page view -->
                                <a href="{{ route('pages.show', [$row->page->id]) }}"
                                    class="text-primary app-icon-link" title="{{ __('View') }}"
                                    alt="{{ __('View') }}">
                                    <i class="nav-icon i-Eye font-weight-bold"></i>
                                </a>

                            </td>

                            <!-- actions -->
                            <td>
                                @include('components.table.actions', [
                                'params' => [$row->page->id],
                                'showRoute' => 'pages.show',
                                'editRoute' => 'pages.edit',
                                'deleteRoute' => 'pages.destroy',
                                'skipShow' => true,
                                'skipEdit' => isRole('owner'),
                                'skipDelete' => true
                                ])
                            </td>

                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
@else
    {{ __('No pages found.') }}
@endif

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
