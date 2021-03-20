<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ PaymentMethod, PaymentMethodTranslation };
use App\Repositories\PaymentMethodsRepositoryInterface;
use App\Validations\PaymentMethodsValidations;

class PaymentMethodsRepository implements PaymentMethodsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->model = $paymentMethod;
        $this->validation = new PaymentMethodsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                PaymentMethodTranslation::where('title', 'like', "%".$search."%")
                    ->orWhere('payment_method_id', $search);
        } else {
            $query = PaymentMethodTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('paymentMethod')
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

        if ($is_new) {
            $paymentMethod = $this->blueprint();
            $paymentMethod->fill($request->all());
            $paymentMethod->save();
            
            $paymentMethod->en->language_id = LanguageHelper::getId('en');
            $paymentMethod->en->payment_method_id = $paymentMethod->id;
            
            $paymentMethod->es->language_id = LanguageHelper::getId('es');
            $paymentMethod->es->payment_method_id = $paymentMethod->id;
        }else{
            $paymentMethod = $this->find($id);
            $paymentMethod->fill($request->all());
            $paymentMethod->save();
        }

        $paymentMethod->en->fill($request->en);
        $paymentMethod->en->save();
        
        $paymentMethod->es->fill($request->es);
        $paymentMethod->es->save();
        
        return $paymentMethod;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $paymentMethod = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($paymentMethod) { 

            $paymentMethod->en = 
                $paymentMethod
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $paymentMethod->es =
                 $paymentMethod
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$paymentMethod) { 
            throw new ModelNotFoundException("Page not found");
        }

        return $paymentMethod;
    }
    
    public function delete($id)
    {
        $paymentMethod = $this->model->find($id);
        
        if ($paymentMethod) {

            $paymentMethod->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $paymentMethod->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $paymentMethod->delete();
        }

        return $paymentMethod; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $paymentMethod = new PaymentMethod;
        $paymentMethod->en = new PaymentMethodTranslation;
        $paymentMethod->es = new PaymentMethodTranslation;

        return $paymentMethod;
    }
}