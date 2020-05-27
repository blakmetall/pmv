<?php

namespace App\Repositories;

use Storage;
use DateTime;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\PropertyImagesRepositoryInterface;
use App\Models\{ Property, PropertyImage };
use App\Validations\PropertyImagesValidations;

class PropertyImagesRepository implements PropertyImagesRepositoryInterface
{
    protected $model;

    public function __construct(PropertyImage $image)
    {
        $this->model = $image;
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
        PropertyImagesValidations::validateOnCreate($request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        PropertyImagesValidations::validateOnEdit($request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if($is_new){
            $image = $this->blueprint();
        }else{
            $image = $this->find($id);
        }

        $image->property_id = $request->property_id;
        $image->order = 0;

        if($request->hasFile( 'property_image' )){
            $data_img = saveFile($request->file( 'property_image' ));
            $image->slug = $data_img['slug'];
            $image->extension = $data_img['extension'];
            $image->file_original_name = $data_img['original_name'];
            $image->file_name = $data_img['file_name'];
            $image->file_path = $data_img['path_file'];
            $image->file_url = $data_img['url_file'];
        }

        if($image->save()){
            deleteFile($request->old_file);
        }

        return $image;
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
            deleteFile($image->file_name);
            $image->delete();
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
