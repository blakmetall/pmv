<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

use App\Models\{
    User,
    Profile
};

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profile = new Profile;
        return view('profiles.create', [
            'profile' => $profile
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
        $profile                          = new Profile;
        $profile->user_id                 = Auth::user();
        $profile->firstname               = $request->firstname;
        $profile->lastname                = $request->lastname;
        $profile->country                 = $request->country;
        $profile->state                   = $request->state;
        $profile->city                    = $request->city;
        $profile->street                  = $request->street;
        $profile->zip                     = $request->zip;
        $profile->phone                   = $request->phone;
        $profile->mobile                  = $request->mobile;
        $profile->config_language         = $request->config_language;
        $profile->config_agent_commission = $request->config_agent_commission;
        $profile->save();

        // if everything succeeds return to list
        return redirect( route('profiles.edit', $profile->id) );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $id)
    {
        return view('profiles.edit', [
            'profile' => $id
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
        $profile = Profile::findOrFail($id);

        $profile->firstname               = $request->firstname;
        $profile->lastname                = $request->lastname;
        $profile->country                 = $request->country;
        $profile->state                   = $request->state;
        $profile->city                    = $request->city;
        $profile->street                  = $request->street;
        $profile->zip                     = $request->zip;
        $profile->phone                   = $request->phone;
        $profile->mobile                  = $request->mobile;
        $profile->config_language         = $request->config_language;
        $profile->config_agent_commission = $request->config_agent_commission;
        $profile->save();

        // if everything succeeds return to list
        return redirect( route('profiles.edit', $id) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
