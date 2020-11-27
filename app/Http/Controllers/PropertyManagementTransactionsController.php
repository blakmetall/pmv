<?php

namespace App\Http\Controllers;

use App\Helpers\ImagesHelper;
use App\Helpers\PMHelper;
use App\Helpers\PMTransactionHelper;
use App\Models\Property;
use App\Models\PropertyManagement;
use App\Models\PropertyManagementTransaction;
use App\Models\User;
use App\Notifications\DetailsTransaction;
use App\Repositories\CitiesRepositoryInterface;
use App\Repositories\OfficesRepositoryInterface;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use App\Repositories\TransactionTypesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class PropertyManagementTransactionsController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $transactionTypesRepository;
    private $officesRepository;
    private $citiesRepository;

    public function __construct(
        PropertyManagementTransactionsRepositoryInterface $repository,
        PropertiesRepositoryInterface $propertiesRepository,
        TransactionTypesRepositoryInterface $transactionTypesRepository,
        OfficesRepositoryInterface $officesRepository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->officesRepository = $officesRepository;
        $this->citiesRepository = $citiesRepository;
        $this->propertiesRepository = $propertiesRepository;
        $this->transactionTypesRepository = $transactionTypesRepository;
    }

    public function index(Request $request, PropertyManagement $pm)
    {
        Session::flash('backUrl', $request->fullUrl());
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
            'filterByPendingAudits' => (bool) $request->filterByPendingAudits,
            'paginate' => false,
            'filterByProperty' => $request->property,
            'filterByTransactionType' => $request->transaction_type,
            'filterByOffice' => $request->office,
            'filterByImage' => $request->withImage,
            'orderBy' => $request->orderBy ? $request->orderBy : 'property', // ordenar por propiedad por defecto
            'orderDirection' => $request->orderDirection ? $request->orderDirection : 'asc',
        ];
        $transactions = $this->repository->all($search, $config);

        // obtiene las transacciones a elegir para el buscador de acuerdo a filtros de búsqueda mandados
        $config = [
            'filterByPendingAudits' => (bool) $request->filterByPendingAudits,
            'paginate' => false,
            'filterByProperty' => $request->property,
            'filterByOffice' => $request->office,
            'filterByImage' => $request->withImage,
        ];
        $pendingTransactions = $this->repository->all($search, $config);
        $transationTypesOptionsIds = false;
        if ($pendingTransactions) {
            $transationTypesOptionsIds = [];
            foreach ($pendingTransactions as $pt) {
                $transationTypesOptionsIds[] = $pt->transaction_type_id;
            }
        }

        // for search filters
        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByEnabled' => true,
        ]);
        $transactionTypes = $this->transactionTypesRepository->all('', ['paginate' => false]);
        $paymentTypes = PMTransactionHelper::getTypes();

        $offices = $this->officesRepository->all('', ['paginate' => false]);

        return view('property-management-transactions.general')
            ->with('transactions', $transactions)
            ->with('properties', $properties)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('offices', $offices)
            ->with('search', $search)
            ->with('transationTypesOptionsIds', $transationTypesOptionsIds);
    }

    public function create(PropertyManagement $pm)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
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
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        $transaction = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return ($url = Session::get('backUrl')) ? redirect($url) : redirect(route('property-management-transactions.edit', [$pm->id, $transaction->id]));
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
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
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
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        // redirect back if sent from modal
        if ($request->fromModal) {
            return redirect()->back();
        }

        return ($url = Session::get('backUrl')) ? redirect($url) : redirect(route('property-management-transactions', [$pm->id]));

        // return redirect(route('property-management-transactions.edit', [$pm->id, $id]));
    }

    public function destroy(Request $request, PropertyManagement $pm, $id)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            if (isset($request->year)) {
                return redirect()->back();
            }

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

                    if (!$transaction) {
                        $request->session()->flash('error', __('All Cleaning Services must be finished'));

                        return redirect()->back();
                    } else {
                        $request->session()->flash('success', __('Record created successfully'));

                        return redirect(route('property-management-transactions.edit', [$pm->id, $transaction->id]));
                    }
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

        // successfull transactions after save -- data retrieval
        $successfullTransactions = false;
        if (Session::has('successfullTransactionsIds')) {
            $successfullTransactionsIds = explode('_', Session::get('successfullTransactionsIds'));
            $successfullTransactions = PropertyManagementTransaction::find($successfullTransactionsIds);
        }

        return view('property-management-transactions.create-bulk')
            ->with('properties', $properties)
            ->with('transactionTypes', $transactionTypes)
            ->with('paymentTypes', $paymentTypes)
            ->with('successfullTransactions', $successfullTransactions);
    }

    public function storeBulk(Request $request)
    {
        $shouldProcess = $request->bulk && is_array($request->bulk) && count($request->bulk);

        if ($shouldProcess) {
            $folder = 'transactions';
            $default = $request->bulk['default'];

            $successfullTransactionsIds = [];

            foreach ($request->bulk as $index => $transactionData) {
                if ($index !== 'default') {
                    if (!$transactionData['property_management_id'] && !$transactionData['amount']) {
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

                        $successfullTransactionsIds[] = $transaction->id;
                    }
                }
            }

            Session::flash('successfullTransactionsIds', implode('_', $successfullTransactionsIds));

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function confirmEmail(Request $request)
    {
        $transaction = PropertyManagementTransaction::find($request->source);
        $pm = $transaction->propertyManagement;
        if ($pm->property->users->isNotEmpty()) {
            foreach ($pm->property->users as $getUser) {
                $getUser = User::find($getUser->id);
            }
        }

        $period = $transaction->period_start_date . ' - ' . $transaction->period_end_date;
        $operationType = $transaction->operation_type == config('constants.operation_types.charge') ? __('Charge') : __('Credit');

        $msg  = '';
        if ($getUser) {
            $msg .= 'Hello ' . $getUser->profile->full_name . '<br><br>';
            $msg .= 'Transaction' . ': ' . $transaction->id . '<br>';
            $msg .= 'Post Date' . ': <strong>' . $transaction->post_date . '</strong><br>';
            $msg .= 'Description' . ':' . $transaction->description . '<br>';
            $msg .= 'Period' . ': <strong>' . $period . '</strong><br>';
            $msg .= 'Operation' . ': <strong>' . $transaction->type->translate()->name . '</strong><br>';
            $msg .= 'Operation Type' . ': <strong>' . $operationType . '</strong><br>';
            $msg .= 'Amount' . ': <strong>' . priceFormat($transaction->amount) . ' USD</strong><br>';
            $msg .= '<hr>';
            $msg .= 'Hola ' . $getUser->profile->full_name . '<br><br>';
            $msg .= 'Transacción' . ': ' . $transaction->id . '<br>';
            $msg .= 'Fecha' . ': <strong>' . $transaction->post_date . '</strong><br>';
            $msg .= 'Descripción' . ':' . $transaction->description . '<br>';
            $msg .= 'Periodo' . ': <strong>' . $period . '</strong><br>';
            $msg .= 'Operación' . ': <strong>' . $transaction->type->translate()->name . '</strong><br>';
            $msg .= 'Tipo de operación' . ': <strong>' . $operationType . '</strong><br>';
            $msg .= 'Cantidad' . ': <strong>' . priceFormat($transaction->amount) . ' USD</strong><br>';
        }

        return $msg;
    }

    public function email(Request $request, PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        if ($pm->property->users->isNotEmpty()) {
            foreach ($pm->property->users as $getUser) {
                $getUser = User::find($getUser->id);
                $getUser->notify(new DetailsTransaction($transaction));
            }
        }

        $request->session()->flash('success', __('Email sended successfully'));

        return redirect()->back();
    }
}
