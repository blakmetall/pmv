<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\PagesRepositoryInterface;

class PagesController extends Controller
{
    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $pages = $this->repository->all($search, '');

        return view('pages.index')
            ->with('pages', $pages)
            ->with('search', $search);
    }

    public function create()
    {
        $page = $this->repository->blueprint();

        return view('pages.create')
            ->with('page', $page);
    }

    public function store(Request $request)
    {
        $page = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('pages.edit', [$page->id]));
    }

    public function show(Page $page)
    {
        $page = $this->repository->find($page);

        return view('pages.show')
            ->with('page', $page);
    }


    public function edit(Page $page)
    {
        $page = $this->repository->find($page);

        return view('pages.edit')
            ->with('page', $page);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('pages.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('pages'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
