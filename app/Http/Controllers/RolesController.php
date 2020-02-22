<?php

namespace App\Http\Controllers;

use App\Models\RoleTranslation;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language_id = 1; // for now is a simulated language

        $roles = (new RoleTranslation)
            ->where('language_id', $language_id)
            ->with('role')
            ->orderBy('id', 'asc')
            ->paginate(30);

        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        return view('roles.create', [
            'role' => $role
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
        $role = new Role;
        $role->save();

        $en = new RoleTranslation;
        $en->language_id = 1;
        $en->role_id = $role->id;
        $en->name = $request->role['en'];
        $en->save();

        $es = new RoleTranslation;
        $es->language_id = 2;
        $es->role_id = $role->id;
        $es->name = $request->role['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('roles') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role['en'] = $role->translations()->where('language_id', 1)->first();
        $role['es'] = $role->translations()->where('language_id', 2)->first();

        return view('roles.edit', [
            'role' => $role
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

        $role = Role::findOrFail($id);

        $en = $role->translations()->where('language_id', 1)->first();
        $en->name = $request->role['en'];
        $en->save();

        $es = $role->translations()->where('language_id', 2)->first();
        $es->name = $request->role['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('roles') );
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
        $role = Role::findOrFail($id);

        // delete translations
        $role->translations()->where('language_id', 1)->delete();
        $role->translations()->where('language_id', 2)->delete();

        // delete 
        $role->delete();

        return redirect( route('roles') );
    }

    /**
     * Sets the active role for the user in the database
     */
    public function updateActive($id) 
    {
        $profile = (auth()->user())->profile;
        if ($profile) {
            if(\App\Helpers\Role::hasValidRoleId($id)) {
                $profile->config_role_id = $id;
                $profile->save();
            }
        }

        return redirect(route('dashboard'));
    }
}
