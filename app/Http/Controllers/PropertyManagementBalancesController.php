<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{
    PropertyManagementRepositoryInterface,
};
use App\Models\PropertyManagement;
use App\Helpers\PMHelper;

class PropertyManagementBalancesController extends Controller
{
    private $propertyManagementRepository;

    public function __construct(PropertyManagementRepositoryInterface $propertyManagementRepository) {
        $this->propertyManagementRepository = $propertyManagementRepository;
    }

    public function index(Request $request, PropertyManagement $pm)
    {
        $pm = $this->propertyManagementRepository->find($pm->id);

        $pm->_balance = PMHelper::getPropertyManagementBalance($pm->id);
        $pm_items = [$pm];

        return view('property-management-balances.index')
            ->with('pm', $pm)
            ->with('pm_items', $pm_items);
    }

    public function general(Request $request)
    {
        $search = trim($request->s);
        $pm_items = $this->propertyManagementRepository->all($search);

        if($pm_items->count()) {
            foreach($pm_items as $index => $pm_item) {
                $pm_items[$index]->_balance = PMHelper::getPropertyManagementBalance($pm_item->id);
            }
        }

        return view('property-management-balances.general')->with('pm_items', $pm_items);
    }
}
