<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CleaningOptionsRepositoryInterface;
use App\Models\CleaningOption;

class CleaningOptionsController extends Controller
{
    private $repository;

    public function __construct(CleaningOptionsRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {   
        $search = trim($request->s);
        $cleaning_options = $this->repository->all($search);

        return view('cleaning-options.index')
            ->with('cleaning_options', $cleaning_options)
            ->with('search', $search);
    }

    public function create()
    {
        $cleaning_option = $this->repository->blueprint();
        return view('cleaning-options.create')->with('cleaning_option', $cleaning_option);
    }

    public function store(Request $request)
    {
        $cleaning_option = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('cleaning-options.edit', [$cleaning_option->id]));
    }

    public function show(CleaningOption $cleaning_option)
    {   
        $cleaning_option = $this->repository->find($cleaning_option);        
        return view('cleaning-options.show')->with('cleaning_option', $cleaning_option);
    }

    public function edit(CleaningOption $cleaning_option)
    {
        $cleaning_option = $this->repository->find($cleaning_option);
        return view('cleaning-options.edit')->with('cleaning_option', $cleaning_option);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect(route('cleaning-options.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('cleaning-options'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}