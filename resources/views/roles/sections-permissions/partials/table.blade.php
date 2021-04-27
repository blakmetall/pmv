<form action="{{ route('roles.sections-permissions.save') }}" method="post">
    @csrf

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">{{ __('Sections') }}</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($sections as $sectionSlug => $sectionName)
                    <tr>
                        <!-- name -->
                        <td>@lang($sectionName)</td>

                        <!-- sections -->
                        <td>
                            <!-- enable permission checkbox -->
                            @include('components.form.checkbox', [
                                'group' => 'sections-permissions',
                                'label' => __('Habilitar'),
                                'name' => $sectionSlug,
                                'value' => 1,
                                'default' => 0,
                            ])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="cancel" class="btn btn-secondary mr-2">
            {{ __('Return') }}
        </button>

        <button type="submit" class="btn btn-primary">
            {{ __('Save') }}
        </button>
    </div>
</form>