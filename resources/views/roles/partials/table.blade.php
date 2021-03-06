<div class="mb-5"></div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])

<div class="table-responsive">
    <table class="table table-striped">
        <thead>

            <tr>
                <th scope="col">{{ __('Role') }}</th>
                <th scope="col">{{ __('Users') }}</th>
                {{-- <th scope="col">{{ __('Permissions') }}</th> --}}
            </tr>

        </thead>
        <tbody>

            @if(count($rows))
                @foreach($rows as $row)
                    <tr>

                        <!-- name -->
                        <td>{{ $row->name }}</td>

                        <!-- actions -->
                        <td>
                            <a href="javascript:;">
                                {{ $row->role->users()->count() }}
                            </a>
                        </td>

                        <!-- roles permissions -->
                        <?php /*<td>
                            @if(isset($rolesAllowedSections[$row->role->id]))
                                @foreach($rolesAllowedSections[$row->role->id] as $roleSection)
                                    {{ $roleSection }} <br>
                                @endforeach
                            @else
                                --
                            @endif
                        </td>*/ ?>
                    </tr>
                @endforeach
            @endif

        </tbody>
    </table>
</div>

<!-- pagination is loeaded here -->
@include('partials.pagination', ['rows' => $rows])
