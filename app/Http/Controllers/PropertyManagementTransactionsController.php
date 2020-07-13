<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ PropertyManagement, PropertyManagementTransaction };
use App\Repositories\{
    PropertiesRepositoryInterface,
    TransactionTypesRepositoryInterface,
    PropertyManagementTransactionsRepositoryInterface,
    CitiesRepositoryInterface
};
use App\Helpers\{ PMHelper, PMTransactionHelper };

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

        return view('property-management-transactions.index')
            ->with('transactions', $transactions)
            ->with('pm', $pm)
            ->with('search', $search)
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
        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('property-management-transactions.general')
            ->with('transactions', $transactions)
            ->with('properties', $properties)
            ->with('transactionTypes', $transactionTypes)
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

    public function update(Request $request, PropertyManagement $pm, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('property-management-transactions.edit', [$pm->id, $id]) );
    }

    public function destroy(Request $request, PropertyManagement $pm, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('property-management-transactions', [$pm->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    public function auditBatch(Request $request, $transactionIDs)
    {
        $user = auth()->user();
        $transactionIDs = explode('_', $transactionIDs);

        if (count($transactionIDs)) {
            foreach($transactionIDs as $transactionID) {
                $transaction = PropertyManagementTransaction::find($transactionID);
                if ($transaction) {
                    $hasPreviousAudit = $transaction->audit_user_id;
                    if(!$hasPreviousAudit) {
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
            foreach($transactionIDs as $transactionID) {
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
            foreach($transactionIDs as $transactionID) {
                if ( $this->repository->canDelete($transactionID) ) {
                    $this->repository->delete($transactionID);
                }
            }
        }

        $request->session()->flash('success', __('Records deleted successfully'));
        return redirect()->back();
    }

    public function createBulk() {
        return view('property-management-transactions.create-bulk');
    }
}
