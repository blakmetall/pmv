<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ PropertyManagement, PropertyManagementTransaction };
use App\Repositories\{
    PropertyManagementTransactionsRepositoryInterface,
    TransactionTypesRepositoryInterface
};
use App\Helpers\PMTransactionHelper;

class PropertyManagementTransactionsController extends Controller
{
    private $repository;
    private $transactionTypesRepository;

    public function __construct(
        PropertyManagementTransactionsRepositoryInterface $repository,
        TransactionTypesRepositoryInterface $transactionTypesRepository
    ) {
        $this->repository = $repository;
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

        $config = ['property_management_id' => $pm->id];
        $config['filterByYear'] = $request->year;
        $config['filterByMonth'] = $request->month;

        $transactions = $this->repository->all($search, $config);

        return view('property-management-transactions.index')
            ->with('transactions', $transactions)
            ->with('pm', $pm)
            ->with('search', $search);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);

        $config = ['filterByPendingAudits' => !!$request->filterByPendingAudits];
        $transactions = $this->repository->all($search, $config);

        return view('property-management-transactions.general')
            ->with('transactions', $transactions)
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
}
