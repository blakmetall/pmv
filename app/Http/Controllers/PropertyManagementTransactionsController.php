<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ PropertyManagement, PropertyManagementTransaction };
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;

class PropertyManagementTransactionsController extends Controller
{
    private $repository;

    public function __construct(PropertyManagementTransactionsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PropertyManagement $pm)
    {
        $search = trim($request->s);
        $transactions = $this->repository->all($search);

        return view('property-management-transactions.index')
            ->with('transactions', $transactions)
            ->with('pm', $pm)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PropertyManagement $pm)
    {
        $transaction = $this->repository->blueprint();

        return view('property-management-transactions.create')
            ->with('transaction', $transaction)
            ->with('pm', $pm);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PropertyManagement $pm)
    {
        $pm = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-management-transactions.edit', [$pm->id, $pm->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        $transaction = $this->repository->find($transaction);

        return view('property-management-transactions.show')
            ->with('transaction', $transaction)
            ->with('pm', $pm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyManagement $pm, PropertyManagementTransaction $transaction)
    {
        $pm = $this->repository->find($pm);

        return view('property-management-transactions.edit')
            ->with('transaction', $transaction)
            ->with('pm', $pm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyManagement $pm, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('property-management-transactions.edit', [$pm->id, $id]) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
