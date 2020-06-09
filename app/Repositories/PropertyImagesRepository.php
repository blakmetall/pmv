<?php

namespace App\Repositories;

// use Storage;
// use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\PropertyImagesRepositoryInterface;
use App\Models\{ Property, PropertyImage };
use App\Validations\PropertyImagesValidations;
use App\Helpers\ImagesHelper;

class PropertyImagesRepository implements PropertyImagesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(PropertyImage $image)
    {
        $this->model = $image;
        $this->validation = new PropertyImagesValidations();
    }

    public function all($config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : '';

        $query = PropertyImage::query();

        if($hasPropertyID) {
            $query->where('property_id', $config['property_id']);
        }

        $query->with('property');
        $query->orderBy('order', 'asc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        $this->validation->validate('create', $request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $folder = 'properties';
        $is_new = ! $id;

        $hasUploadedFile = $request->hasFile( 'photos' );

        if($is_new && $hasUploadedFile){
            if(count($request->photos)) {
                foreach($request->photos as $img) {
                    $imgData = ImagesHelper::saveFile($img, $folder);

                    $image = $this->blueprint();
                    $image->property_id = $request->property_id; 
                    $image->slug = $imgData['slug'];
                    $image->extension = $imgData['extension'];
                    $image->file_original_name = $imgData['file_original_name'];
                    $image->file_name = $imgData['file_name'];
                    $image->file_path = $imgData['file_path'];
                    $image->file_url = $imgData['file_url'];  
                    
                    $image->save();

                    $image->order = $image->property->images()->count(); // setup order
                    $image->save();
                }
            }   

            return;
        }

        if(!$is_new && $hasUploadedFile) {
            $oldImage = $this->find($id);
            
            // creates new image record
            $imgData = ImagesHelper::saveFile($request->photos, $folder);
            $image = $this->blueprint();
            $image->property_id = $request->property_id; 
            $image->slug = $imgData['slug'];
            $image->extension = $imgData['extension'];
            $image->file_original_name = $imgData['file_original_name'];
            $image->file_name = $imgData['file_name'];
            $image->file_path = $imgData['file_path'];
            $image->file_url = $imgData['file_url'];  

            $image->order = $oldImage->order; // setup order
            
            $image->save();

            // delete previous data
            $oldImage->delete();
            ImagesHelper::deleteFile($oldImage->file_path);
            ImagesHelper::deleteThumbnails($oldImage->file_path);

            return $image;
        }
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $image = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if (!$image) {
            throw new ModelNotFoundException("PropertyImage not found");
        }

        return $image;
    }

    public function delete($id)
    {
        $image = $this->model->find($id);

        if ($image && $this->canDelete($id)) {
            $image->delete();
            ImagesHelper::deleteFile($image->file_path);
            ImagesHelper::deleteThumbnails($image->file_path);
        }

        return $image;
    }

    public function canDelete($id) 
    {
        return true;
    }

    public function blueprint()
    {
        $image = new PropertyImage;
        return $image;
    }
}
