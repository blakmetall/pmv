<?php

namespace App\Repositories;

use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;
use App\Models\{ Profile, User };
use App\Validations\UsersValidations;

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
            ->with('profile')  
            ->orderBy('email', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        UsersValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        UsersValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;
        
        if($is_new){
            $user = $this->blueprint();
        }else{
            $user = $this->find($id);
        }

        $checkboxesConfig = ['is_enabled' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());
        $user->fill($requestData);

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($user->id) {
            if (!$user->profile) {
                $user->profile->user_id = $user->id;
            }

            $user->profile->fill($request->profile);
            $user->profile->save();
        }

        return $user;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $user = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }
    
    public function delete($id)
    {
        $user = $this->model->find($id);
        
        if ($user) {
            $user->delete();
        }

        return $user;
    }

    public function canDelete($id) {
        return ($id > 4); // to not delete admin users 
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $user = new User;
        $user->profile = new Profile;
        return $user;
    }
}
