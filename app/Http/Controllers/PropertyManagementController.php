<?php

namespace App\Http\Controllers;

use App\Repositories\{
    PropertiesRepositoryInterface,
    PropertyManagementRepositoryInterface,
    CitiesRepositoryInterface
};
use Illuminate\Http\Request;
use App\Models\{
    Property,
    PropertyManagement
};
use Session;

class PropertyManagementController extends Controller
{
    private $repository;
    private $propertiesRepository;
    private $citiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        PropertyManagementRepositoryInterface $repository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->repository = $repository;
        $this->propertiesRepository = $propertiesRepository;
        $this->citiesRepository = $citiesRepository;
    }

    public function index(Request $request, Property $property)
    {
        $search = trim($request->s);
        $config = ['propertyID' => $property->id, 'paginate' => false];
        $pm_items = $this->repository->all($search, $config);
        $cities = $this->citiesRepository->all('', $config);
        $active = 0;
        $finished = 0;
        $total = 0;

        $config = [
            'finishedOnly' => true,
            'propertyID' => $property->id,
            'filterByCity' => $request->city
        ];
        $pm_items_finished = $this->repository->all($search, $config);
        
        if ($pm_items->count()) {
            $total = $pm_items->count();
            foreach ($pm_items as $pm_item) {
                if ($pm_item->is_finished) {
                    $finished ++;
                }else{
                    $active ++;
                }
            }
        }

        return view('property-management.index')
            ->with('pm_items_finished', $pm_items_finished)
            ->with('pm_items', $pm_items)
            ->with('property', $property)
            ->with('cities', $cities)
            ->with('active', $active)
            ->with('finished', $finished)
            ->with('total', $total)
            ->with('search', $search);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);

        $config = ['paginate' => false];
        $config = [
            // 'filterByEnabled' => true,
            'unfinishedOnly' => true,
            'filterByCity' => $request->city
        ];
        $pm_items = $this->repository->all($search, $config);

        $config = [
            'finishedOnly' => true,
            'filterByCity' => $request->city
        ];
        $pm_items_finished = $this->repository->all($search, $config);

        $cities = $this->citiesRepository->all('', '');

        $active = 0;
        $finished = $pm_items_finished->count();
        $total = $pm_items->count() + $pm_items_finished->count();

        if ($pm_items->count()) {
            foreach ($pm_items as $pm_item) {
                if ($pm_item->is_finished) {
                    $finished++;
                }else{
                    $active++;
                }
            }
        }

        return view('property-management.general')
            ->with('pm_items_finished', $pm_items_finished)
            ->with('pm_items', $pm_items)
            ->with('cities', $cities)
            ->with('active', $active)
            ->with('finished', $finished)
            ->with('total', $total)
            ->with('search', $search);
    }

    public function create(Property $property)
    {
        $pm = $this->repository->blueprint();

        return view('property-management.create')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        if ($this->canCreatePM($request, $property)) {
            $pm = $this->repository->create($request);
            $request->session()->flash('success', __('Record created successfully'));
            return redirect(route('property-management.edit', [$property->id, $pm->id]));
        } else {
            $request->session()->flash('error', __('You can only have one unfinished property management.'));
            return redirect()->back()->withInput();
        }
    }

    public function show(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);

        return view('property-management.show')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function edit(Property $property, PropertyManagement $pm)
    {
        $pm = $this->repository->find($pm);

        return view('property-management.edit')
            ->with('pm', $pm)
            ->with('property', $property);
    }

    public function update(Request $request, Property $property, $id)
    {
        if ($this->canCreatePM($request, $property, $id)) {
            $this->repository->update($request, $id);
            $request->session()->flash('success', __('Record updated successfully'));

            return redirect(route('property-management.edit', [$property->id, $id]));
        } else {
            $request->session()->flash('error', __('You can only have one unfinished property management.'));
            
            return redirect()->back()->withInput();
        }
    }

    public function destroy(Request $request, Property $property, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            
            return redirect(route('property-management', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    // ensures not creating new property management if an active one is enabled
    private function canCreatePM($request, $property, $id = false)
    {

        if (!$request->is_finished) {
            $pmQuery = PropertyManagement::where('property_id', $property->id)->where('is_finished', 0);
            if ($id) {
                $pmQuery->where('id', '!=', $id);
            }

            $unfinishedPM = $pmQuery->first();
            if ($unfinishedPM) {
                return false;
            }
        }

        return true;
    }

    // get the partial section to select property; used to create new transaction url
    public function getPropertySelection()
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }

        $config = [
            'filterByWorkgroup' => true,
            'filterByEnabled' => true,
            'paginate' => false
        ];

        $tmpProperties = $this->propertiesRepository->all('', $config);
        $properties = [];

        // skip properties without property management enabled
        if(count($tmpProperties)) {
            foreach($tmpProperties as $p) {
                if($p->property && $p->property->management()->count()) {
                    foreach($p->property->management as $management) {
                        if($management->is_finished !== 1) {
                            $properties[] = $p;
                            break;
                        }
                    }
                }
            }
        }

        return view('property-management.get-property-selection')->with('properties', $properties);
    }

    // generates the url and redirects to create new transaction for specific property management
    public function generatePMTransactionUrl(Property $property)
    {
        if (Session::has('backUrl')) {
            Session::keep('backUrl');
        }
        if ($property->management()->count()) {
            foreach ($property->management as $pm) {
                if (!$pm->is_finished) {
                    return redirect(route('property-management-transactions.create', $pm->id));
                    exit;
                }
            }
        }

        return redirect(route('property-management.general'));
    }
}
