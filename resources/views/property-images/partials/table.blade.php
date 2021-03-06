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
                <th scope="col">{{ __('Ordering') }}</th>
                <th scope="col">{{ __('Property') }}</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">&nbsp;</th>
                <th scope="col">
                    @if(can('edit', 'property-images'))
                        <input type="checkbox" class="delete-selectable-checkbox" />
                        <a href="{{ route('property-images.destroy-all', [$property->id, '']) }}" 
                            data-tpl-route="{{ route('property-images.destroy-all', [$property->id, '']) }}"
                            class="checkbox-table-delete delete-selectable-action btn btn-danger">
                            {{ __('Delete') }}
                        </a>
                    @endif
                </th>
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
                            <img src="{{ ImagesHelper::getUrlPath($row->file_url, 'small-ls') }}" style="max-width: 140px;"/>
                            
                            &nbsp;&nbsp;

                            @include('components.table.file-modal', [
                                'fileName' => $row->file_original_name,
                                'filePath' => $row->file_path,
                                'fileUrl' => $row->file_url,
                                'fileSlug' => $row->file_slug,
                                'imgUrl' => $row->file_url,
                                'imgSize' => 'small-ls'
                            ])
                        </th>

                        <!-- featured -->
                        <th>
                            @if(can('edit', 'property-images'))
                                <input type="text" value="{{ $i + 1 }}" data-image-id="{{ $row->id }}" class="app-ordering-input" />
                            @endif
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
                            @if(can('edit', 'property-images'))
                                <a href="{{ route('property-images.order-up', [$row->property->id, $row->id]) }}">
                                    <i class="nav-icon i-Up font-weight-bold"></i>
                                </a>
                                <a href="{{ route('property-images.order-down', [$row->property->id, $row->id]) }}">
                                    <i class="nav-icon i-Down font-weight-bold"></i>
                                </a>
                            @endif
                        </td>

                        <!-- actions -->
                        <td>
                            @include('components.table.actions', [
                                'params' => [$row->property->id, $row->id],
                                'showRoute' => 'property-images.show',
                                'editRoute' => 'property-images.edit',
                                'deleteRoute' => 'property-images.destroy',
                                'skipEdit' => !can('edit', 'property-images'),
                                'skipDelete' => !can('edit', 'property-images'),
                            ])
                        </td>

                        <td>
                            @if(can('edit', 'property-images'))
                                <input type="checkbox" value="{{ $row->id }}" class="delete-selectable-option" />
                            @endif
                        </td>

                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
