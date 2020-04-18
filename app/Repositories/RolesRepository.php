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

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $role = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$role) {
            throw new ModelNotFoundException("Role not found");
        }

        return $role;
    }

    public function create(Request $request){}
    public function update(Request $request, $id){}
    public function save(Request $request, $id){}
    public function delete($id){}
    public function canDelete($id){}
    public function blueprint(){}
}
