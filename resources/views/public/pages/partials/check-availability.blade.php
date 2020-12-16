<form action="{{ $searchUrl }}" method="post" id="avail-search-form" accept-charset="UTF-8">
    <div>
        <table>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-ptype form-type-select form-group">
                        <div class="field-title"><span>01.</span> What?</div><select class="form-control form-select"
                            id="edit-ptype" name="ptype">
                            <option value="">Any Type...</option>
                            <option value="3">Condo</option>
                            <option value="6">House</option>
                            <option value="11">Long Term Rental</option>
                            <option value="8">Penthouse</option>
                            <option value="9">Studio</option>
                            <option value="10">Villa</option>
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-city form-type-select form-group">
                        <div class="field-title"><span>02.</span> Where?</div><select class="form-control form-select"
                            id="edit-city" name="city">
                            <option value="">City</option>
                            <option value="26">Mazatlán</option>
                            <option value="22">Nuevo Vallarta</option>
                            <option value="1">Puerto Vallarta</option>
                        </select>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-arrival form-type-textfield form-group">
                        <div class="field-title"><span>03.</span> When?</div>
                        <div class="input-group"><span class="input-group-addon"><span
                                    class="glyphicon glyphicon-calendar"></span></span><input
                                class="text-center form-control form-text" readonly="readonly"
                                placeholder="Check-in-date" type="text" id="edit-arrival" name="arrival"
                                value="Saturday 12/December/2020" size="60" maxlength="128" /></div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-adults form-type-textfield form-group">
                        <div class="field-title"><span>04.</span> Who?</div>
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-male"></i></span><input
                                placeholder="Adults" title="Adults" class="form-control form-text" type="text"
                                id="edit-adults" name="adults" value="" size="60" maxlength="128" /></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-xs-3">
                    <div class="form-item form-item-bedrooms form-type-textfield form-group">
                        <div class="input-group"><span class="input-group-addon"><i class="fa fa-bed"></i></span><input
                                placeholder="Bedrooms" title="Bedrooms" class="form-control form-text" type="text"
                                id="edit-bedrooms" name="bedrooms" value="" size="60" maxlength="128" /></div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-location form-type-select form-group"><select
                            class="hide form-control form-select" id="edit-location" name="location">
                            <option value="">Any Location...</option>
                            <option value="1">5 de Diciembre</option>
                            <option value="2">Alta Vista</option>
                            <option value="3">Amapas</option>
                            <option value="4">Benito Juarez - Remance</option>
                            <option value="50">Boca de Tomatlán</option>
                            <option value="52">Bucerías</option>
                            <option value="54">Cerritos</option>
                            <option value="5">Conchas Chinas</option>
                            <option value="55">Downtown</option>
                            <option value="6">Downtown - Puerto Vallarta</option>
                            <option value="36">Emiliano Zapata</option>
                            <option value="37">Francisco Villa</option>
                            <option value="57">Golden Zone</option>
                            <option value="7">Gringo Gulch</option>
                            <option value="49">La Cruz de Huanacaxtle</option>
                            <option value="47">Las Animas</option>
                            <option value="53">Las Gaviotas</option>
                            <option value="8">Los Muertos Beach</option>
                            <option value="59">Malecón</option>
                            <option value="61">Marina Mazatlán</option>
                            <option value="9">Marina Vallarta</option>
                            <option value="51">Mazatlán</option>
                            <option value="10">Mismaloya</option>
                            <option value="11">North Hotel Zone</option>
                            <option value="13">Nuevo Vallarta</option>
                            <option value="60">Olas Altas</option>
                            <option value="56">Old Mazatlán</option>
                            <option value="14">Old Town/Zona Romántica</option>
                            <option value="15">Palmar de Aramara</option>
                            <option value="16">Playa Los Venados</option>
                            <option value="43">Puerto Vallarta</option>
                            <option value="44">Punta de Mita</option>
                            <option value="17">Punta Negra</option>
                            <option value="63">Quimixto</option>
                            <option value="58">Sábalo Country</option>
                            <option value="18">South Beach</option>
                            <option value="12">South Hotel Zone</option>
                            <option value="62">Telleria</option>
                            <option value="19">Versalles</option>
                            <option value="48">Yelapa</option>
                        </select></div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-departure form-type-textfield form-group">
                        <div class="input-group"><span class="input-group-addon"><span
                                    class="glyphicon glyphicon-calendar"></span></span><input
                                class="text-center form-control form-text" readonly="readonly"
                                placeholder="Check-out-date" type="text" id="edit-departure" name="departure"
                                value="Saturday 19/December/2020" size="60" maxlength="128" /></div>
                    </div>
                </td>
                <td class="col-xs-3">
                    <div class="form-item form-item-children form-type-textfield form-group">
                        <div class="input-group"><span class="input-group-addon"><i
                                    class="fa fa-child"></i></span><input placeholder="Children" title="Children"
                                class="form-control form-text" type="text" id="edit-children" name="children" value=""
                                size="60" maxlength="128" /></div>
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
                            <div class="form-item form-item-pet-friendly form-type-checkbox checkbox"> <label
                                    class="control-label" for="edit-pet-friendly"><input type="checkbox"
                                        id="edit-pet-friendly" name="pet_friendly" value="1" class="form-checkbox" />Pet
                                    Friendly</label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-adults-only form-type-checkbox checkbox"> <label
                                    class="control-label" for="edit-adults-only"><input type="checkbox"
                                        id="edit-adults-only" name="adults_only" value="1"
                                        class="form-checkbox" />Adults Only</label>
                            </div>
                        </td>
                        <td class="col-xs-4">
                            <div class="form-item form-item-beach-front form-type-checkbox checkbox"> <label
                                    class="control-label" for="edit-beach-front"><input type="checkbox"
                                        id="edit-beach-front" name="beach_front" value="1" class="form-checkbox" />Beach
                                    / Water front</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
        <input id="arrival-alt" type="hidden" name="arrival_alt" value="2020-12-12" />
        <input id="departure-alt" type="hidden" name="departure_alt" value="2020-12-19" />
        <input type="hidden" name="form_build_id" value="form-W8YRHBVPArOufp7G-QJu0krFaDAsmjFFc0vd5E88NXo" />
        <input type="hidden" name="form_id" value="avail_search_form" />
        <div class="form-actions form-wrapper form-group" id="edit-actions--2"><button title="Check Availability"
                class="btn btn-success btn-loading form-submit"
                data-loading-text="&lt;i class=&quot;fa fa-spinner fa-spin&quot;&gt;&lt;/i&gt; ... loading"
                type="submit" id="edit-submit--2" name="op" value="Check Availability">Check
                Availability</button>
        </div>
    </div>
</form>
