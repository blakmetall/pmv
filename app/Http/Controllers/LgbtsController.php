<?php

namespace App\Http\Controllers;

use App\Models\Lgbt;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\LgbtsRepositoryInterface;

class LgbtsController extends Controller
{
    private $repository;

    public function __construct(
        LgbtsRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $lgbts = $this->repository->all($search, '');

        return view('lgbts.index')
            ->with('lgbts', $lgbts)
            ->with('search', $search);
    }

    public function create()
    {
        $lgbt = $this->repository->blueprint();

        return view('lgbts.create')
            ->with('lgbt', $lgbt);
    }

    public function store(Request $request)
    {
        $lgbt = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('lgbts.edit', [$lgbt->id]));
    }

    public function show(Lgbt $lgbt)
    {
        $lgbt = $this->repository->find($lgbt);

        return view('lgbts.show')
            ->with('lgbt', $lgbt);
    }


    public function edit(Lgbt $lgbt)
    {
        $lgbt = $this->repository->find($lgbt);

        return view('lgbts.edit')
            ->with('lgbt', $lgbt);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('lgbts.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('lgbts'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
