<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\RolesRepositoryInterface;
use App\Models\{ Role, RoleTranslation };
// use App\Validations\UsersValidations;

class RolesRepository implements RolesRepositoryInterface
{
    protected $model;

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function all($search = '', $config = [])
    {
        $lang = LanguageHelper::current();

        $skipSuperAdmin = isset($config['skipSuperAdmin']) && $config['skipSuperAdmin'] === true;

        if ($search) {
            $query = 
                RoleTranslation::
                    where('name', 'like', "%".$search."%");
        } else {
            $query = RoleTranslation::query();
        }

        if ($skipSuperAdmin) {
            $query->where('role_id', '!=', 1);
        }

        return $query
            ->where('language_id', $lang->id)
            ->with('role')  
            ->orderBy('name', 'asc')
            ->paginate(30);
    }

    
    public function create(Request $request)
    {
        /*
        UsersValidations::validateOnCreate($request);
        return $this->save($request);
        */
    }

    public function update(Request $request, $id)
    {
        /*
        UsersValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
        */
    }

    public function save(Request $request, $id = '')
    {
        /*
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
        */
    }

    public function find($id_or_obj)
    {
        /*
        $is_obj = is_object($id_or_obj);
        $user = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
        */
    }
    
    public function delete($id)
    {
        /*
        $user = $this->model->find($id);
        
        if ($user) {
            $user->delete();
        }

        return $user;
        */
    }

    public function canDelete($id) {
        // return ($id > 4); // to not delete admin users 
    }

    public function blueprint()
    {
        /*
        $user = new User;
        $user->profile = new Profile;
        return $user;
        */
    }
    
}
