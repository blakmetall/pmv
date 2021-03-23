<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col">&nbsp;</th>
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
                            {{ $row->id }}
                        </th>

                        <!-- thumbnail -->
                        <th>
                            @include('components.table.file-modal', [
                                'fileName' => $row->file_original_name,
                                'filePath' => $row->file_path,
                                'fileUrl' => $row->file_url,
                                'fileSlug' => $row->file_slug,
                                'imgUrl' => $row->file_url,
                                'imgSize' => 'small-ls'
                            ])
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
