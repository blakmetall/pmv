<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Amenity, AmenityTranslation };

class AmenitiesController extends Controller
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
            $amenities_query = AmenityTranslation::where('name', 'like', "%".$search."%");
        } else {
            $amenities_query = new AmenityTranslation;
        }

        $amenities = $amenities_query
            ->where('language_id', $lang->id)
            ->with('amenity')
            ->orderBy('name', 'asc')
            ->paginate(30);

        return view('amenities.index')
            ->with('amenities', $amenities)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('amenities.create')->with('amenity', (new Amenity));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $amenity = Amenity::create();

        $en = new AmenityTranslation;
        $en->language_id = LanguageHelper::getId('en');
        $en->amenity_id = $amenity->id;
        $en->name = $request->amenity['en'];
        $en->save();

        $es = new AmenityTranslation;
        $es->language_id = LanguageHelper::getId('es');
        $es->amenity_id = $amenity->id;
        $es->name = $request->amenity['es'];
        $es->save();

        return redirect(route('amenities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('amenities.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Amenity $amenity)
    {
        $amenity['en'] = 
            $amenity->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

        $amenity['es'] =
             $amenity->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();

        return view('amenities.edit')->with('amenity', $amenity);
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
        $amenity = Amenity::findOrFail($id);

        $en = $amenity->translations()->where('language_id', LanguageHelper::getId('en'))->first();
        $en->name = $request->amenity['en'];
        $en->save();

        $es = $amenity->translations()->where('language_id', LanguageHelper::getId('es'))->first();
        $es->name = $request->amenity['es'];
        $es->save();

        return redirect(route('amenities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);

        $amenity->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
        $amenity->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

        $amenity->delete();

        return redirect(route('amenities'));
    }
}