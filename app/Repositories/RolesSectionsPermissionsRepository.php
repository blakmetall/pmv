<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Role, RoleSectionPermission, RoleTranslation };


class RolesSectionsPermissionsRepository implements RolesSectionsPermissionsRepositoryInterface
{
    protected $model;

    public function __construct(RoleSectionPermission $sectionPermission)
    {
        $this->model = $sectionPermission;
    }

    public function all($search = '', $config = [])
    {
        $lang = LanguageHelper::current();
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = 
                RoleSectionPermission::
                    where('section_name', 'like', "%".$search."%");
        } else {
            $query = RoleSectionPermission::query();
        }
        
        $query->orderBy('section_name', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
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
