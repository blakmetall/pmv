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
                            <th scope="col">{{ __('Image') }}</th>
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

                                    <!-- lgbt id -->
                                    <th scope="row">
                                        {{ $row->lgbt->id }}
                                    </th>

                                    <!-- lgbt image -->
                                    <td>
                                        @include('components.table.file-modal', [
                                        'fileName' => $row->lgbt->file_original_name,
                                        'filePath' => $row->lgbt->file_path,
                                        'fileUrl' => $row->lgbt->file_url,
                                        'fileSlug' => $row->lgbt->file_slug,
                                        'imgUrl' => $row->lgbt->file_url,
                                        'imgSize' => 'small-ls',
                                        ])
                                    </td>

                                    <!-- lgbt title -->
                                    <td>
                                        {{ $row->title }}
                                    </td>

                                    <td>
                                        <!-- lgbt view -->
                                        <a href="{{ route('lgbts.show', [$row->lgbt->id]) }}"
                                            class="text-primary app-icon-link" title="{{ __('View') }}"
                                            alt="{{ __('View') }}">
                                            <i class="nav-icon i-Eye font-weight-bold"></i>
                                        </a>

                                    </td>

                                    <!-- actions -->
                                    <td>
                                        @include('components.table.actions', [
                                        'params' => [$row->lgbt->id],
                                        'showRoute' => 'lgbts.show',
                                        'editRoute' => 'lgbts.edit',
                                        'deleteRoute' => 'lgbts.destroy',
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
            {{ __('No lgbts found.') }}
        @endif

        <!-- pagination is loeaded here -->
        @include('partials.pagination', ['rows' => $rows])

    </div>
</div>
