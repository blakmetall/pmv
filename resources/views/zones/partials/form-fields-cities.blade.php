<!-- english -->
<div class="card">
    <div class="card-body">

        
            @if($cities)
                <select name="city_id">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            @endif
            
                
        </div>

    </div>
</div>

<!-- separator -->
<div class="mb-4"></div>