

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">{{ __('Sections') }}</th>
                <th scope="col">&nbsp;</th>
            </tr>
        </thead>
        
        <tbody>

            @if(count($rows))
                @foreach($rows as $row)
                    <tr>

                        <!-- name -->
                        <td>Sections name</td>

                        <!-- sections -->
                        <td>
                            -- check button
                        </td>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>

    <button type="submit" class="btn btn-secondary mr-2">
        {{ __('Return') }}
    </button>

    <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
    </button>
</div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
