<?php

namespace App\Http\Controllers;

use App\Models\AmenityTranslation;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Helpers\Language;

class AmenitiesController extends Controller
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
        $lang = Language::current();

        $language_id = $lang->id;

        $amenities = (new AmenityTranslation)
            ->where('language_id', $language_id)
            ->with('amenity')
            ->orderBy('name', 'asc')
            ->paginate(30);

        return view('amenities.index', [
            'amenities' => $amenities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amenity = new Amenity;
        return view('amenities.create', [
            'amenity' => $amenity
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

        $amenity = new Amenity;
        $amenity->save();

        $en = new AmenityTranslation;
        $en->language_id = Language::getId('en');
        $en->amenity_id = $amenity->id;
        $en->name = $request->amenity['en'];
        $en->save();

        $es = new AmenityTranslation;
        $es->language_id = Language::getId('es');
        $es->amenity_id = $amenity->id;
        $es->name = $request->amenity['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('amenities') );
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
        $amenity['en'] = $amenity->translations()
            ->where('language_id', Language::getId('en'))
            ->first();

        $amenity['es'] = $amenity->translations()
            ->where('language_id', Language::getId('es'))
            ->first();

        return view('amenities.edit', [
            'amenity' => $amenity
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
        // run validations
        // if fails
        // return to edit and restore values from input
        // code: return redirect( route('amenities.edit', $id) )->withInput();

        $amenity = Amenity::findOrFail($id);

        $en = $amenity->translations()->where('language_id', Language::getId('en'))->first();
        $en->name = $request->amenity['en'];
        $en->save();

        $es = $amenity->translations()->where('language_id', Language::getId('es'))->first();
        $es->name = $request->amenity['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('amenities') );
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
        $amenity = Amenity::findOrFail($id);

        // delete translations
        $amenity->translations()->where('language_id', Language::getId('en'))->delete();
        $amenity->translations()->where('language_id', Language::getId('es'))->delete();

        // delete 
        $amenity->delete();

        return redirect( route('amenities') );
    }
}
