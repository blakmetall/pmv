
@if (isset($cleaning_service))
    @php $cleaning_staff = $cleaning_service->cleaningStaff; @endphp

    @if($cleaning_service->cleaningStaff()->count())

        <div class="card mb-4">
            <div class="card-body">
                <div class="text-left">
                    <h4 class="mb-3">{{ __('Assigned cleaning staff') }}</h4>

                    @foreach($cleaning_staff as $item)
                        <div>- {{ $item->firstname . ' ' . $item->lastname }}</div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif
@endif