<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\PropertyTranslation;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\City;
use App\Models\Zone;
use App\Models\ZoneTranslation;
use App\Models\PropertyTypeTranslation;
use App\Models\CleaningOptionTranslation;
use App\Models\CleaningOption;


use Illuminate\Support\Facades\Auth;


class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $language_id = 1; // for now is a simulated language

        $properties = (new PropertyTranslation)
        ->where('language_id', $language_id)
        ->with('property')
        ->orderBy('id', 'asc')
        ->paginate(30);

        return view('properties.index', [
            'properties' => $properties
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = new Property;

        $language_id = 1; // for now is a simulated language


        $cities = (new City)->get();        
        $zones = (new ZoneTranslation)->where('language_id', $language_id)->get();
        $properties_types = (new PropertyTypeTranslation)->where('language_id', $language_id)->get();
        $cleaning_option = (new CleaningOptionTranslation)->where('language_id', $language_id)->get();
        
        return view('properties.create', [
            'property' => $property,
            'cities' => $cities,
            'zones' => $zones,
            'properties_types' => $properties_types,
            'cleaning_option' => $cleaning_option
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        /* Property EN*/
        $property = new Property;

        $property->user_id = $user->id;
        $property->city_id = $request->city_id;
        $property->zone_id = $request->zone_id;
        $property->property_type_id = $request->property_type_id;
        $property->cleaning_option_id = $request->cleaning_option_id;
        if($request->is_featured){
            $property->is_featured = 1;
        }
        if($request->is_enabled){
            $property->is_enabled = 1;
        }
        if($request->is_online){
            $property->is_online = 1;
        }
        if($request->has_parking){
            $property->has_parking = 1;
        }        
        $property->building = $request->building;
        $property->rental_comission = $request->rental_comission;        
        $property->bedrooms = $request->bedrooms;
        $property->bedding_JSON = $request->bedding_JSON;
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

        $property->save();

        $en = new PropertyTranslation;
        $en->language_id = 1;
        $en->property_id = $property->id;
        $en->name = $request->name['en'];
        $en->description = $request->description['en'];
        $en->cancellation_policies = $request->cancellation_policies['en'];
        $en->save();

        $es = new PropertyTranslation;
        $es->language_id = 2;
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
        
        $property['en'] = $property
                ->with('city')
                ->with(["type.translations" => function($q) {
                    $q->where('language_id', 1);
                }]) 
                ->with(["translations" => function($q){
                    $q->where('language_id', 1);
                }])  
                ->with(["zone.translations" => function($q){
                    $q->where('language_id', 1);
                }])
                ->with(["cleaningOption.translations" => function($q){
                    $q->where('language_id', 1);
                }])->first();
        $property['es'] =  $property
                ->with('city')
                ->with(["type.translations" => function($q) {
                    $q->where('language_id', 2);
                }]) 
                ->with(["translations" => function($q){
                    $q->where('language_id', 2);
                }])  
                ->with(["zone.translations" => function($q){
                    $q->where('language_id', 2);
                }])
                ->with(["cleaningOption.translations" => function($q){
                    $q->where('language_id', 2);
                }])->first();
        
        return view('properties.show', [
            'property' => $property
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
       
        $language_id = 1; // for now is a simulated language


        $property['en'] = $property->translations()->where('language_id', 1)->first();
        $property['es'] = $property->translations()->where('language_id', 2)->first();
        
        $cities = (new City)->get();        
        $zones =  (new Zone)->with(["translations" => function($q) use ($language_id){
                    $q->where('language_id', $language_id);
                }])->get() ; 
        //$zones = Zone->translation()->where('language_id', $language_id);//(new ZoneTranslation)->where('language_id', $language_id)->get();
        $properties_types = (new PropertyType)->with(["translations" => function($q) use($language_id){
                    $q->where('language_id', $language_id);
                }])->get() ;        
        $cleaning_option =  (new CleaningOption )->with(["translations" => function($q) use($language_id){
            $q->where('language_id', $language_id);
        }])->get() ;
                    
        return view('properties.edit', [
            'property' => $property,
            'cities' => $cities,
            'zones' => $zones,
            'properties_types' => $properties_types,
            'cleaning_option' => $cleaning_option
        ]);
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

        /*
        $property = Property::findOrFail($id);

        $en = $property->translations()->where('language_id', Language::getId('en'))->first();
        $en->name = $request->property['en'];
        $en->save();

        $es = $property->translations()->where('language_id', Language::getId('es'))->first();
        $es->name = $request->property['es'];
        $es->save();
        */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find
        $property = Property::findOrFail($id);

        // delete translations
        $property->translations()->where('language_id', 1)->delete();
        $property->translations()->where('language_id', 2)->delete();

        // delete 
        $property->delete();

        return redirect( route('properties') );
    }

    private function validateData($request){
        $rules = [
            'country_id' => ['required'],
            'state_id' => ['required'],
            'street' => ['required'],
            'exterior_number' => ['required'],
            'colony' => ['required'],
            'municipality_county' => ['required'],
            'zip' => ['required'],
        ];

        $validator = Validator::make( $request->all(), $rules );
        if($validator->fails()) {
            throw new HttpResponseException(
                response()->json(['errors'=>$validator->errors()], 400)
            );
        }
    }


}
