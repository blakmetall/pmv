<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ City, State };

class CitiesController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);

        if ($search) {
            $cities_query = City::where('name', 'like', "%".$search."%");
        } else {
            $cities_query = new City;
        }
        
        $cities = $cities_query->paginate(5)->onEachSide(5);

        return view('cities.index')
            ->with('cities', $cities)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create')
            ->with('city', (new City))
            ->with('states', State::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;
        $city->state_id = $request->state_id;
        $city->name = $request->city;
        $city->save();

        return redirect( route('cities') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show')->with('city', $city);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('cities.edit')
            ->with('city', $city)
            ->with('states', State::all());
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
        $city = City::findOrFail($id);
        $city->name = $request->city;
        $city->state_id = $request->state_id;
        $city->save();

        return redirect(route('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return redirect(route('cities'));
    }
}