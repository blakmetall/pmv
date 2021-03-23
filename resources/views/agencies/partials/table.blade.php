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

                            <!-- agency id -->
                            <th scope="row">
                                {{ $row->agency->id }}
                            </th>

                            <!-- agency image -->
                            <td>
                                @include('components.table.file-modal', [
                                'fileName' => $row->agency->file_original_name,
                                'filePath' => $row->agency->file_path,
                                'fileUrl' => $row->agency->file_url,
                                'fileSlug' => $row->agency->file_slug,
                                'imgUrl' => $row->agency->file_url,
                                'imgSize' => 'small-ls',
                                ])
                            </td>

                            <!-- agency title -->
                            <td>
                                {{ $row->title }}
                            </td>

                            <td>
                                <!-- agency view -->
                                <a href="{{ route('agencies.show', [$row->agency->id]) }}"
                                    class="text-primary app-icon-link" title="{{ __('View') }}"
                                    alt="{{ __('View') }}">
                                    <i class="nav-icon i-Eye font-weight-bold"></i>
                                </a>

                            </td>

                            <!-- actions -->
                            <td>
                                @include('components.table.actions', [
                                'params' => [$row->agency->id],
                                'showRoute' => 'agencies.show',
                                'editRoute' => 'agencies.edit',
                                'deleteRoute' => 'agencies.destroy',
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
    {{ __('No agencys found.') }}
@endif

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
