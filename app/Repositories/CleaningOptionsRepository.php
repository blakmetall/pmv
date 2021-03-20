<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\CleaningOptionsRepositoryInterface;
use App\Models\{ CleaningOption, CleaningOptionTranslation };
use App\Validations\CleaningOptionsValidations;

class CleaningOptionsRepository implements CleaningOptionsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(CleaningOption $cleaning_option, $config = [])
    {
        $this->model = $cleaning_option;
        $this->validation = new CleaningOptionsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        
        $lang = LanguageHelper::current();

        if ($search) {
            $query = CleaningOptionTranslation::where('name', 'like', "%".$search."%");
        } else {
            $query = CleaningOptionTranslation::query();
        }
        
        $query
            ->where('language_id', $lang->id)
            ->with('cleaning_option')
            ->orderBy('name', 'asc');

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
        $is_new = ! $id;

        if ($is_new) {
            $cleaning_option = $this->blueprint();
            $cleaning_option->save();
            
            $cleaning_option->en->language_id = LanguageHelper::getId('en');
            $cleaning_option->en->cleaning_option_id = $cleaning_option->id;
            
            $cleaning_option->es->language_id = LanguageHelper::getId('es');
            $cleaning_option->es->cleaning_option_id = $cleaning_option->id;
        }else{
            $cleaning_option = $this->find($id);
        }

        $cleaning_option->en->fill($request->en);
        $cleaning_option->en->save();
        
        $cleaning_option->es->fill($request->es);
        $cleaning_option->es->save();
        
        return $cleaning_option;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $cleaning_option = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($cleaning_option) {

            $cleaning_option->en = 
                $cleaning_option
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $cleaning_option->es =
                 $cleaning_option
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$cleaning_option) {
            throw new ModelNotFoundException("CleaningOption not found");
        }

        return $cleaning_option;
    }
    
    public function delete($id)
    {
        $cleaning_option = $this->model->find($id);
        
        if ($cleaning_option && $this->canDelete($id)) {
            $cleaning_option->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $cleaning_option->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $cleaning_option->delete();
        }

        return $cleaning_option; 
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 6;

        $cleaning_option = $this->model->find($id);
        if ($cleaning_option) {

            // validate empty usage in properties
            if ($cleaning_option->properties()->count()) {
                return false;
            }
            
        }

        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $cleaning_option = new CleaningOption;
        $cleaning_option->en = new CleaningOptionTranslation;
        $cleaning_option->es = new CleaningOptionTranslation;

        return $cleaning_option;
    }
}