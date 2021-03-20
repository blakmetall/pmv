<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Page, PageTranslation };
use App\Repositories\PagesRepositoryInterface;
use App\Validations\PagesValidations;

class PagesRepository implements PagesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Page $page)
    {
        $this->model = $page;
        $this->validation = new PagesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                PageTranslation::where('title', 'like', "%".$search."%")
                    ->orWhere('page_id', $search);
        } else {
            $query = PageTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('page')
            ->orderBy('title', 'asc');

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
            $page = $this->blueprint();
            $page->save();
            
            $page->en->language_id = LanguageHelper::getId('en');
            $page->en->page_id = $page->id;
            
            $page->es->language_id = LanguageHelper::getId('es');
            $page->es->page_id = $page->id;
        }else{
            $page = $this->find($id);
            $page->save();
        }

        $page->en->fill($request->en);
        if(!$request->en['slug']){
            $page->en->slug = generateSlug($request->en['title']);
        }
        $page->en->save();
        
        $page->es->fill($request->es);
        if(!$request->es['slug']){
            $page->es->slug = generateSlug($request->es['title']);
        }
        $page->es->save();
        
        return $page;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $page = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($page) { 

            $page->en = 
                $page
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $page->es =
                 $page
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$page) { 
            throw new ModelNotFoundException("Page not found");
        }

        return $page;
    }
    
    public function delete($id)
    {
        $page = $this->model->find($id);
        
        if ($page && $this->canDelete($id)) {

            $page->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $page->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $page->delete();
        }

        return $page; 
    }

    public function canDelete($id)
    {
        return false;
    }

    public function blueprint()
    {
        $page = new Page;
        $page->en = new PageTranslation;
        $page->es = new PageTranslation;

        return $page;
    }
}