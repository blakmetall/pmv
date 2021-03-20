<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\AgenciesRepositoryInterface;

class AgenciesController extends Controller
{
    private $repository;

    public function __construct(
        AgenciesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $agencies = $this->repository->all($search, '');

        return view('agencies.index')
            ->with('agencies', $agencies)
            ->with('search', $search);
    }

    public function create()
    {
        $agency = $this->repository->blueprint();

        return view('agencies.create')
            ->with('agency', $agency);
    }

    public function store(Request $request)
    {
        $agency = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('agencies.edit', [$agency->id]));
    }

    public function show(Agency $agency)
    {
        $agency = $this->repository->find($agency);

        return view('agencies.show')
            ->with('agency', $agency);
    }


    public function edit(Agency $agency)
    {
        $agency = $this->repository->find($agency);

        return view('agencies.edit')
            ->with('agency', $agency);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('agencies.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('agencies'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
