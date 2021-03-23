@php
    $url = isset($url) ? $url : '';
    $textSearched = isset($_GET['s']) ? $_GET['s'] : '';
    $searchedCity = isset($_GET['city']) ? $_GET['city'] : '';
@endphp

<form action="" action="get">
    <div class="row pt-3">
        <div class="col-md-6">
            <input 
                class="form-control" 
                placeholder="{{ __('Search...') }}" 
                type="text" 
                name="s" 
                value="{{ $textSearched }}"/>
        </div>
        <div class="col-sm-6 col-md-2">
            <select name="city" class="form-control">
                <option value="">-- {{ __('City') }}</option>

                @if($cities)
                    @foreach($cities as $city)
                        @php 
                            $selected = $searchedCity == $city->id ? 'selected' : ''; 
                        @endphp

                        <option value="{{ $city->id }}" {{ $selected }}>
                            {{ $city->name }}
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
