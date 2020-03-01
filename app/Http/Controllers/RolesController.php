<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\{ LanguageHelper, RoleHelper };
use App\Models\{ Role, RoleTranslation };

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = LanguageHelper::current();

        $roles = 
            RoleTranslation::
                where('language_id', $lang->id)
                ->with('role')
                ->orderBy('id', 'asc')
                ->paginate(30);

        return view('roles.index')->with('roles', $roles);
    }


    /**
     * Sets the active role for the user in the database
     */
    public function updateActive($id) 
    {   
        if(RoleHelper::hasValidRoleId($id)) {
            $profile = auth()->user()->profile;
            $profile->config_role_id = $id;
            $profile->save();
        }

        return redirect(route('dashboard'));
    }
}