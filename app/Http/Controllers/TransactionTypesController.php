<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TransactionTypesRepositoryInterface;
use App\Models\TransactionType;

class TransactionTypesController extends Controller
{
    private $repository;

    public function __construct(TransactionTypesRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {   
        $search = trim($request->s);
        $transaction_types = $this->repository->all($search);
        
        return view('transaction-types.index')
            ->with('transaction_types', $transaction_types)
            ->with('search', $search);
    }

    public function create()
    {
        $transaction_type = $this->repository->blueprint();
        return view('transaction-types.create')->with('transaction_type', $transaction_type);
    }

    public function store(Request $request)
    {
        $transaction_type = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('transaction-types.edit', [$transaction_type->id]));
    }

    public function show(TransactionType $transaction_type)
    {   
        $transaction_type = $this->repository->find($transaction_type);        
        return view('transaction-types.show')->with('transaction_type', $transaction_type);
    }

    public function edit(TransactionType $transaction_type)
    {
        $transaction_type = $this->repository->find($transaction_type);
        return view('transaction-types.edit')->with('transaction_type', $transaction_type);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('transaction-types.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('transaction-types'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}