<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Models\{ PropertyManagement, PropertyManagementTransaction };
use App\Validations\PropertyManagementTransactionsValidations;
use App\Helpers\ImagesHelper;

class PropertyManagementTransactionsRepository implements PropertyManagementTransactionsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyManagementTransaction $transaction)
    {
        $this->model = $transaction;
        $this->validation = new PropertyManagementTransactionsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyManagementID = isset($config['property_management_id']) ? $config['property_management_id'] : '';
        $shouldFilterByPendingAudits = isset($config['filterByPendingAudits']) ? $config['filterByPendingAudits'] : '';
        $shouldFilterByYear = isset($config['filterByYear']) ? $config['filterByYear'] : '';
        $shouldFilterByMonth = isset($config['filterByMonth']) ? $config['filterByMonth'] : '';

        $shouldFilterByProperty = isset($config['filterByProperty']) ? $config['filterByProperty'] : '';
        $shouldFilterByTransactionType = isset($config['filterByTransactionType']) ? $config['filterByTransactionType'] : '';
        $shouldFilterByCity = isset($config['filterByCity']) ? $config['filterByCity'] : '';

        if ($search) {
            $query = PropertyManagementTransaction::where('description', 'like', '%'.$search.'%');
        } else {
            $query = PropertyManagementTransaction::query();
        }

        if($hasPropertyManagementID) {
            $query->where('property_management_id', $config['property_management_id']);
        }

        if($shouldFilterByPendingAudits) {
            $query->whereNull('audit_user_id');
        }

        if($shouldFilterByYear) {
            $query->whereYear('post_date', $config['filterByYear']);
        }

        if($shouldFilterByMonth) {
            $query->whereMonth('post_date', $config['filterByMonth']);
        }

        if($shouldFilterByProperty) {
            $propertyID = $config['filterByProperty'];
            $query->whereHas('propertyManagement', function($q) use ($propertyID) {
                $q->whereHas('property', function($q2) use ($propertyID) {
                    $q2->where('properties.id', $propertyID);
                });
            });
        }

        if($shouldFilterByCity) {
            $cityID = $config['filterByCity'];
            $query->whereHas('propertyManagement', function($q) use ($cityID) {
                $q->whereHas('property', function($q2) use ($cityID) {
                    $q2->whereHas('city', function($q3) use ($cityID) {
                        $q3->where('cities.id', $cityID);
                    });
                });
            });
        }

        if($shouldFilterByTransactionType) {
            $query->where('transaction_type_id', $config['filterByTransactionType']);
        }

        $query->with('propertyManagement');
        $query->with('auditedBy');

        if ($shouldFilterByPendingAudits) {
            $query->orderBy('post_date', 'desc');
        } else {
            $query->orderBy('post_date', 'asc');
        }

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
        $folder = 'transactions';
        $is_new = ! $id;

        if($is_new){
            $transaction = $this->blueprint();
        }else{
            $transaction = $this->find($id);
        }

        $transaction->fill($request->all());
        $transaction->save();

        // file management
        $hasUploadedFile = $request->hasFile( 'transaction_file' );
        $hasOldFile = $transaction->file_path ? true : false;
        $oldFilePath = $hasOldFile ? $transaction->file_path : '';

        if($hasUploadedFile){
            $img = $request->transaction_file;
            $imgData = ImagesHelper::saveFile($img, $folder);

            $transaction->file_extension = $imgData['file_extension'];
            $transaction->file_slug = $imgData['file_slug'];
            $transaction->file_original_name = $imgData['file_original_name'];
            $transaction->file_name = $imgData['file_name'];
            $transaction->file_path = $imgData['file_path'];
            $transaction->file_url = $imgData['file_url'];  
            $transaction->save();

            if ($hasOldFile) {
                ImagesHelper::deleteFile($oldFilePath);
                ImagesHelper::deleteThumbnails($oldFilePath);
            }
        }

        // audit updates only when transaction has file
        $hasPreviousAudit = $transaction->audit_user_id;
        
        if ($transaction->file_path) {
            if ($request->do_audit) {
                if(!$hasPreviousAudit) {
                    $user = auth()->user();
                    $transaction->audit_user_id = $user->id;
                    $transaction->audit_date = getCurrentDate();
                }
            } else {
                $transaction->audit_user_id = null;
                $transaction->audit_date = null;
            }
            $transaction->save();
        }
        
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
            ImagesHelper::deleteFile($transaction->file_path);
            ImagesHelper::deleteThumbnails($transaction->file_path);
        }

        return $transaction;
    }

    public function canDelete($id)
    {
        $transaction = $this->model->find($id);

        if ($transaction) {
            $hasBeenAudited = $transaction->audit_user_id;
            if ($hasBeenAudited) {
                return false;
            }
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyManagementTransaction;
    }
}
