<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\DemageDepositsRepositoryInterface;
use App\Models\{ DamageDeposit, DamageDepositTranslation };
use App\Helpers\LanguageHelper;

class DamageDepositsRepository implements DemageDepositsRepositoryInterface
{
    protected $model;

    public function __construct(DamageDeposit $damage_deposit)
    {
        $this->model = $damage_deposit;
    }

    public function all($search = '')
    {
        $lang = LanguageHelper::current();

        if ($search) {
            $query = DamageDepositTranslation::where('description', 'like', "%".$search."%");
        } else {
            $query = new DamageDepositTranslation;
        }

        return $query
            ->where('language_id', $lang->id)
            ->with('damageDeposits')
            ->orderBy('description', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        //echo $request->price;
        //exit();

        $is_refundable = 0;
        if($request->is_refundable){
            $is_refundable = 1;
        }

        if ($is_new) {
            $damage_deposit = $this->blueprint();

           

            $damage_deposit->save();

            
            
            $damage_deposit->en->language_id = LanguageHelper::getId('en');
            $damage_deposit->en->damage_deposit_id = $damage_deposit->id;
            
            $damage_deposit->es->language_id = LanguageHelper::getId('es');
            $damage_deposit->es->damage_deposit_id = $damage_deposit->id;

            

            

        }else{
            $damage_deposit = $this->find($id);

            $damage_deposit->price = $request->price;
            $damage_deposit->is_refundable = $is_refundable;
            
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
        
        if ($damage_deposit) { // prepare translations

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

        if (!$damage_deposit) { // not found exception
            throw new ModelNotFoundException("DamageDeposit not found");
        }

        return $damage_deposit;
    }
    
    public function delete($id)
    {
        $damage_deposit = 
            $this->model
                ->where('id', '>', '91') // to avoid deleting seed items
                ->find($id);
        
        if ($damage_deposit) {
            $damage_deposit->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $damage_deposit->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $damage_deposit->delete();
        }

        // return recently deleted object to be used if needed after operation
        // the object may or may not exists
        return $damage_deposit; 
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $damage_deposit = new DamageDeposit;
        $damage_deposit->en = new DamageDepositTranslation;
        $damage_deposit->es = new DamageDepositTranslation;

        return $damage_deposit;
    }
}