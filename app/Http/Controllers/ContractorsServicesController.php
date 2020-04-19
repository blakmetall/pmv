<?php

namespace App\Http\Controllers;

use App\Repositories\{ ContractorsServicesRepositoryInterface, ContractorsRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\ContractorService;

class ContractorsServicesController extends Controller
{
    private $repository;
    private $contractorsRepository;

    public function __construct(
        ContractorsServicesRepositoryInterface $repository, 
        ContractorsRepositoryInterface $contractorsRepository
    )
    {
        $this->repository = $repository;
        $this->contractorsRepository = $contractorsRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);        
        $services = $this->repository->all($search);

        // echo '<pre>', print_r($services), '<pre>'; exit; 

        return view('contractors-services.index')
            ->with('services', $services)
            ->with('search', $search);
        }
        
        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $service = $this->repository->blueprint();
            
            $contractorsConfig = ['paginate' => false];
            $contractors = $this->contractorsRepository->all('', $contractorsConfig);
            
            return view('contractors-services.create')
                ->with('service', $service)
                ->with('contractors', $contractors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('contractors-services.edit', [$service->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContractorService $service)
    {
        $service = $this->repository->find($service);

        $contractorsConfig = ['paginate' => false];
        $contractors = $this->contractorsRepository->all('', $contractorsConfig);

        return view('contractors-services.show')
            ->with('service', $service)
            ->with('contractors', $contractors);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContractorService $service)
    {
        $service = $this->repository->find($service);
        
        $contractorsConfig = ['paginate' => false];
        $contractors = $this->contractorsRepository->all('', $contractorsConfig);

        return view('contractors-services.edit')
            ->with('service', $service)
            ->with('contractors', $contractors);
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
        return redirect( route('contractors-services.edit', [$id]) );
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
            return redirect(route('contractors-services'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
