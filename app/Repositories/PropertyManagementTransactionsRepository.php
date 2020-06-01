<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Models\{ PropertyManagement, PropertyManagementTransaction };
use App\Validations\PropertyManagementTransactionsValidations;

class PropertyManagementTransactionsRepository implements PropertyManagementTransactionsRepositoryInterface
{
    protected $model;

    public function __construct(PropertyManagementTransaction $transaction)
    {
        $this->model = $transaction;
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyManagementID = isset($config['property_management_id']) ? $config['property_management_id'] : '';
        $shouldFilterByPendingAudits = isset($config['filterByPendingAudits']) ? $config['filterByPendingAudits'] : '';

        if ($search) {
            $query =
                PropertyManagementTransaction::
                where('period_start_date', $search)
                    ->orWhere('period_end_date', $search)
                    ->orWhere('description', 'like', '%'.$search.'%');
        } else {
            $query = PropertyManagementTransaction::query();
        }

        if($hasPropertyManagementID) {
            $query->where('property_management_id', $config['property_management_id']);
        }

        if($shouldFilterByPendingAudits) {
            $query->whereNull('audit_user_id');
        }

        $query->with('propertyManagement');
        $query->with('auditedBy');
        $query->orderBy('period_start_date', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }

        return $result;
    }

    public function create(Request $request)
    {
        PropertyManagementTransactionsValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertyManagementTransactionsValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $transaction = $this->blueprint();
        }else{
            $transaction = $this->find($id);
        }

        $transaction->fill($request->all());
        $transaction->save();

        return $transaction;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $pm = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$pm) {
            throw new ModelNotFoundException("PropertyManagementTransaction not found");
        }

        return $pm;
    }

    public function delete($id)
    {
        $transaction = $this->model->find($id);
        
        if ($transaction && $this->canDelete($id)) {
            $transaction->delete();
        }

        return $transaction;
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $transaction = new PropertyManagementTransaction;
        return $transaction;
    }
}
