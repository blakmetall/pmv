<?php

namespace App\Http\Controllers;

use Hash;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::
            orderBy('email', 'asc')
            ->paginate(30);

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Display a listing of the resource searched.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = $request->s_data;
        
        $users = User::where('email', 'like', "%".$search."%")
        ->orWhereHas('profile', function($query) use ($search){
            $query->where('profiles.firstname', 'like', $search)
                ->orWhere('profiles.lastname', 'like', $search)
                ->orWhere('profiles.country', 'like', $search)
                ->orWhere('profiles.state', 'like', $search)
                ->orWhere('profiles.city', 'like', $search)
                ->orWhere('profiles.street', 'like', $search)
                ->orWhere('profiles.zip', 'like', $search)
                ->orWhere('profiles.phone', 'like', $search)
                ->orWhere('profiles.mobile', 'like', $search);
        })->orderBy('email', 'asc')->paginate( 30 );

        return view('users.index', [
            'users' => $users,
            'search' => $search
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        return view('users.create', [
            'user' => $user
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
        $user = new User;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_enabled = ($request->is_enabled == 'on')?1:0;
        $user->save();

        // if everything succeeds return to list
        return redirect( route('users') );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
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
        $user = User::findOrFail($id);
        $user->email = $request->email;
        if ( !empty($request->password) ) {
            $user->password = Hash::make($request->password);
        }
        $user->is_enabled = ($request->is_enabled == 'on')?1:0;
        $user->save();
        // if everything succeeds return to list
        return redirect( route('users') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /// find
        $user = User::findOrFail($id);

        // delete 
        $user->delete();

        return redirect( route('users') );
    }
}
