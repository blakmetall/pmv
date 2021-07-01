<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Models\CleaningService;
use App\Repositories\CleaningServicesRepositoryInterface;
use App\Repositories\CleaningServicesStatusRepositoryInterface;
use App\Repositories\HumanResourcesRepositoryInterface;
use App\Repositories\PropertiesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CleaningServicesController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $humanResourcesRepository;
    private $cleaningServicesStatusRepository;

    public function __construct(
        CleaningServicesRepositoryInterface $repository,
        CleaningServicesStatusRepositoryInterface $cleaningServicesStatusRepository,
        HumanResourcesRepositoryInterface $humanResourcesRepository,
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->repository = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->propertiesRepository = $propertiesRepository;
        $this->humanResourcesRepository = $humanResourcesRepository;
        $this->cleaningServicesStatusRepository = $cleaningServicesStatusRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

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

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        $status = $this->cleaningServicesStatusRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        return view('cleaning-services.create')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('status', $status)
            ->with('cleaning_service', $cleaning_service);
    }

    public function store(Request $request)
    {
        // permission control
        if(!can('edit', 'cleaning-services')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

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
        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        $status = $this->cleaningServicesStatusRepository->all('', '');

        return view('cleaning-services.show')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('status', $status)
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

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        $status = $this->cleaningServicesStatusRepository->all('', '');

        return view('cleaning-services.edit')
            ->with('properties', $properties)
            ->with('cleaning_staff', $cleaning_staff)
            ->with('status', $status)
            ->with('cleaning_service', $cleaning_service);
    }

    public function update(Request $request, $id)
    {
        // permission control
        if(!can('edit', 'cleaning-services')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

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
        // permission control
        if(!can('edit', 'cleaning-services')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

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
        // permission control
        if(!can('edit', 'cleaning-services')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect()->back();
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }

    public function monthlyBatch(Request $request)
    {
        if (!$request->year && !$request->month) { // prepare year and month for first call
            $urlParams = [
                'maid' => '',
                'year' => date('Y', strtotime('now')),
                'month' => date('m', strtotime('now')),
            ];

            $appendUrl = '?' . http_build_query($urlParams);
            $redirectUrl = route('cleaning-services.monthly-batch') . $appendUrl;

            return redirect($redirectUrl);
        }

        $properties = $this->propertiesRepository->all('', ['paginate' => false]);

        $currentMonth = Carbon::createFromDate($_GET['year'], $_GET['month'], 1, 'America/Mexico_City');

        $properties = $this->propertiesRepository->all('', ['paginate' => false, 'pm' => true]);
      
        $maids = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        return view('cleaning-services.monthly-batch')
            ->with('properties', $properties)
            ->with('cleaning_staff_id', $request->maid)
            ->with('maids', $maids)
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

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        $status = $this->cleaningServicesStatusRepository->all('', '');

        return view('cleaning-services.create-ajax')
            ->with('cleaning_staff', $cleaning_staff)
            ->with('cleaning_service', $cleaning_service)
            ->with('status', $status)
            ->with('withModal', true);
    }

    public function editAjax(CleaningService $cleaning_service)
    {
        $properties = $this->propertiesRepository->all('', [
            'paginate' => false,
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
        ]);

        $cleaning_staff = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);

        $status = $this->cleaningServicesStatusRepository->all('', '');

        return view('cleaning-services.edit-ajax')
            ->with('cleaning_staff', $cleaning_staff)
            ->with('withModal', true)
            ->with('status', $status)
            ->with('cleaning_service', $cleaning_service);
    }
}
