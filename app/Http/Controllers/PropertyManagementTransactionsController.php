<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyManagement;
use App\Models\PropertyManagementTransaction;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\TransactionTypesRepositoryInterface;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Repositories\CitiesRepositoryInterface;
use App\Helpers\ImagesHelper;
use App\Helpers\PMHelper;
use App\Helpers\PMTransactionHelper;
use Illuminate\Support\Facades\Validator;
use Session;

class PropertyManagementTransactionsController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $transactionTypesRepository;
    private $citiesRepository;

    public function __construct(
        PropertyManagementTransactionsRepositoryInterface $repository,
        PropertiesRepositoryInterface $propertiesRepository,
        TransactionTypesRepositoryInterface $transactionTypesRepository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->citiesRepository = $citiesRepository;
        $this->propertiesRepository = $propertiesRepository;
        $this->transactionTypesRepository = $transactionTypesRepository;
    }

    public function index(Request $request, PropertyManagement $pm)
    {
        if (!$request->year && !$request->month) { // prepare year and month for first call
            $urlParams = [
                'year' => date('Y', strtotime('now')),
                'month' => date('m', strtotime('now')),
            ];

            $appendUrl = '?' . http_build_query($urlParams);
            $redirectUrl = route('property-management-transactions', [$pm->id]) . $appendUrl;

            $hasSuccess = $request->session()->get('success');
            if ($hasSuccess) {
                $request->session()->flash('success', $hasSuccess);
            }

            return redirect($redirectUrl);
        }

        $search = trim($request->s);

        $config = [
            'paginate' => false,
            'property_management_id' => $pm->id,
            'filterByYear' => $request->year,
            'filterByMonth' => $request->month,
        ];
        $transactions = $this->repository->all($search, $config);

        $config = [
            'filterByYear' => $request->year,
            'filterByMonth' => $request->month,
            'skipOldNotAudited' => true,
        ];
        $currentBalance = PMHelper::getBalance($pm->id, $config);

        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        return view('property-management-transactions.index')
            ->with('transactions', $transactions)
            ->with('pm', $pm)
            ->with('search', $search)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('currentBalance', $currentBalance);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);

        $config = [
            'filterByPendingAudits' => !!$request->filterByPendingAudits,
            'paginate' => false,
            'filterByProperty' => $request->property,
            'filterByTransactionType' => $request->transaction_type,
            'filterByCity' => $request->city,
            'filterByImage' => $request->withImage,
            'orderBy' => $request->orderBy,
            'orderDirection' => $request->orderDirection,
        ];
        $transactions = $this->repository->all($search, $config);

        // for search filters
        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();
        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('property-management-transactions.general')
            ->with('transactions', $transactions)
            ->with('properties', $properties)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('cities', $cities)
            ->with('search', $search);
    }

    public function create(PropertyManagement $pm)
    {
        $transaction = $this->repository->blueprint();
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        return view('property-management-transactions.create')
            ->with('transaction', $transaction)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('pm', $pm);
    }

    public function store(Request $request, PropertyManagement $pm)
    {
        $transaction = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-management-transactions.edit', [$pm->id, $transaction->id]));
    }

    public function show(PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        $transaction = $this->repository->find($transaction);
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        return view('property-management-transactions.show')
            ->with('transaction', $transaction)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('pm', $pm);
    }

    public function edit(PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        $transaction = $this->repository->find($transaction);
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        return view('property-management-transactions.edit')
            ->with('paymentTypes', $paymentTypes)
            ->with('transaction', $transaction)
            ->with('transactionTypes', $transactionTypes)
            ->with('pm', $pm);
    }

    public function editAjax(PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        $transaction = $this->repository->find($transaction);
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        return view('property-management-transactions.edit-ajax')
            ->with('paymentTypes', $paymentTypes)
            ->with('transaction', $transaction)
            ->with('transactionTypes', $transactionTypes)
            ->with('withModal', true)
            ->with('pm', $pm);
    }

    public function update(Request $request, PropertyManagement $pm, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        // redirect back if sent from modal
        if ($request->fromModal) {
            return redirect()->back();
        }

        return redirect(route('property-management-transactions.edit', [$pm->id, $id]));
    }

    public function destroy(Request $request, PropertyManagement $pm, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('property-management-transactions', [$pm->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    // generates the url and redirects to create new transaction for specific property management
    public function generatePMTransactionMonthly(Request $request, Property $property)
    {
        if ($property->management()->count()) {
            foreach ($property->management as $pm) {
                if (!$pm->is_finished) {
                    $transaction = $this->repository->saveMonthly($property, $pm->id);
                    
                    $request->session()->flash('success', __('Record deleted successfully'));
                    return redirect(route('property-management-transactions.edit', [$pm->id, $transaction->id]));
                }
            }
        }

        return redirect()->back();
    }

    public function auditBatch(Request $request, $transactionIDs)
    {
        $user = auth()->user();
        $transactionIDs = explode('_', $transactionIDs);

        if (count($transactionIDs)) {
            foreach ($transactionIDs as $transactionID) {
                $transaction = PropertyManagementTransaction::find($transactionID);
                if ($transaction) {
                    $hasPreviousAudit = $transaction->audit_user_id;
                    if (!$hasPreviousAudit) {
                        $transaction->audit_user_id = $user->id;
                        $transaction->audit_date = getCurrentDate();
                        $transaction->save();
                    }
                }
            }
        }

        $request->session()->flash('success', __('Records updated successfully'));
        return redirect()->back();
    }

    public function removeAuditBatch(Request $request, $transactionIDs)
    {
        $transactionIDs = explode('_', $transactionIDs);

        if (count($transactionIDs)) {
            foreach ($transactionIDs as $transactionID) {
                $transaction = PropertyManagementTransaction::find($transactionID);
                if ($transaction) {
                    $transaction->audit_user_id = null;
                    $transaction->audit_date = null;
                    $transaction->save();
                }
            }
        }

        $request->session()->flash('success', __('Records updated successfully'));
        return redirect()->back();
    }

    public function deleteBatch(Request $request, $transactionIDs)
    {
        $transactionIDs = explode('_', $transactionIDs);

        if (count($transactionIDs)) {
            foreach ($transactionIDs as $transactionID) {
                if ($this->repository->canDelete($transactionID)) {
                    $this->repository->delete($transactionID);
                }
            }
        }

        $request->session()->flash('success', __('Records deleted successfully'));
        return redirect()->back();
    }

    public function createBulk(Request $request)
    {
        $properties = $this->propertiesRepository->all('', [
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        // successful transactions after save -- data retrieval
        $successfulTransactions = false;
        if (Session::has('successfulTransactionIds')) {
            $successfulTransactionsIds = explode('_', Session::get('successfulTransactionIds'));
            $successfulTransactions = PropertyManagementTransaction::find($successfulTransactionsIds);
        }

        return view('property-management-transactions.create-bulk')
            ->with('properties', $properties)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('successfulTransactions', $successfulTransactions);
    }

    public function storeBulk(Request $request)
    {
        $shouldProcess = $request->bulk && is_array($request->bulk) && count($request->bulk);

        if ($shouldProcess) {
            $folder = 'transactions';
            $default = $request->bulk["default"];

            $successfulTransactionsIds = [];

            foreach ($request->bulk as $index => $transactionData) {
                if ($index !== "default") {
                    if (!$transactionData['property_management_id']) {
                        continue;
                    }

                    // fill default values
                    if (!$transactionData['transaction_type_id']) {
                        $transactionData['transaction_type_id'] = $default['transaction_type_id'];
                    }

                    if (!$transactionData['operation_type']) {
                        $transactionData['operation_type'] = $default['operation_type'];
                    }

                    if (!$transactionData['period_start_date']) {
                        $transactionData['period_start_date'] = $default['period_start_date'];
                    }

                    if (!$transactionData['period_end_date']) {
                        $transactionData['period_end_date'] = $default['period_end_date'];
                    }

                    if (!$transactionData['post_date']) {
                        $transactionData['post_date'] = $default['post_date'];
                    }

                    if (!$transactionData['amount']) {
                        $transactionData['amount'] = $default['amount'];
                    }

                    if (!$transactionData['description']) {
                        $transactionData['description'] = $default['description'];
                    }

                    $validator = Validator::make($transactionData, [
                        'post_date' => 'required|date_format:Y-m-d',
                        'period_start_date' => 'nullable|date_format:Y-m-d',
                        'period_end_date' => 'nullable|date_format:Y-m-d',
                        'amount' => 'required|numeric|min:0',
                        'operation_type' => 'required|numeric|between:1,2',
                        'transaction_file' => 'nullable|mimes:jpeg,png,bmp',
                    ]);

                    if (!$validator->fails()) {
                        $fileRequestPath = 'bulk.' . $index . '.transaction_file';

                        $transaction = $this->repository->blueprint();
                        $transaction->fill($transactionData);
                        $transaction->save();

                        // image save
                        if ($request->hasFile($fileRequestPath)) {
                            $img = $request->file($fileRequestPath);
                            $imgData = ImagesHelper::saveFile($img, $folder);

                            $transaction->file_extension = $imgData['file_extension'];
                            $transaction->file_slug = $imgData['file_slug'];
                            $transaction->file_original_name = $imgData['file_original_name'];
                            $transaction->file_name = $imgData['file_name'];
                            $transaction->file_path = $imgData['file_path'];
                            $transaction->file_url = $imgData['file_url'];

                            $transaction->save();
                        }

                        $successfulTransactionsIds[] = $transaction->id;
                    }
                }
            }

            Session::flash('successfulTransactionIds', implode('_', $successfulTransactionsIds));

            return redirect()->back();
        }

        return redirect()->back();
    }
}
