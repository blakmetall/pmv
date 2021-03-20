<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Lgbt, LgbtTranslation };
use App\Repositories\LgbtsRepositoryInterface;
use App\Validations\LgbtsValidations;
use App\Helpers\ImagesHelper;

class LgbtsRepository implements LgbtsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Lgbt $lgbt)
    {
        $this->model = $lgbt;
        $this->validation = new LgbtsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                LgbtTranslation::where('title', 'like', "%".$search."%")
                    ->orWhere('lgbt_id', $search);
        } else {
            $query = LgbtTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('lgbt')
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
        $folder = 'lgbt';
        $hasUploadedFile = $request->hasFile('photo');
        $is_new = ! $id;

        if ($is_new) {
            $lgbt = $this->blueprint();
            if($hasUploadedFile){
                $imgData = ImagesHelper::saveFile($request->photo, $folder);
                $lgbt->file_slug = $imgData['file_slug'];
                $lgbt->file_extension = $imgData['file_extension'];
                $lgbt->file_original_name = $imgData['file_original_name'];
                $lgbt->file_name = $imgData['file_name'];
                $lgbt->file_path = $imgData['file_path'];
                $lgbt->file_url = $imgData['file_url']; 
            }
            $lgbt->save();
            
            $lgbt->en->language_id = LanguageHelper::getId('en');
            $lgbt->en->lgbt_id = $lgbt->id;
            
            $lgbt->es->language_id = LanguageHelper::getId('es');
            $lgbt->es->lgbt_id = $lgbt->id;
        }else{
            $lgbt = $this->find($id);
            if($hasUploadedFile){
                ImagesHelper::deleteFile($lgbt->file_path);
                ImagesHelper::deleteThumbnails($lgbt->file_path);

                $imgData = ImagesHelper::saveFile($request->photo, $folder);
                $lgbt->file_slug = $imgData['file_slug'];
                $lgbt->file_extension = $imgData['file_extension'];
                $lgbt->file_original_name = $imgData['file_original_name'];
                $lgbt->file_name = $imgData['file_name'];
                $lgbt->file_path = $imgData['file_path'];
                $lgbt->file_url = $imgData['file_url']; 
            }
            $lgbt->save();
        }

        $lgbt->en->fill($request->en);
        $lgbt->en->save();
        
        $lgbt->es->fill($request->es);
        $lgbt->es->save();
        
        return $lgbt;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $lgbt = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($lgbt) { 

            $lgbt->en = 
                $lgbt
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $lgbt->es =
                 $lgbt
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$lgbt) { 
            throw new ModelNotFoundException("Page not found");
        }

        return $lgbt;
    }
    
    public function delete($id)
    {
        $lgbt = $this->model->find($id);
        
        if ($lgbt) {

            $lgbt->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $lgbt->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $lgbt->delete();
        }

        return $lgbt; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $lgbt = new Lgbt;
        $lgbt->en = new LgbtTranslation;
        $lgbt->es = new LgbtTranslation;

        return $lgbt;
    }
}