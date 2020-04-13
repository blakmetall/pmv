<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\DamageDepositsRepositoryInterface;
use App\Models\DamageDeposit;

class DamageDepositsController extends Controller
{
    private $repository;

    public function __construct(DamageDepositsRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $damage_deposits = $this->repository->all($search);

        return view('damage-deposits.index')
            ->with('damage_deposits', $damage_deposits)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $damage_deposit = $this->repository->blueprint();
        return view('damage-deposits.create')->with('damage_deposit', $damage_deposit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $damage_deposit = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('damage-deposits.edit', [$damage_deposit->id]));
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DamageDeposit $damage_deposit)
    {
        $damage_deposit = $this->repository->find($damage_deposit);
        return view('damage-deposits.show')->with('damage_deposit', $damage_deposit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DamageDeposit $damage_deposit)
    {
        $damage_deposit = $this->repository->find($damage_deposit);
        return view('damage-deposits.edit')->with('damage_deposit', $damage_deposit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('damage-deposits.edit', [$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('damage-deposits'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}