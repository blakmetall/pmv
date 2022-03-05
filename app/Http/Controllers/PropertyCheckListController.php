<?php

namespace App\Http\Controllers;

use App\Repositories\{PropertyCheckListRepositoryInterface};
use Illuminate\Http\Request;
use App\Models\{Property, PropertyCheckList};

class PropertyCheckListController extends Controller
{
    private $repository;

    public function __construct(PropertyCheckListRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, Property $property)
    {
        $search = [
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'property_id' => $request->property_id,
            'register_by' => $request->register_by,
        ];

        $config = ['propertyID' => $property->id];

        $checkLists = $this->repository->all($search, $config);

        return view('property-check-list.index')
            ->with('checkLists', $checkLists)
            ->with('property', $property)
            ->with('search', $search);
    }

    public function create(Property $property)
    {
        $checkList = $this->repository->blueprint();

        $values = [];
        $values[] = ['label' => 'OK', 'value' => 1];
        $values[] = ['label' => __('Attention'), 'value' => 2];
        $values[] = ['label' => 'N/A', 'value' => 3];

        return view('property-check-list.create')
            ->with('checkList', $checkList)
            ->with('values', $values)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        $checkList = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('property-check-list.edit', [$property->id, $checkList->id]))->withInput();
    }

    public function show(Property $property, PropertyCheckList $checkList)
    {
        $checkList = $this->repository->find($checkList);

        $values = [];
        $values[] = ['label' => 'OK', 'value' => 1];
        $values[] = ['label' => __('Attention'), 'value' => 2];
        $values[] = ['label' => 'N/A', 'value' => 3];

        return view('property-check-list.show')
            ->with('checkList', $checkList)
            ->with('values', $values)
            ->with('property', $property);
    }

    public function edit(Property $property, PropertyCheckList $checkList)
    {
        $checkList = $this->repository->find($checkList);

        $values = [];
        $values[] = ['label' => 'OK', 'value' => 1];
        $values[] = ['label' => 'Attention', 'value' => 2];
        $values[] = ['label' => 'N/A', 'value' => 3];

        return view('property-check-list.edit')
            ->with('checkList', $checkList)
            ->with('values', $values)
            ->with('property', $property);
    }

    public function update(Request $request, Property $property, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('property-check-list.edit', [$property->id, $id]));
    }

    public function destroy(Request $request, Property $property, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('property-check-list', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
