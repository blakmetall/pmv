<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ City, Zone, ZoneTranslation };

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lang = LanguageHelper::current();

        $search = trim($request->s);

        if ($search) {
            $zones_query = ZoneTranslation::where('name', 'like', "%".$search."%");
        } else {
            $zones_query = new ZoneTranslation;
        }

        $zones = 
            $zones_query
                ->where('language_id', $lang->id)
                ->with('zone')
                ->orderBy('name', 'asc')
                ->paginate(30);

        return view('zones.index')
            ->with('zones', $zones)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zones.create')
            ->with('zone', (new Zone))
            ->with('cities', City::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $zone = new Zone;
        $zone->city_id = $request->city_id;
        $zone->save();

        $en = new ZoneTranslation;
        $en->language_id = LanguageHelper::getId('en');
        $en->zone_id = $zone->id;
        $en->name = $request->zone['en'];
        $en->save();

        $es = new ZoneTranslation;
        $es->language_id = LanguageHelper::getId('es');
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
        $zone['en'] = $zone
            ->translations()
            ->where('language_id', LanguageHelper::getId('en'))
            ->first();

        $zone['es'] = $zone
            ->translations()
            ->where('language_id', 2)
            ->first();

        return view('zones.show')
            ->with('zone', $zone)
            ->with('cities', City::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        $zone['en'] = $zone
            ->translations()
            ->where('language_id', LanguageHelper::getId('en'))
            ->first();

        $zone['es'] = $zone
            ->translations()
            ->where('language_id', 2)
            ->first();

        return view('zones.edit')
            ->with('zone', $zone)
            ->with('cities', City::all());
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
        $zone = Zone::findOrFail($id);

        $en = $zone
            ->translations()
            ->where('language_id', LanguageHelper::getId('en'))
            ->first();
        $en->name = $request->zone['en'];
        $en->save();

        $es = $zone
            ->translations()
            ->where('language_id', LanguageHelper::getId('es'))
            ->first();
        $es->name = $request->zone['es'];
        $es->save();

        return redirect( route('zones') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $zone = Zone::findOrFail($id);

        $zone->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
        $zone->translations()->where('language_id', LanguageHelper::getId('es'))->delete();
        
        $zone->delete();

        return redirect(route('zones') );
    }
}