<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;
use App\Models\{ User };
use App\Helpers\LanguageHelper;

class UsersRepository implements UsersRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all($search = '')
    {
        if ($search) {
            $query = User::
                where('email', 'like', "%".$search."%")
                    ->orWhereHas('profile', function($query) use ($search) {
                        $query
                            ->where('profiles.firstname', 'like', $search)
                            ->orWhere('profiles.lastname', 'like', $search)
                            ->orWhere('profiles.country', 'like', $search)
                            ->orWhere('profiles.state', 'like', $search)
                            ->orWhere('profiles.city', 'like', $search)
                            ->orWhere('profiles.street', 'like', $search);
                });
        } else {
            $query = new User;
        }

        return $query
            ->orderBy('email', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $user = $this->blueprint($request, $id);
        $user->save();
        
        return $user;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $user = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($user) {
            $user->first();
        }

        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }
    
    public function delete($id)
    {
        $user =
            $this->model
                ->where('id', '>', '4') // to avoid deleting seed items
                ->find($id);
        
        if ($user) {
            $user->delete();
        }

        // return recently deleted object to be used if needed after operation
        // the object may or may not exists
        return $user;
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint($request, $id)
    {
        $is_new = ! $id;
        if($is_new){
            $user = new User;
        }else{
            $user = $this->find($id);
        }
        $user->email = $request->email;
        $user->is_enabled = ($request->is_enabled) ? 1 : 0;
        if ( !empty($request->password) ) {
            $user->password = Hash::make($request->password);
        }

        return $user;
    }
}