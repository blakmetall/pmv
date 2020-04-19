<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\LanguageHelper;
use App\Models\{
    PropertyTranslation,
    Property,
    PropertyType,
    City,
    Zone,
    ZoneTranslation,
    PropertyTypeTranslation,
    CleaningOptionTranslation,
    CleaningOption,
};


class PropertiesController extends Controller
{
    public function index(Request $request)
    {
        $lang = LanguageHelper::current();
        
        $search = trim($request->s);
        
        if ($search) {
            $properties_query = 
                PropertyTranslation::
                    where(function($query) use ($search) {
                        $query
                            ->where('name', 'like', "%".$search."%")
                            ->orWhere('description', 'like', "%".$search."%")
                            ->orWhere('cancellation_policies', 'like', "%".$search."%")
                            ->orWhereHas('property', function($query) use ($search) {
                                $table = (new Property)->_getTable();
                                $query->where($table . '.address', 'like', "%".$search."%");
                            }
                        );
                    });
        } else {
            $properties_query = new PropertyTranslation;
        }

        $properties = 
            $properties_query
                ->where('language_id', $lang->id)
                ->with('property')
                ->orderBy('name', 'asc')
                ->paginate( config('constants.pagination.per-page') );

        return view('properties.index')
            ->with('properties', $properties)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lang = LanguageHelper::current();

        $zones = Zone::with(
            ["translations" => function($q) use ($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get(); 

        $property_types = PropertyType::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }])
        ->get();        

        $cleaning_option = CleaningOption::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }])
        ->get();
        
        return view('properties.create')
            ->with('property', (new Property))
            ->with('cities', City::all())
            ->with('zones', $zones)
            ->with('property_types', $property_types)
            ->with('cleaning_option', $cleaning_option);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $property = new Property;
        $property->user_id = 1; // temporal; next user owner id
        $property->city_id = $request->city_id;
        $property->zone_id = $request->zone_id;
        $property->property_type_id = $request->property_type_id;
        $property->cleaning_option_id = $request->cleaning_option_id;   
        $property->building = $request->building;
        $property->rental_comission = $request->rental_comission;        
        $property->bedrooms = $request->bedrooms;
        $property->sleeps = $request->sleeps;
        $property->floors = $request->floors;
        $property->maid_fee = $request->maid_fee;
        $property->baths = $request->baths;        
        $property->lot_size_sqft = $request->lot_size_sqft;
        $property->construction_size_sqft = $request->construction_size_sqft;
        $property->phone = $request->phone;
        $property->address = $request->address;
        $property->gmaps_lat = $request->gmaps_lat;
        $property->gmaps_lon = $request->gmaps_lon;
        $property->is_featured = ($request->is_featured) ? 1 : 0;
        $property->is_enabled = ($request->is_enabled) ? 1 : 0;
        $property->is_online = ($request->is_online) ? 1 : 0;
        $property->has_parking = ($request->has_parking) ? 1 : 0;
        $property->save();

        $en = new PropertyTranslation;
        $en->language_id = LanguageHelper::getId('en');
        $en->property_id = $property->id;
        $en->name = $request->name['en'];
        $en->description = $request->description['en'];
        $en->cancellation_policies = $request->cancellation_policies['en'];
        $en->save();

        $es = new PropertyTranslation;
        $es->language_id = LanguageHelper::getId('es');
        $es->property_id = $property->id;
        $es->name = $request->name['es'];
        $es->description = $request->description['es'];
        $en->cancellation_policies = $request->cancellation_policies['es'];
        $es->save();

        return redirect( route('properties') );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $lang = LanguageHelper::current();

        $property['en'] = 
            $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

        $property['es'] = 
            $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();
              
        $zones = Zone::with(
            ["translations" => function($q) use ($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get(); 

        $property_types = PropertyType::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get();

        $cleaning_option = CleaningOption::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get() ;
                    
        return view('properties.show')
            ->with('property', $property)
            ->with('cities', City::all())
            ->with('zones', $zones)
            ->with('property_types', $property_types)
            ->with('cleaning_option', $cleaning_option);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $lang = LanguageHelper::current();

        $property['en'] = 
            $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

        $property['es'] = 
            $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();
              
        $zones = Zone::with(
            ["translations" => function($q) use ($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get(); 

        $property_types = PropertyType::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get();

        $cleaning_option = CleaningOption::with(
            ["translations" => function($q) use($lang){
                $q->where('language_id', $lang->id);
            }]
        )->get() ;
                    
        return view('properties.edit')
            ->with('property', $property)
            ->with('cities', City::all())
            ->with('zones', $zones)
            ->with('property_types', $property_types)
            ->with('cleaning_option', $cleaning_option);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $property = Property::findOrFail($id);

        $en = $property->translations()->where('language_id', LanguageHelper::getId('en'))->first(); 
        $en->name = $request->name['en'];
        $en->description = $request->description['en'];
        $en->cancellation_policies = $request->cancellation_policies['en'];
        $en->save();

        $es = $property->translations()->where('language_id', LanguageHelper::getId('es'))->first();
        $es->name = $request->name['es'];
        $es->description = $request->description['es'];
        $es->cancellation_policies = $request->cancellation_policies['es'];
        $es->save();

        $property->city_id = $request->city_id;
        $property->zone_id = $request->zone_id;
        $property->property_type_id = $request->property_type_id;
        $property->cleaning_option_id = $request->cleaning_option_id;
        $property->building = $request->building;
        $property->rental_comission = $request->rental_comission;        
        $property->bedrooms = $request->bedrooms;
        $property->sleeps = $request->sleeps;
        $property->floors = $request->floors;
        $property->maid_fee = $request->maid_fee;
        $property->baths = $request->baths;        
        $property->lot_size_sqft = $request->lot_size_sqft;
        $property->construction_size_sqft = $request->construction_size_sqft;
        $property->phone = $request->phone;
        $property->address = $request->address;
        $property->gmaps_lat = $request->gmaps_lat;
        $property->gmaps_lon = $request->gmaps_lon;
        $property->is_featured = ($request->is_featured) ? 1 : 0;
        $property->is_enabled = ($request->is_enabled) ? 1 : 0;
        $property->is_online = ($request->is_online) ? 1 : 0;
        $property->has_parking = ($request->has_parking) ? 1 : 0;
        $property->save();

        return redirect( route('properties') );
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
        $property->translations()->where('language_id', LanguageHelper::getId('es'))->delete();
        
        $property->delete();

        return redirect( route('properties') );
    }

}