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
};

class PropertiesController extends Controller
{
    private $repository;
    private $usersRepository;
    private $citiesRepository;
    private $zonesRepository;
    private $cleaningOptionsRepository;
    private $propertyTypesRepository;

    public function __construct(
        PropertiesRepositoryInterface $repository,
        UsersRepositoryInterface $usersRepository,
        CitiesRepositoryInterface $citiesRepository,
        ZonesRepositoryInterface $zonesRepository,
        CleaningOptionsRepositoryInterface $cleaningOptionsRepository,
        PropertyTypesRepositoryInterface $propertyTypesRepository
    ) {
        $this->repository = $repository;
        $this->usersRepository = $usersRepository;
        $this->citiesRepository = $citiesRepository;
        $this->zonesRepository = $zonesRepository;
        $this->cleaningOptionsRepository = $cleaningOptionsRepository;
        $this->propertyTypesRepository = $propertyTypesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $properties = $this->repository->all($search);

        return view('properties.index')
            ->with('properties', $properties)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $property = $this->repository->blueprint();
        
        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);
        
        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);
        $zones = $this->zonesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.create')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('propertyTypes', $propertyTypes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $property = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('properties.edit', [$property->id]));
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        $property = $this->repository->find($property);

        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);
        
        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);
        $zones = $this->zonesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.show')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('propertyTypes', $propertyTypes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $property = $this->repository->find($property);
        
        $configUsers = ['paginate' => false, 'ownersOnly' => true];
        $users = $this->usersRepository->all('', $configUsers);
        
        $config = ['paginate' => false];
        $cities = $this->citiesRepository->all('', $config);
        $zones = $this->zonesRepository->all('', $config);
        $cleaningOptions = $this->cleaningOptionsRepository->all('', $config);
        $propertyTypes = $this->propertyTypesRepository->all('', $config);

        return view('properties.edit')
            ->with('property', $property)
            ->with('users', $users)
            ->with('cities', $cities)
            ->with('zones', $zones)
            ->with('cleaningOptions', $cleaningOptions)
            ->with('propertyTypes', $propertyTypes);
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
        return redirect(route('properties.edit', [$id]));
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
            return redirect(route('properties'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}