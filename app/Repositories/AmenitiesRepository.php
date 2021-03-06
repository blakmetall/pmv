<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{Amenity, AmenityTranslation};
use App\Repositories\AmenitiesRepositoryInterface;
use App\Validations\AmenitiesValidations;

class AmenitiesRepository implements AmenitiesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Amenity $amenity)
    {
        $this->model = $amenity;
        $this->validation = new AmenitiesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $hasPropertyID = isset($config['property_id']) ? $config['property_id'] : false;

        $lang = LanguageHelper::current();

        if ($search) {
            $query =
                AmenityTranslation::where('name', 'like', "%" . $search . "%")
                ->orWhere('amenity_id', $search);
        } else {
            $query = AmenityTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('amenity');

        if ($hasPropertyID) {
            $query->whereHas('amenity', function ($q) use ($hasPropertyID) {
                $q->whereHas('properties', function ($q) use ($hasPropertyID) {
                    $q->where('properties_has_amenities.property_id', $hasPropertyID);
                });
            });
        }

        $query->orderBy('name', 'asc');

        if ($shouldPaginate) {
            $result = $query->paginate(config('constants.pagination.per-page'));
        } else {
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
        $is_new = !$id;

        if ($is_new) {
            $amenity = $this->blueprint();
            $amenity->save();

            $amenity->en->language_id = LanguageHelper::getId('en');
            $amenity->en->amenity_id = $amenity->id;

            $amenity->es->language_id = LanguageHelper::getId('es');
            $amenity->es->amenity_id = $amenity->id;
        } else {
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

        if ($amenity) {

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

        if (!$amenity) {
            throw new ModelNotFoundException("Amenity not found");
        }

        return $amenity;
    }

    public function delete($id)
    {
        $amenity = $this->model->find($id);

        if ($amenity && $this->canDelete($id)) {
            $amenity->properties()->sync([]);

            $amenity->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $amenity->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $amenity->delete();
        }

        return $amenity;
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 91;

        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $amenity = new Amenity;
        $amenity->en = new AmenityTranslation;
        $amenity->es = new AmenityTranslation;

        return $amenity;
    }
}
