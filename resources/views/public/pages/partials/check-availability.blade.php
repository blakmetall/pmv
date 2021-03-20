@php
$propertyTypes = getPropertyTypes();
$cities = getCities();
$getPropertyType = isset($_GET['property_type']) ? $_GET['property_type'] : '';
$getCity = isset($_GET['city']) ? $_GET['city'] : '';
$getZone = isset($_GET['zone']) ? $_GET['zone'] : 0;
$getAdults = isset($_GET['adults']) ? $_GET['adults'] : '';
$getChilds = isset($_GET['children']) ? $_GET['children'] : '';
$getBeds = isset($_GET['bedrooms']) ? $_GET['bedrooms'] : '';
$isHome = Request::is('/');
$arrival = isset($_GET['arrival']) ? $_GET['arrival'] : null;
$departure = isset($_GET['departure']) ? $_GET['departure'] : null;
$dates = getSearchDate(false, $arrival, $departure);
$datesInitial = getSearchDate(true, $arrival, $departure);
@endphp
<form action="{{ route('public.availability-results') }}" id="avail-search-form" accept-charset="UTF-8">
    <input type="hidden" value="{{ $isHome }}" name="is_home">
    <div>
        <table>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-ptype form-type-select form-group">
                        <div class="field-title"><span>01.</span> {{ __('What?') }}</div>
                        <select class="form-control form-select" name="property_type">
                            <option value="">{{ __('Any Type...') }}</option>
                            @foreach ($propertyTypes as $propertyType)
                                <option value="{{ $propertyType->property_type_id }}"
                                    {{ $propertyType->property_type_id == $getPropertyType ? 'selected' : '' }}>
                                    {{ $propertyType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-city form-type-select form-group">
                        <div class="field-title"><span>02.</span> {{ __('Where?') }}</div>
                        <select class="form-control form-select" id="edit-city" name="city"
                            data-txt-select="{{ __('Any Location') }}">
                            <option value="">{{ __('City') }}</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id == $getCity ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-arrival form-type-textfield form-group">
                        <div class="field-title"><span>03.</span> {{ __('When?') }}</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input class="text-center form-control form-text" readonly="readonly"
                                placeholder="{{ __('Check in date') }}" type="text" id="edit-arrival"
                                value="{{ $dates['currentDate'] }}" size="60" maxlength="128" />
                        </div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-adults form-type-textfield form-group">
                        <div class="field-title"><span>04.</span> {{ __('Who?') }}</div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                            <input placeholder="{{ __('Adults') }}" title="{{ __('Adults') }}"
                                class="form-control form-text" type="text" name="adults" size="60" maxlength="128"
                                value="{{ $getAdults }}" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-bedrooms form-type-textfield form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bed"></i></span>
                            <input placeholder="{{ __('Bedrooms') }}" title="{{ __('Bedrooms') }}"
                                class="form-control form-text" type="text" name="bedrooms" size="60" maxlength="128"
                                value="{{ $getBeds }}" />
                        </div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-location form-type-select form-group">
                        <select class="form-control form-select" name="zone" id="zone" style="display: none"
                            data-zone="{{ $getZone }}">
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-departure form-type-textfield form-group">
                        <div class="input-group"><span class="input-group-addon"><span
                                    class="glyphicon glyphicon-calendar"></span></span><input
                                class="text-center form-control form-text" readonly="readonly"
                                placeholder="{{ __('Check out date') }}" type="text" id="edit-departure"
                                value="{{ $dates['nextDate'] }}" size="60" maxlength="128" /></div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-children form-type-textfield form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-child"></i></span>
                            <input placeholder="{{ __('Children') }}" title="{{ __('Children') }}"
                                class="form-control form-text" type="text" name="children" size="60" maxlength="128"
                                value="{{ $getChilds }}" />
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <fieldset class="collapsible panel panel-default form-wrapper" id="edit-advance-search">
            <legend class="panel-heading">
                <a href="#edit-advance-search-body" class="panel-title fieldset-legend collapsed"
                    data-toggle="collapse">{{ __('More Filters') }}</a>
            </legend>
            <div class="panel-body panel-collapse collapse fade collapsed" id="edit-advance-search-body">
                <table width="100%">
                    <tr>
                        <td class="col-xs-4">
                            <div class="form-item form-item-pet-friendly form-type-checkbox checkbox">
                                <label class="control-label" for="pet_friendly">
                                    <input type="checkbox" id="pet_friendly" name="pet_friendly"
                                        class="form-checkbox" />{{ __('PetFriendly') }}
                                </label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-adults-only form-type-checkbox checkbox">
                                <label class="control-label" for="adults_only">
                                    <input type="checkbox" id="adults_only" name="adults_only"
                                        class="form-checkbox" />{{ __('Adults Only') }}
                                </label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-beach-front form-type-checkbox checkbox">
                                <label class="control-label" for="beach_front">
                                    <input type="checkbox" id="beach_front" name="beach_front"
                                        class="form-checkbox" />{{ __('Beach / Water front') }}
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
        <input id="arrival-alt" type="hidden" name="arrival" value="{{ $datesInitial['currentDate'] }}" />
        <input id="departure-alt" type="hidden" name="departure" value="{{ $datesInitial['nextDate'] }}" />
        <div class="form-actions form-wrapper form-group" id="edit-actions--2">
            <button title="{{ __('Check Availability') }}" class="btn btn-success btn-loading form-submit"
                data-loading-text="&lt;i class=&quot;fa fa-spinner fa-spin&quot;&gt;&lt;/i&gt; ... loading"
                type="submit" value="{{ __('Check Availability') }}">{{ __('Check Availability') }}</button>
        </div>
    </div>
</form>
