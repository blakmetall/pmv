<!-- english -->
<div class="card">
    <div class="card-body">

        @if($city)
        
        <div class="form-group row">   
                <label for="city_zone" class="col-sm-2 col-form-label">
                    {{ __('State') }}
                </label>
                <div class="col-sm-10">
                    <select name="state_id" class="form-control">
                        <option value="1">Distrito Federal</option>
                        <option value="2">Aguascalientes</option>
                        <option value="3">Baja California</option>
                        <option value="4">Baja California Sur</option>
                        <option value="5">Campeche</option>
                        <option value="6">Chiapas</option>
                        <option value="7">Chihuahua</option>
                        <option value="8">Coahuila</option>
                        <option value="9">Colima</option>
                        <option value="10">Durango</option>
                        <option value="11">Guanajuato</option>
                        <option value="12">Guerrero</option>
                        <option value="13">Hidalgo</option>
                        <option value="14">Jalisco</option>
                        <option value="15">M&eacute;xico</option>
                        <option value="16">Michoac&aacute;n</option>
                        <option value="17">Morelos</option>
                        <option value="18">Nayarit</option>
                        <option value="19">Nuevo Le&oacute;n</option>
                        <option value="20">Oaxaca</option>
                        <option value="21">Puebla</option>
                        <option value="22">Quer&eacute;taro</option>
                        <option value="23">Quintana Roo</option>
                        <option value="24">San Luis Potos&iacute;</option>
                        <option value="25">Sinaloa</option>
                        <option value="26">Sonora</option>
                        <option value="27">Tabasco</option>
                        <option value="28">Tamaulipas</option>
                        <option value="29">Tlaxcala</option>
                        <option value="30">Veracruz</option>
                        <option value="31">Yucat&aacute;n</option>
                        <option value="32">Zacatecas</option>
                    </select>
                </div>
        </div>
        @endif      
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>