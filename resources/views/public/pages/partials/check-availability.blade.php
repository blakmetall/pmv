@php
$propertyTypes = getPropertyTypes();
$cities = getCities();
$getPropertyType = (isset($_GET['property_type'])) ? $_GET['property_type'] : '';
$getCity = (isset($_GET['city'])) ? $_GET['city'] : '';
$getZone = (isset($_GET['zone'])) ? $_GET['zone'] : '';
$getAdults = (isset($_GET['adults'])) ? $_GET['adults'] : '';
$getChilds = (isset($_GET['children'])) ? $_GET['children'] : '';
$getBeds = (isset($_GET['bedrooms'])) ? $_GET['bedrooms'] : '';
@endphp
<form action="{{ route('public.availability-results') }}" id="avail-search-form" accept-charset="UTF-8">
    <div>
        <table>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-ptype form-type-select form-group">
                        <div class="field-title"><span>01.</span> What?</div>
                        <select class="form-control form-select" name="property_type">
                            <option value="">Any Type...</option>
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
                        <div class="field-title"><span>02.</span> Where?</div>
                        <select class="form-control form-select" id="edit-city" name="city"
                            data-txt-select="{{ __('Any Location') }}">
                            <option value="">City</option>
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
                        <div class="field-title"><span>03.</span> When?</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                            <input class="text-center form-control form-text" readonly="readonly"
                                placeholder="Check-in-date" type="text" id="edit-arrival"
                                value="Saturday 12/December/2020" size="60" maxlength="128" />
                        </div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-adults form-type-textfield form-group">
                        <div class="field-title"><span>04.</span> Who?</div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                            <input placeholder="Adults" title="Adults" class="form-control form-text" type="text"
                                name="adults" size="60" maxlength="128" value="{{ $getAdults }}" />
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-bedrooms form-type-textfield form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bed"></i></span>
                            <input placeholder="Bedrooms" title="Bedrooms" class="form-control form-text" type="text"
                                name="bedrooms" size="60" maxlength="128" value="{{ $getBeds }}" />
                        </div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-location form-type-select form-group">
                        <select class="form-control form-select" name="zone" id="zone" style="display: none">
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-departure form-type-textfield form-group">
                        <div class="input-group"><span class="input-group-addon"><span
                                    class="glyphicon glyphicon-calendar"></span></span><input
                                class="text-center form-control form-text" readonly="readonly"
                                placeholder="Check-out-date" type="text" id="edit-departure"
                                value="Saturday 19/December/2020" size="60" maxlength="128" /></div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-children form-type-textfield form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-child"></i></span>
                            <input placeholder="Children" title="Children" class="form-control form-text" type="text"
                                name="children" size="60" maxlength="128" value="{{ $getChilds }}" />
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <fieldset class="collapsible panel panel-default form-wrapper" id="edit-advance-search">
            <legend class="panel-heading">
                <a href="#edit-advance-search-body" class="panel-title fieldset-legend collapsed"
                    data-toggle="collapse">More Filters</a>
            </legend>
            <div class="panel-body panel-collapse collapse fade collapsed" id="edit-advance-search-body">
                <table width="100%">
                    <tr>
                        <td class="col-xs-4">
                            <div class="form-item form-item-pet-friendly form-type-checkbox checkbox">
                                <label class="control-label" for="edit-pet-friendly">
                                    <input type="checkbox" name="pet_friendly" value="1"
                                        class="form-checkbox" />PetFriendly
                                </label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-adults-only form-type-checkbox checkbox">
                                <label class="control-label" for="edit-adults-only">
                                    <input type="checkbox" name="adults_only" value="1" class="form-checkbox" />Adults
                                    Only
                                </label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-beach-front form-type-checkbox checkbox">
                                <label class="control-label" for="edit-beach-front">
                                    <input type="checkbox" id="edit-beach-front" name="beach_front" value="1"
                                        class="form-checkbox" />Beach / Water front
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
        <input id="arrival-alt" type="hidden" name="arrival" value="" />
        <input id="departure-alt" type="hidden" name="departure" value="" />
        <div class="form-actions form-wrapper form-group" id="edit-actions--2">
            <button title="Check Availability" class="btn btn-success btn-loading form-submit"
                data-loading-text="&lt;i class=&quot;fa fa-spinner fa-spin&quot;&gt;&lt;/i&gt; ... loading"
                type="submit" value="Check Availability">Check Availability</button>
        </div>
    </div>
</form>
