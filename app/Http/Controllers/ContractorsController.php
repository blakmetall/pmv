<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Repositories\{ ContractorsRepositoryInterface, CitiesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\Contractor;

class ContractorsController extends Controller
{
    private $repository;
    private $citiesRepository;

    public function __construct(ContractorsRepositoryInterface $repository, CitiesRepositoryInterface $citiesRepository)
    {
        $this->repository = $repository;
        $this->citiesRepository = $citiesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $contractors = $this->repository->all($search);

        return view('contractors.index')
            ->with('contractors', $contractors)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contractor = $this->repository->blueprint();

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.create')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contractor = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('contractors.edit', [$contractor->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contractor $contractor)
    {
        $contractor = $this->repository->find($contractor);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.show')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contractor $contractor)
    {
        $contractor = $this->repository->find($contractor);
        
        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);

        return view('contractors.edit')
            ->with('cities', $cities)
            ->with('contractor', $contractor);
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
        return redirect( route('contractors.edit', [$id]) );
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
            return redirect(route('contractors'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
