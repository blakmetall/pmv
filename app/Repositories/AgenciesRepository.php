<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Agency, AgencyTranslation };
use App\Repositories\AgenciesRepositoryInterface;
use App\Validations\AgenciesValidations;
use App\Helpers\ImagesHelper;

class AgenciesRepository implements AgenciesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Agency $agency)
    {
        $this->model = $agency;
        $this->validation = new AgenciesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                AgencyTranslation::where('title', 'like', "%".$search."%")
                    ->orWhere('agency_id', $search);
        } else {
            $query = AgencyTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('agency')
            ->orderBy('id', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        $this->validation->validate('create', $request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $folder = 'agencies';
        $hasUploadedFile = $request->hasFile('photo');
        $is_new = ! $id;

        if ($is_new) {
            $agency = $this->blueprint();
            if($hasUploadedFile){
                $imgData = ImagesHelper::saveFile($request->photo, $folder);
                $agency->file_slug = $imgData['file_slug'];
                $agency->file_extension = $imgData['file_extension'];
                $agency->file_original_name = $imgData['file_original_name'];
                $agency->file_name = $imgData['file_name'];
                $agency->file_path = $imgData['file_path'];
                $agency->file_url = $imgData['file_url']; 
            }
            $agency->save();
            
            $agency->en->language_id = LanguageHelper::getId('en');
            $agency->en->agency_id = $agency->id;
            
            $agency->es->language_id = LanguageHelper::getId('es');
            $agency->es->agency_id = $agency->id;
        }else{
            $agency = $this->find($id);
            if($hasUploadedFile){
                ImagesHelper::deleteFile($agency->file_path);
                ImagesHelper::deleteThumbnails($agency->file_path);

                $imgData = ImagesHelper::saveFile($request->photo, $folder);
                $agency->file_slug = $imgData['file_slug'];
                $agency->file_extension = $imgData['file_extension'];
                $agency->file_original_name = $imgData['file_original_name'];
                $agency->file_name = $imgData['file_name'];
                $agency->file_path = $imgData['file_path'];
                $agency->file_url = $imgData['file_url']; 
            }
            $agency->save();
        }

        $agency->en->fill($request->en);
        $agency->en->save();
        
        $agency->es->fill($request->es);
        $agency->es->save();
        
        return $agency;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $agency = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($agency) { 

            $agency->en = 
                $agency
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $agency->es =
                 $agency
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$agency) { 
            throw new ModelNotFoundException("Page not found");
        }

        return $agency;
    }
    
    public function delete($id)
    {
        $agency = $this->model->find($id);
        
        if ($agency) {

            $agency->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $agency->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $agency->delete();
        }

        return $agency; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $agency = new Agency;
        $agency->en = new AgencyTranslation;
        $agency->es = new AgencyTranslation;

        return $agency;
    }
}