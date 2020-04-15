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

    public function __construct(CleaningOption $cleaning_option)
    {
        $this->model = $cleaning_option;
    }

    public function all($search = '')
    {
        $lang = LanguageHelper::current();

        if ($search) {
            $query = CleaningOptionTranslation::where('name', 'like', "%".$search."%");
        } else {
            $query = CleaningOptionTranslation::query();;
        }

        return $query
            ->where('language_id', $lang->id)
            ->with('cleaning_option')
            ->orderBy('name', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        CleaningOptionsValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        CleaningOptionsValidations::validateOnEdit($request);
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
        return ($id > 6);
    }

    public function blueprint()
    {
        $cleaning_option = new CleaningOption;
        $cleaning_option->en = new CleaningOptionTranslation;
        $cleaning_option->es = new CleaningOptionTranslation;

        return $cleaning_option;
    }
}