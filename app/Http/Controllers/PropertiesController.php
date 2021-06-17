<?php

namespace App\Http\Controllers;

use App\Helpers\ReportExcelHelper;
use App\Helpers\RoleHelper;
use App\Helpers\UserHelper;
use App\Models\Property;
use App\Repositories\AmenitiesRepositoryInterface;
use App\Repositories\BuildingsRepositoryInterface;
use App\Repositories\CitiesRepositoryInterface;
use App\Repositories\CleaningOptionsRepositoryInterface;
use App\Repositories\HumanResourcesRepositoryInterface;
use App\Repositories\OfficesRepositoryInterface;
use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyTypesRepositoryInterface;
use App\Repositories\UsersRepositoryInterface;
use App\Repositories\ZonesRepositoryInterface;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    private $repository;
    private $usersRepository;
    private $citiesRepository;
    private $zonesRepository;
    private $buildingsRepository;
    private $officesRepository;
    private $amenitiesRepository;
    private $humanResourcesRepository;
    private $cleaningOptionsRepository;
    private $propertyTypesRepository;

    public function __construct(
        PropertiesRepositoryInterface $repository,
        UsersRepositoryInterface $usersRepository,
        CitiesRepositoryInterface $citiesRepository,
        ZonesRepositoryInterface $zonesRepository,
        BuildingsRepositoryInterface $buildingsRepository,
        OfficesRepositoryInterface $officesRepository,
        AmenitiesRepositoryInterface $amenitiesRepository,
        HumanResourcesRepositoryInterface $humanResourcesRepository,
        CleaningOptionsRepositoryInterface $cleaningOptionsRepository,
        PropertyTypesRepositoryInterface $propertyTypesRepository
    ) {
        $this->repository = $repository;
        $this->usersRepository = $usersRepository;
        $this->citiesRepository = $citiesRepository;
        $this->zonesRepository = $zonesRepository;
        $this->buildingsRepository = $buildingsRepository;
        $this->officesRepository = $officesRepository;
        $this->humanResourcesRepository = $humanResourcesRepository;
        $this->amenitiesRepository = $amenitiesRepository;
        $this->cleaningOptionsRepository = $cleaningOptionsRepository;
        $this->propertyTypesRepository = $propertyTypesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $config = ['filterByWorkgroup' => true];

        // review this code
        if (RoleHelper::is('owner')) {
            $config['filterByUserId'] = UserHelper::getCurrentUserID();
        }

        $config['filterOnline'] = (bool) $request->filterOnline;
        $config['filterByOffline'] = (bool) $request->filterOffline;
        $config['filterByDisabled'] = (bool) $request->filterDisabled;

        $properties = $this->repository->all($search, $config);

        if ($request->shouldGenerateExcel) {
            return ReportExcelHelper::generate($properties, 'properties');
        }

        return view('properties.index')
            ->with('properties', $properties)
            ->with('search', $search);
    }

    public function create()
    {
        $property = $this->repository->blueprint();

        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);
        $config = ['paginate' => false];
        $zones = [];
        $buildings = $this->buildingsRepository->all('', $config);
        $offices = $this->officesRepository->all('', $config);
        $hr = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);
        $amenities = $this->amenitiesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        $beddingOptions = [
            'King Bed',
            'Queen Bed',
            'Double Bed',
            'Single Bed',
            'Pullout Bed',
            'Futon',
        ];

        return view('properties.create')
            ->with('property', $property)
            ->with('users', $users)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('buildings', $buildings)
            ->with('offices', $offices)
            ->with('hr', $hr)
            ->with('amenities', $amenities)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('beddingOptions', $beddingOptions)
            ->with('propertyTypes', $propertyTypes);
    }

    public function store(Request $request)
    {
        $property = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('properties.edit', [$property->id]));
    }

    public function show(Property $property)
    {
        $property = $this->repository->find($property);

        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);
        $config = ['paginate' => false];
        $zones = $this->zonesRepository->all('', $config);
        $buildings = $this->buildingsRepository->all('', $config);
        $offices = $this->officesRepository->all('', $config);
        $hr = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);
        $amenities = $this->amenitiesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        $beddingOptions = [
            'King Bed',
            'Queen Bed',
            'Double Bed',
            'Single Bed',
            'Pullout Bed',
            'Futon',
        ];

        return view('properties.show')
            ->with('property', $property)
            ->with('users', $users)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('buildings', $buildings)
            ->with('offices', $offices)
            ->with('hr', $hr)
            ->with('amenities', $amenities)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('beddingOptions', $beddingOptions)
            ->with('propertyTypes', $propertyTypes);
    }

    public function getBonus(Request $request)
    {
        $property = Property::where('id', $request->id)->first();

        return response()->json($property->cleaning_sunday_bonus);
    }

    public function edit(Property $property)
    {
        $property = $this->repository->find($property);

        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);

        $citiesConfig = [
            'paginate' => false,
            'filterByWorkgroup' => true,
        ];
        $cities = $this->citiesRepository->all('', $citiesConfig);
        $states = $this->citiesRepository->states($cities);
        $config = ['paginate' => false];
        $zones = $this->zonesRepository->all('', $config);
        $buildings = $this->buildingsRepository->all('', $config);
        $offices = $this->officesRepository->all('', $config);
        $amenities = $this->amenitiesRepository->all('', $config);
        $hr = $this->humanResourcesRepository->all('', ['paginate' => false, 'cleaningStaffOnly' => true]);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        $beddingOptions = [
            'King Bed',
            'Queen Bed',
            'Double Bed',
            'Single Bed',
            'Pullout Bed',
            'Futon',
        ];

        return view('properties.edit')
            ->with('property', $property)
            ->with('users', $users)
            ->with('states', $states)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('buildings', $buildings)
            ->with('offices', $offices)
            ->with('amenities', $amenities)
            ->with('hr', $hr)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('beddingOptions', $beddingOptions)
            ->with('propertyTypes', $propertyTypes);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('properties.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('properties'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }

    public function export()
    {
        $collection = Property::all();
        prepareExportationExcel($collection);
    }

    public function generalAvailability()
    {
        return view('properties.general-availability');
    }
}
