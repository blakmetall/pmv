<?php

namespace App\Http\Controllers;

use App\Repositories\{ PropertyImagesRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\{ Property, PropertyImage };

class PropertyImagesController extends Controller
{
    private $repository;

    public function __construct(PropertyImagesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request, Property $property)
    {
        $config = ['property_id' => $property->id];
        $images = $this->repository->all($config);

        return view('property-images.index')
            ->with('images', $images)
            ->with('property', $property);
    }

    public function create(Property $property)
    {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $image = $this->repository->blueprint();
        return view('property-images.create')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('property-images', [$property->id]));
    }

    public function show(Property $property, PropertyImage $image)
    {
        $image = $this->repository->find($image);

        return view('property-images.show')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function edit(Property $property, PropertyImage $image)
    {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $image = $this->repository->find($image);

        return view('property-images.edit')
            ->with('image', $image)
            ->with('property', $property);
    }

    public function update(Request $request, Property $property, $id)
    {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        $image = $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('property-images.edit', [$property->id, $image->id]) );
    }

    public function destroy(Request $request, Property $property, $id)
    {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }

        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('property-images', [$property->id]));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }

    public function destroyAll(Request $request) {
        // permission control
        if(!can('edit', 'property-images')){
            $request->session()->flash('error', __("You don't have access to this area"));
            return redirect()->back();
        }
        
        if($request->ids) {
            $imagesToDelete = explode('_', trim($request->ids, '_'));
            
            if(count($imagesToDelete)) {

                foreach($imagesToDelete as $imgId) {
                    if ( $this->repository->canDelete($imgId) ) {
                        $this->repository->delete($imgId);
                    }
                }

                $request->session()->flash('success', __('Records deleted successfully'));
            }
        }

        return redirect()->back();
    }

    public function orderUp( Property $property, PropertyImage $image) 
    {
        self::order($image, '<');
        return back();
    }

    public function orderDown( Property $property, PropertyImage $image) 
    {
        self::order($image, '>');
        return back();
    }

    public function orderAll(Request $request)
    {
        $orderingStr = trim($request->ordering);

        if($orderingStr) {
            $items = explode('__', $orderingStr);

            foreach($items as $item){
                $photo = explode('-', $item);

                if(isset($photo[0]) && isset($photo[1])){
                    $imageId = $photo[0];
                    $imageOrder = (int) $photo[1];

                    $image = PropertyImage::where('id', $imageId)->first();
                    
                    if($image) {
                        $image->order = $imageOrder;
                        $image->save();
                    }
                }
            }
        }

        return ['success' => true];
    }

    public static function order($imageToMove, $direction = 'asc') {
        $imgToMoveOrder = $imageToMove->order;

        $orderDirection = $direction == '<' ? 'desc' : 'asc';

        $replaceImage = 
            PropertyImage::
                where('order', $direction, $imgToMoveOrder)
                ->where('property_id', $imageToMove->property_id)
                ->orderBy('order', $orderDirection)
                ->first();
        
        if ($replaceImage) {
            $replaceImageOrder = $replaceImage->order;

            $replaceImage->order = $imgToMoveOrder;
            $replaceImage->save();

            $imageToMove->order = $replaceImageOrder;
            $imageToMove->save();
        }
        
        return back();
    }
}
