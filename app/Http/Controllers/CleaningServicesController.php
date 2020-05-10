<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    CleaningServicesRepositoryInterface,
    CleaningStaffRepositoryInterface,
    PropertiesRepositoryInterface
};
use App\Models\CleaningService;

class CleaningServicesController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $cleaningStaffRepository;

    public function __construct(
        CleaningServicesRepositoryInterface $repository,
        CleaningStaffRepositoryInterface $cleaningStaffRepository,
        PropertiesRepositoryInterface $propertiesRepository
    )
    {
        $this->repository           = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->cleaningStaffRepository = $cleaningStaffRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $cleaning_services = $this->repository->all($search);

        return view('cleaning-services.index')
            ->with('cleaning_services', $cleaning_services)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cleaning_service = $this->repository->blueprint();

        $propertiesConfig = ['paginate' => false];
        $properties = $this->propertiesRepository->all('', $propertiesConfig);

        $configCleaningStaff = ['paginate' => false];
        $cleaning_staff = $this->cleaningStaffRepository->all('', $configCleaningStaff);

        return view('cleaning-services.create')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cleaning_service = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('cleaning-services.edit', [$cleaning_service->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CleaningService $cleaning_service)
    {
        $cleaning_service = $this->repository->find($cleaning_service);

        $propertiesConfig = ['paginate' => false];
        $properties = $this->propertiesRepository->all('', $propertiesConfig);

        $configCleaningStaff = ['paginate' => false];
        $cleaning_staff = $this->cleaningStaffRepository->all('', $configCleaningStaff);

        return view('cleaning-services.show')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CleaningService $cleaning_service)
    {
        $cleaning_service = $this->repository->find($cleaning_service);

        $propertiesConfig = ['paginate' => false];
        $properties = $this->propertiesRepository->all('', $propertiesConfig);

        $configCleaningStaff = ['paginate' => false];
        $cleaning_staff = $this->cleaningStaffRepository->all('', $configCleaningStaff);

        return view('cleaning-services.edit')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
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
        return redirect( route('cleaning-services.edit', [$id]) );
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
            return redirect(route('cleaning-services'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
