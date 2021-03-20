@php
    $label = isset($label) ? $label : '';
@endphp
<div class="card">
    <div class="card-body app-form-fields-container">

        @if ($label)
            <span class="badge badge-primary r-badge mb-4">{{ $label }}</span>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col"></th>
                        <th scope="col">{{ __('Date') }}</th>
                        <th scope="col">{{ __('Transaction') }}</th>
                        <th scope="col">{{ __('Amount') }}</th>
                    </tr>

                </thead>
                <tbody>

                        @foreach($transactions as $index => $transaction)
                            <tr>
                                <!-- index -->
                                <th scope="row">
                                    {{ $index+1 }}
                                </th>

                                <!-- id -->
                                <th scope="row">
                                    {{ $transaction->id }}
                                </th>

                                <!-- file -->
                                <td>
                                    @include('components.table.file-modal', [
                                        'fileName' => $transaction->file_original_name,
                                        'filePath' => $transaction->file_path,
                                        'fileUrl' => $transaction->file_url,
                                        'fileSlug' => $transaction->file_slug,
                                    ])
                                </td>

                                <!-- post_date -->
                                <td>
                                    <div class="app-td-date">
                                        {{ $transaction->post_date }}
                                    </div>
                                </td>

                                <!-- transaction_type_id -->
                                <td>
                                    @if($transaction->type)
                                        {{ $transaction->type->translate()->name }}
                                    @endif

                                    @if($transaction->description)
                                        <p class="app-pm-description">{!! nl2br($transaction->description) !!}</p>
                                    @endif
                                </td>

                                <!-- credit -->
                                <td>
                                    {{ priceFormat($transaction->amount) }}
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>
