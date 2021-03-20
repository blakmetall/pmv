<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ ContractorService, ContractorServiceTranslation };
use App\Repositories\ContractorsServicesRepositoryInterface;
use App\Validations\ContractorsServicesValidations;

class ContractorsServicesRepository implements ContractorsServicesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(ContractorService $service)
    {
        $this->model = $service;
        $this->validation = new ContractorsServicesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                ContractorServiceTranslation::where('name', 'like', "%".$search."%")
                    ->orWhere('description', 'like', '%'.$search.'%');
        } else {
            $query = ContractorServiceTranslation::query();
        }

        $query->where('language_id', $lang->id)
            ->with('contractorService')
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
            $service = $this->blueprint();
            $service->fill($request->all());
            $service->save();
            
            $service->en->language_id = LanguageHelper::getId('en');
            $service->en->contractor_service_id = $service->id;
            
            $service->es->language_id = LanguageHelper::getId('es');
            $service->es->contractor_service_id = $service->id;
        }else{
            $service = $this->find($id);
            
            $basePrice = (double) $service->base_price;

            $service->fill($request->all());

            // save price to be overriden (to be previous_base_price)
            if ( $basePrice != ((double) $request->base_price) ) {
                $service->previous_base_price = $basePrice;
            }

            $service->save();
        }

        $service->en->fill($request->en);
        $service->en->save();
        
        $service->es->fill($request->es);
        $service->es->save();
        
        return $service;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $service = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($service) { 

            $service->en = 
                $service
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $service->es =
                 $service
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$service) { 
            throw new ModelNotFoundException("ContractorService not found");
        }

        return $service;
    }
    
    public function delete($id)
    {
        $service = $this->model->find($id);
        
        if ($service && $this->canDelete($id)) {
            $service->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $service->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $service->delete();
        }

        return $service; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $service = new ContractorService;
        $service->en = new ContractorServiceTranslation;
        $service->es = new ContractorServiceTranslation;

        return $service;
    }
}