<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Repositories\{ 
    PropertiesRepositoryInterface,
    UsersRepositoryInterface,
    CitiesRepositoryInterface,
    ZonesRepositoryInterface,
    CleaningOptionsRepositoryInterface,
    PropertyTypesRepositoryInterface,
    AmenitiesRepositoryInterface
};
use App\Helpers\{ RoleHelper, UserHelper };

use App\Helpers\ReportExcelHelper;

class PropertiesController extends Controller
{
    private $repository;
    private $usersRepository;
    private $citiesRepository;
    private $zonesRepository;
    private $amenitiesRepository;
    private $cleaningOptionsRepository;
    private $propertyTypesRepository;

    public function __construct(
        PropertiesRepositoryInterface $repository,
        UsersRepositoryInterface $usersRepository,
        CitiesRepositoryInterface $citiesRepository,
        ZonesRepositoryInterface $zonesRepository,
        AmenitiesRepositoryInterface $amenitiesRepository,
        CleaningOptionsRepositoryInterface $cleaningOptionsRepository,
        PropertyTypesRepositoryInterface $propertyTypesRepository
    ) {
        $this->repository = $repository;
        $this->usersRepository = $usersRepository;
        $this->citiesRepository = $citiesRepository;
        $this->zonesRepository = $zonesRepository;
        $this->amenitiesRepository = $amenitiesRepository;
        $this->cleaningOptionsRepository = $cleaningOptionsRepository;
        $this->propertyTypesRepository = $propertyTypesRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $config = ['filterByWorkgroup' => true];
        
        // review this code
        if(RoleHelper::is('owner') || RoleHelper::is('regular')) {
            $config['filterByUserId'] = UserHelper::getCurrentUserID();
        }

        $properties = $this->repository->all($search, $config);

        if($request->shouldGenerateExcel) {
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
        $config = ['paginate' => false];
        $zones = $this->zonesRepository->all('', $config);
        $amenities = $this->amenitiesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.create')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('amenities', $amenities)
            ->with('cleaningOptions', $cleaningOptions)
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
        $config = ['paginate' => false];
        $zones = $this->zonesRepository->all('', $config);
        $amenities = $this->amenitiesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.show')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('amenities', $amenities)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('propertyTypes', $propertyTypes);
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
        $config = ['paginate' => false];
        $zones = $this->zonesRepository->all('', $config);
        $amenities = $this->amenitiesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.edit')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('amenities', $amenities)
            ->with('cleaningOptions', $cleaningOptions)
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
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('properties'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    public function export(){
        $collection = Property::all();
        prepareExportationExcel($collection);
    }
}
