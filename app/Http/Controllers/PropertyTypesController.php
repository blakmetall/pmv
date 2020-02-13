<?php

namespace App\Http\Controllers;


use App\Models\PropertyType;
use App\Models\PropertyTypeTranslation;
use Illuminate\Http\Request;


class PropertyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $route = '/properties/';

    public function index()
    {
        $properties_types = PropertyTypeTranslation::paginate(5)->onEachSide(5);

        return view('/properties/types.index', [
            'properties_types' => $properties_types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'spanishPropertyType' => 'required|max:255',
            'englishPropertyType' => 'required|max:255',
        ]);

        $typeProperty = new PropertyType;
        $typeProperty->save();


        $typeProperty->translations()->create([
            'language_id' => 1,
            'name' => $request->spanishPropertyType,
        ]);

        $typeProperty->translations()->create([
            'language_id' => 2,
            'name' => $request->englishPropertyType,
        ]);

        return redirect()->route('types-all')->with('message', 'messages.property-types-success-message');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $type = PropertyType::find($id);
        $type->translations()->delete();
        $type->delete();

        return redirect()->route('types-all')->with('message', 'messages.property-types-delete-success-message');
    }


}
