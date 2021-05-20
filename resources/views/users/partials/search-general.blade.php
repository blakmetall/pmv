@php
    $url = isset($url) ? $url : '';
    $textSearched = isset($_GET['s']) ? $_GET['s'] : '';
    $searchedRole = isset($_GET['role']) ? $_GET['role'] : '';

@endphp

<form action="" action="get">
    <div class="row pt-3 mb-4">
        <div class="col-md-6">
            <input 
                class="form-control" 
                placeholder="{{ __('Search...') }}" 
                type="text" 
                name="s" 
                value="{{ $textSearched }}"/>
        </div>
        <div class="col-sm-6 col-md-2">
            <select name="role" class="form-control">
                <option value="">-- {{ __('Role') }}</option>

                @if($roles)
                    @foreach($roles as $role)
                        @php 
                            $selected = $searchedRole == $role['id'] ? 'selected' : ''; 
                        @endphp

                        <option value="{{ $role['id'] }}" {{ $selected }}>
                            {{ $role['name'] }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-sm-6 col-md-2 app-search-buttons">
            <button class="btn btn-dark btn-icon mr-2" type="submit">
                <span class="ul-btn__icon">
                    <i class="i-Magnifi-Glass1"></i>
                </span>
            </button>

            @if(isset($_GET['s']) || isset($_GET['city']))
                <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                    <span class="ul-btn__icon">
                        <i class="i-Restore-Window"></i>
                    </span>
                </a>
            @endif
        </div>
    </div>

</form>
