<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ DamageDeposit, DamageDepositTranslation };
use App\Repositories\DamageDepositsRepositoryInterface;
use App\Validations\DamageDepositsValidations;

class DamageDepositsRepository implements DamageDepositsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(DamageDeposit $damage_deposit)
    {
        $this->model = $damage_deposit;
        $this->validation = new DamageDepositsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();
        
        if ($search) {
            $query = DamageDepositTranslation::where('description', 'like', "%".$search."%");
        } else {
            $query = DamageDepositTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('damageDeposit')
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
        $is_new = ! $id;

        $checkboxesConfig = ['is_refundable' => 0];
        $requestData = array_merge($checkboxesConfig, $request->all());

        if ($is_new) {
            $damage_deposit = $this->blueprint();
            $damage_deposit->fill($requestData);
            $damage_deposit->save();
            
            $damage_deposit->en->language_id = LanguageHelper::getId('en');
            $damage_deposit->en->damage_deposit_id = $damage_deposit->id;
            
            $damage_deposit->es->language_id = LanguageHelper::getId('es');
            $damage_deposit->es->damage_deposit_id = $damage_deposit->id;
        }else{
            $damage_deposit = $this->find($id);
            $damage_deposit->fill($requestData);
            $damage_deposit->save();
        }  

        $damage_deposit->en->fill($request->en);
        $damage_deposit->en->save();
        
        $damage_deposit->es->fill($request->es);
        $damage_deposit->es->save();
        
        return $damage_deposit;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $damage_deposit = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($damage_deposit) { 

            $damage_deposit->en = 
                $damage_deposit
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $damage_deposit->es =
                 $damage_deposit
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$damage_deposit) { 
            throw new ModelNotFoundException("DamageDeposit not found");
        }

        return $damage_deposit;
    }
    
    public function delete($id)
    {
        $damage_deposit = $this->model->find($id);
        
        if ($damage_deposit && $this->canDelete($id)) {
            $damage_deposit->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $damage_deposit->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $damage_deposit->delete();
        }

        return $damage_deposit; 
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 3;

        $damage_deposit = $this->model->find($id);
        if($damage_deposit) {

            // validation empty usage in bookings
            if ($damage_deposit->bookings()->count()) {
                return false;
            }

            // validation empty usage in reservation_requests
            if ($damage_deposit->reservationRequests()->count()) {
                return false;
            }
        }


        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $damage_deposit = new DamageDeposit;
        $damage_deposit->en = new DamageDepositTranslation;
        $damage_deposit->es = new DamageDepositTranslation;

        return $damage_deposit;
    }
}