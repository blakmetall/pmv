<?php

namespace App\Http\Controllers;

use App\Models\ZoneTranslation;
use Illuminate\Http\Request;
use App\Models\Zone;
use App\Models\City;

class ZonesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language_id = 1; // for now is a simulated language

        $zones = (new ZoneTranslation)
            ->where('language_id', $language_id)
            ->with('zone')
            ->orderBy('name', 'asc')
            ->paginate(30);

        return view('zones.index', [
            'zones' => $zones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zone = new Zone;
        $language_id = 1; // for now is a simulated language
        $cities = (new City)->get();        
        return view('zones.create', [
            'zone' => $zone, 
            'cities' => $cities,
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
        // run validations
        // if fails
        // return to create and restore values from input
        // code: return redirect( route('amenities.create') )->withInput();
    
        $zone = new Zone;
        $zone->city_id = $request->city_id;
        $zone->save();

        $en = new ZoneTranslation;
        $en->language_id = 1;
        $en->zone_id = $zone->id;
        $en->name = $request->zone['en'];
        $en->save();

        $es = new ZoneTranslation;
        $es->language_id = 2;
        $es->zone_id = $zone->id;
        $es->name = $request->zone['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect(route('zones'));
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Zone $zone)
    {
        $language_id = 1;

        $zone['en'] = $zone->translations()->where('language_id', 1)->first();
        $zone['es'] = $zone->translations()->where('language_id', 2)->first();


        return view('zones.show', [
            'zone' => $zone
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {


        $zone['en'] = $zone->translations()->where('language_id', 1)->first();
        $zone['es'] = $zone->translations()->where('language_id', 2)->first();
        
        $cities = (new City)->get();        

        return view('zones.edit', [
            'zone' => $zone, 
            'cities' => $cities,
        ]);

        /**$cities = (new City)->get();
        return view('zones.edit', [
            'zone' => $zone,
            'cities' => $cities
        
        ]);**/
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect(route('zones.create') );
    }
}
