<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Models\Property;
use App\Models\PropertyManagement;
use App\Models\PropertyManagementTransaction;
use App\Validations\PropertyManagementTransactionsValidations;
use App\Helpers\ImagesHelper;
use App\Helpers\LanguageHelper;
use Carbon\Carbon;

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
        $shouldFilterByImage = isset($config['filterByImage']) ? $config['filterByImage'] : ''; // withImage value: 1 || 2

        $orderByFilter = isset($config['orderBy']) ? $config['orderBy'] : '';
        $orderByDirectionFilter = isset($config['orderDirection']) ? $config['orderDirection'] : '';

        if ($search) {
            $query = PropertyManagementTransaction::where(function ($q) use ($search) {
                $q->where('id', $search);
                $q->orWhere('amount', 'like', '%' . $search . '%');
                $q->orWhere('post_date', $search);
                $q->orWhere('period_start_date', $search);
                $q->orWhere('period_end_date', $search);
                $q->orWhere('created_at', 'like', '%' . $search . '%');
                $q->orWhere('updated_at', 'like', '%' . $search . '%');
            })
                ->orWhere('description', 'like', '%' . $search . '%');
        } else {
            $query = PropertyManagementTransaction::query();
        }

        if ($hasPropertyManagementID) {
            $query->where('property_management_id', $config['property_management_id']);
        }

        if ($shouldFilterByPendingAudits) {
            $query->whereNull('audit_user_id');
        }

        if ($shouldFilterByYear && $shouldFilterByMonth) {
            $query->where(function ($q) use ($config) {
                $q->where(function ($q2) use ($config) {
                    $q2->whereYear('post_date', $config['filterByYear']);
                    $q2->whereMonth('post_date', $config['filterByMonth']);
                });
                $q->orWhereNull('audit_user_id');
            });
        }

        if ($shouldFilterByProperty) {
            $propertyID = $config['filterByProperty'];
            $query->whereHas('propertyManagement', function ($q) use ($propertyID) {
                $q->whereHas('property', function ($q2) use ($propertyID) {
                    $q2->where('properties.id', $propertyID);
                });
            });
        }

        if ($shouldFilterByCity) {
            $cityID = $config['filterByCity'];
            $query->whereHas('propertyManagement', function ($q) use ($cityID) {
                $q->whereHas('property', function ($q2) use ($cityID) {
                    $q2->whereHas('city', function ($q3) use ($cityID) {
                        $q3->where('cities.id', $cityID);
                    });
                });
            });
        }

        if ($shouldFilterByImage) {
            if ($shouldFilterByImage == 1) {
                $query->where('file_url', '!=', '');
            } elseif ($shouldFilterByImage == 2) {
                $query->whereNull('file_url');
            }
        }

        if ($shouldFilterByTransactionType) {
            $query->where('transaction_type_id', $config['filterByTransactionType']);
        }

        $query->with('propertyManagement');
        $query->with('auditedBy');

        // ordering section
        if ($shouldFilterByPendingAudits) {
            if ($orderByFilter && $orderByDirectionFilter) {
                if ($orderByFilter == 'date') { // order by date
                    $direction = $orderByDirectionFilter == 'down' ? 'asc' : 'desc';
                    $query->orderBy('post_date', $direction);
                } elseif ($orderByFilter == 'property') { // order by property name
                    $query->select('property_management_transactions.*');
                    $query->join('property_management', 'property_management_transactions.property_management_id', '=', 'property_management.id');
                    $query->join('properties', 'property_management.property_id', '=', 'properties.id');
                    $query->join('properties_translations', 'properties_translations.property_id', '=', 'properties.id');

                    $direction = $orderByDirectionFilter == 'down' ? 'desc' : 'asc';
                    $query->orderBy('properties.id', $direction);

                    $lang = LanguageHelper::current();
                    $query->where('properties_translations.language_id', $lang->id);
                }
            } else {
                $query->orderBy('post_date', 'asc');
            }
        } else {
            $query->orderBy('post_date', 'asc');
        }

        if ($shouldPaginate) {
            $result = $query->paginate(config('constants.pagination.per-page'));
        } else {
            $result = $query->get();
        }

        return $result;
    }

    public function create(Request $request, $property = null)
    {
        $this->validation->validate('create', $request);
        return $this->save($request);
    }

    public function saveMonthly(Property $property, $pm)
    {
        $transaction = $this->blueprint();
        $currentMonth = Carbon::now();
        $currentMonthFormat = $currentMonth->format('Y-m-d');
        $cleaningServices = $property->monthlyCleaningServices($currentMonth->format('m'), $currentMonth->format('Y'));
        $amount = 0;
        $description = '';
        foreach ($cleaningServices as $cleaningService) {
            $amount += $cleaningService->total_cost;
            $description .=
                "#" . strval($cleaningService->id) . ' - ' .
                $cleaningService->date . ' - ' .
                '$' . $cleaningService->total_cost . "\n";
        };
        $transaction->property_management_id = $pm;
        $transaction->transaction_type_id = 46;
        $transaction->period_start_date = $currentMonth->format('Y-m') . '-01';
        $transaction->period_end_date = $currentMonth->lastOfMonth();
        $transaction->post_date = $currentMonthFormat;
        $transaction->amount = $amount;
        $transaction->operation_type = 2;
        $transaction->description = $description;
        $transaction->save();

        return $transaction;
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $folder = 'transactions';
        $is_new = !$id;

        if ($is_new) {
            $transaction = $this->blueprint();
        } else {
            $transaction = $this->find($id);
        }

        $transaction->fill($request->all());
        $transaction->save();

        // file management
        $hasUploadedFile = $request->hasFile('transaction_file');
        $hasOldFile = $transaction->file_path ? true : false;
        $oldFilePath = $hasOldFile ? $transaction->file_path : '';

        if ($hasUploadedFile) {
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
                if (!$hasPreviousAudit) {
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
            // deshabilitada temporalmente restriccion de eliminación de transacción en caso que esté editada

            // $hasBeenAudited = $transaction->audit_user_id;
            // if ($hasBeenAudited) {
            //     return false;
            // }
        }

        return true;
    }

    public function blueprint()
    {
        return new PropertyManagementTransaction;
    }
}
