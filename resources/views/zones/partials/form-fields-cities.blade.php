<!-- english -->
<div class="card">
    <div class="card-body">

        @if($cities)
        
        <div class="form-group row">   
                <label for="city_zone" class="col-sm-2 col-form-label">
                    {{ __('City') }}
                </label>
                <div class="col-sm-10">
                    <select name="city_id" class="form-control">
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>
        @endif      
    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>