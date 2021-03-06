<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ TransactionType, TransactionTypeTranslation };
use App\Repositories\TransactionTypesRepositoryInterface;
use App\Validations\TransactionTypesValidations;

class TransactionTypesRepository implements TransactionTypesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(TransactionType $transaction_type)
    {
        $this->model = $transaction_type;
        $this->validation = new TransactionTypesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        
        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                TransactionTypeTranslation::where('name', 'like', "%".$search."%");
        } else {
            $query = TransactionTypeTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('transactionType')
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
            $transaction_type = $this->blueprint();
            $transaction_type->save();
            
            $transaction_type->en->language_id = LanguageHelper::getId('en');
            $transaction_type->en->transaction_type_id = $transaction_type->id;
            
            $transaction_type->es->language_id = LanguageHelper::getId('es');
            $transaction_type->es->transaction_type_id = $transaction_type->id;
        }else{
            $transaction_type = $this->find($id);
        }

        $transaction_type->en->fill($request->en);
        $transaction_type->en->save();
        
        $transaction_type->es->fill($request->es);
        $transaction_type->es->save();
        
        return $transaction_type;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $transaction_type = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($transaction_type) { 

            $transaction_type->en = 
                $transaction_type
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $transaction_type->es =
                 $transaction_type
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$transaction_type) { 
            throw new ModelNotFoundException("TransactionType not found");
        }

        return $transaction_type;
    }
    
    public function delete($id)
    {
        $transaction_type = $this->model->find($id);
        
        if ($transaction_type && $this->canDelete($id)) {
            $transaction_type->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $transaction_type->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $transaction_type->delete();
        }

        return $transaction_type; 
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 84;
        
        $transaction_type = $this->find($id);
        if ($transaction_type) {

            // validate empty usage in property-management-transactions
            if($transaction_type->pmTransactions()->count()) {
                return false;
            }
        }

        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $transaction_type = new TransactionType;
        $transaction_type->en = new TransactionTypeTranslation;
        $transaction_type->es = new TransactionTypeTranslation;

        return $transaction_type;
    }
}