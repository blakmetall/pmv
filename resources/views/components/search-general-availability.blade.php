<div class="container app-container mb-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ $url }}" action="get">

                <div class="row row-xs">
                    <!-- from_date -->
                    <div class="col-md-3 select-filter">
                        <label for="from_date">
                            {{ __('Date') }}*
                        </label>
                        <input id="from_date" type="date" name="from_date" value="{{ $fromDate }}" class="form-control" required>
                    </div>

                    <!-- location -->
                    <div class="col-md-2 select-filter">
                        <label for="location">
                            {{ __('Location') }}
                        </label>
                        <select name="location" class="form-control">
                            <option value="">{{ __('Select') }}</option>
                            @if($locations)
                                @foreach($locations as $location)
                                    @php
                                        $selected = $searchedLocation == $location->id ? 'selected' : '';
                                    @endphp

                                    <option value="{{ $location->id }}" {{ $selected }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- beds -->
                    <div class="col-md-1 select-filter">
                        <label for="beds">
                            {{ __('Bedrooms') }}
                        </label>
                        <input id="beds" type="number" step="0.01" name="beds" value="{{ $beds }}" class="form-control">
                    </div>

                    <!-- baths -->
                    <div class="col-md-1 select-filter">
                        <label for="baths">
                            {{ __('Baths') }}
                        </label>
                        <input id="baths" type="number" step="0.01" name="baths" value="{{ $baths }}" class="form-control">
                    </div>

                    <!-- pax -->
                    <div class="col-md-1 select-filter">
                        <label for="pax">
                            {{ __('Pax') }}
                        </label>
                        <input id="pax" type="number" name="pax" value="{{ $pax }}" class="form-control">
                    </div>

                    <!-- managed -->
                    <div class="col-md-2 select-filter">
                        <label for="managed">
                            {{ __('Managed') }}
                        </label>
                        <select name="managed" class="form-control">
                            <option value="">{{ __('Select') }}</option>
                            <option value="1" {{ ($selectedManaged == 1)?'selected':'' }}>{{ __('YES') }}</option>
                            <option value="2" {{ ($selectedManaged == 2)?'selected':'' }}>{{ __('NO') }}</option>
                        </select>
                    </div>

                    <div class="col-md-2 app-search-buttons">
                        <div style="display: block; margin-bottom: 7px">
                            &nbsp;
                        </div>
                        <button class="btn btn-dark btn-icon mr-2" type="submit">
                            <span class="ul-btn__icon">
                                <i class="i-Magnifi-Glass1"></i>
                            </span>
                        </button>
                        @if(isset($_GET['location']))
                            <a href="{{ $url }}" class="btn btn-outline-dark btn-icon" role="button">
                                <span class="ul-btn__icon">
                                    <i class="i-Restore-Window"></i>
                                </span>
                            </a>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>