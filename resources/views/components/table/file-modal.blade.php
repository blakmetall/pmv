<?php
    $fileName = isset($fileName) ? $fileName : '';
    $filePath = isset($filePath) ? $filePath : false;
    $fileUrl = isset($fileUrl) ? $fileUrl : false;
    $fileSlug = isset($fileSlug) ? $fileSlug : false;
    $imgUrl = isset($imgUrl) ? $imgUrl : false;
    $imgSize = isset($imgSize) ? $imgSize : '';

    $fileDeleteUrl = isset($fileDeleteUrl) ? $fileDeleteUrl : false;
    $routeParams = isset($routeParams) ? $routeParams : false;

    if ($fileSlug) {
        $modalID = 'table-modal-' . $fileSlug . rand(1, 999999999);
    } else {
        $modalID = 'table-modal-' . rand(1, 999999999);
    }

    $useImg = !!$imgUrl;
?>

<!-- table image or icon -->
<a <?= $fileUrl !== false ? 'href="#"' : '' ?> class="d-inline-block text-primary app-icon-link ml-0 mr-1" title="{{ __('File') }}" alt="{{ __('File') }}" data-toggle="modal" data-target="#{{ $modalID }}">
    @if ($fileUrl !== false)
        <img src="/images/search-on.gif" alt="" style="width: 15px;">
    @else
        <img src="/images/search-off.gif" alt="" style="width: 15px;">
    @endif
</a>

<?php if ($fileUrl !== false): ?>

    <!-- file modal -->
    <div class="modal fade" id="{{ $modalID }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog app-table-file-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    @if ($fileName !== '')
                        <h5 class="modal-title" id="{{ $modalID }}">
                            {{ $fileName }}
                        </h5>
                    @endif

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($fileUrl)
                        <img src="{{ asset(getUrlPath($fileUrl)) }}" alt="" class="w-100">
                    @endif
                </div>
                <div class="modal-footer">

                    @if (!isRole('owner'))
                        @if ($fileDeleteUrl && $routeParams)
                            <form action="{{ route($fileDeleteUrl, $routeParams) }}">
                                <button type="submit" class="btn btn-danger m-1">Delete</button>
                            </form>
                        @endif
                    @endif
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('Close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
