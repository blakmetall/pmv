<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Repositories\AmenitiesRepositoryInterface;
use App\Models\{ Amenity, AmenityTranslation };
use App\Helpers\LanguageHelper;

class AmenitiesRepository implements AmenitiesRepositoryInterface
{
    protected $model;

    public function __construct(Amenity $amenity)
    {
        $this->model = $amenity;
    }

    public function all($search = '')
    {
        $lang = LanguageHelper::current();

        if ($search) {
            $query = AmenityTranslation::where('name', 'like', "%".$search."%");
        } else {
            $query = new AmenityTranslation;
        }

        return $query
            ->where('language_id', $lang->id)
            ->with('amenity')
            ->orderBy('name', 'asc')
            ->paginate(30);
    }

    public function create(Request $request)
    {
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if ($is_new) {
            $amenity = $this->blueprint();
            $amenity->save();
            
            $amenity->en->language_id = LanguageHelper::getId('en');
            $amenity->en->amenity_id = $amenity->id;
            
            $amenity->es->language_id = LanguageHelper::getId('es');
            $amenity->es->amenity_id = $amenity->id;
        }else{
            $amenity = $this->find($id);
        }

        $amenity->en->fill($request->en);
        $amenity->en->save();
        
        $amenity->es->fill($request->es);
        $amenity->es->save();
        
        return $amenity;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $amenity = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($amenity) { // prepare translations

            $amenity->en = 
                $amenity
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $amenity->es =
                 $amenity
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$amenity) { // not found exception
            throw new ModelNotFoundException("Amenity not found");
        }

        return $amenity;
    }
    
    public function delete($id)
    {
        $amenity = 
            $this->model
                ->where('id', '>', '91') // to avoid deleting seed items
                ->find($id);
        
        if ($amenity) {
            $amenity->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $amenity->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $amenity->delete();
        }

        // return recently deleted object to be used if needed after operation
        // the object may or may not exists
        return $amenity; 
    }

    /**
     * Return the blueprint of the model including translation elements
     */
    public function blueprint()
    {
        $amenity = new Amenity;
        $amenity->en = new AmenityTranslation;
        $amenity->es = new AmenityTranslation;

        return $amenity;
    }
}