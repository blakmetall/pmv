<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    CleaningServicesRepositoryInterface,
    HumanResourcesRepositoryInterface,
    PropertiesRepositoryInterface
};
use App\Models\CleaningService;
use Carbon\Carbon;

class CleaningServicesController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $humanResourcesRepository;

    public function __construct(
        CleaningServicesRepositoryInterface $repository,
        HumanResourcesRepositoryInterface $humanResourcesRepository,
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->repository           = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->humanResourcesRepository = $humanResourcesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $config = [];
        if (isRole('owner')) {
            $config = ['filterByOwner' => true];
        } else {
            $config = ['filterByWorkgroup' => true];
        }
        $cleaning_services = $this->repository->all($search, $config);

        return view('cleaning-services.index')
            ->with('cleaning_services', $cleaning_services)
            ->with('search', $search);
    }

    public function create()
    {
        $cleaning_service = $this->repository->blueprint();

        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false]);

        return view('cleaning-services.create')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
    }

    public function store(Request $request)
    {
        $cleaning_service = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        // redirect back if sent from modal
        if ($request->fromModal) {
            return redirect()->back();
        }

        return redirect(route('cleaning-services.edit', [$cleaning_service->id]));
    }

    public function show(CleaningService $cleaning_service)
    {
        $cleaning_service = $this->repository->find($cleaning_service);

        $properties = $this->propertiesRepository->all('', ['paginate' => false]);
        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false]);

        return view('cleaning-services.show')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
    }

    public function edit(CleaningService $cleaning_service)
    {
        $cleaning_service = $this->repository->find($cleaning_service);

        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false]);

        return view('cleaning-services.edit')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        // redirect back if sent from modal
        if ($request->fromModal) {
            return redirect()->back();
        }

        return redirect(route('cleaning-services.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('cleaning-services'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));


        return redirect()->back();
    }

    public function destroyAjax(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect()->back();
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }

    public function monthlyBatch()
    {
        $properties = $this->propertiesRepository->all('', ['paginate' => false]);
        $currentMonth = Carbon::now();
        return view('cleaning-services.monthly-batch')
            ->with('properties', $properties)
            ->with('currentMonth', $currentMonth);
    }

    public function createAjax()
    {
        $cleaning_service = $this->repository->blueprint();

        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false]);

        return view('cleaning-services.create-ajax')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service)
            ->with('withModal', true);
    }

    public function editAjax(CleaningService $cleaning_service)
    {
        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false]);

        return view('cleaning-services.edit-ajax')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('withModal', true)
            ->with('cleaning_service', $cleaning_service);
    }
}
