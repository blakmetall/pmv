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
            $query = User::query();
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

        // passsword
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // roles assignation
        if ($request->roles_ids && is_array($request->roles_ids) && count($request->roles_ids)) {
            $validRolesIds = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            $roles_to_assign = [];
            foreach ($request->roles_ids as $role_id) {
                $hasValidRole = in_array($role_id, $validRolesIds);
                if ($hasValidRole) {
                    $roles_to_assign[] = $role_id;
                }
            }
            $user->roles()->sync($roles_to_assign);
        }

        if ($user->id) {
            if (!$user->profile) {
                $user->profile = new Profile;
                $user->profile->user_id = $user->id;
                $user->profile->config_role_id = $roles_to_assign[0]; // default active role on create
                $user->profile->config_language = 'es'; // default language on create
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
        return ($id > 1); // to not delete super admin 
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $user = new User;
        return $user;
    }
}
