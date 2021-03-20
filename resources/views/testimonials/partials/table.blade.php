<div class="mb-5"></div>
<div class="card">
    <div class="card-header">{{ $label }} </div>
    <div class="card-body">

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

                                    <!-- testimonial id -->
                                    <th scope="row">
                                        {{ $row->testimonial->id }}
                                    </th>

                                    <!-- testimonial title -->
                                    <td>
                                        {{ $row->title }}
                                    </td>

                                    <td>
                                        <!-- testimonial view -->
                                        <a href="{{ route('testimonials.show', [$row->testimonial->id]) }}"
                                            class="text-primary app-icon-link" title="{{ __('View') }}"
                                            alt="{{ __('View') }}">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>

                                    </td>

                                    <!-- actions -->
                                    <td>
                                        @include('components.table.actions', [
                                        'params' => [$row->testimonial->id],
                                        'showRoute' => 'testimonials.show',
                                        'editRoute' => 'testimonials.edit',
                                        'deleteRoute' => 'testimonials.destroy',
                                        'skipShow' => true,
                                        'skipEdit' => isRole('owner'),
                                        'skipDelete' => isRole('owner')
                                        ])
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>
            </div>
        @else
            {{ __('No testimonials found.') }}
        @endif

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
