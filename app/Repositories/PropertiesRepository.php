<?php

namespace App\Repositories;

use App\Helpers\ImagesHelper;
use App\Helpers\LanguageHelper;
use App\Helpers\WorkgroupHelper;
use App\Models\Property;
use App\Models\PropertyTranslation;
use App\Validations\PropertiesValidations;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PropertiesRepository implements PropertiesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Property $property)
    {
        $this->model = $property;
        $this->validation = new PropertiesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldFilterByPM = isset($config['pm']) ? $config['pm'] : false;
        $shouldFilterByName = isset($config['filterByName']) ? $config['filterByName'] : false;
        $shouldFilterByWorkgroup = isset($config['filterByWorkgroup']) ? $config['filterByWorkgroup'] : false;
        $shouldFilterByOnline = isset($config['filterOnline']) ? $config['filterOnline'] : false;
        $shouldFilterByEnabled = isset($config['filterByEnabled']) ? $config['filterByEnabled'] : false;
        $shouldFilterByUserId = isset($config['filterByUserId']) ? $config['filterByUserId'] : false;
        $shouldCleaningStaffId = isset($config['cleaningStaffId']) ? $config['cleaningStaffId'] : false;
        $shouldFilterByOffline = isset($config['filterByOffline']) ? $config['filterByOffline'] : false;
        $shouldFilterByDisabled = isset($config['filterByDisabled']) ? $config['filterByDisabled'] : false;
        $shouldFilterByFeatured = isset($config['filterByFeatured']) ? $config['filterByFeatured'] : false;
        $shouldFilterByNews = isset($config['filterByNews']) ? $config['filterByNews'] : false;
        $shouldFilterBySlug = isset($config['filterBySlug']) ? $config['filterBySlug'] : false;

        $filterPetFriendly = isset($config['pet_friendly']) && $config['pet_friendly'] ? true : false;
        $filterAdultsOnly = isset($config['adults_only']) && $config['adults_only'] ? true : false;
        $filterBeachFront = isset($config['beachfront']) && $config['beachfront'] ? true : false;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = PropertyTranslation::query();
            $query->where(function ($query) use ($lang, $search) {
                $query->where(function ($query) use ($lang, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                    $query->orWhere('description', 'like', '%' . $search . '%');
                });

                $query->orWhereHas('property', function ($query) use ($search) {
                    $query->where('id', $search);
                });
            });
        } else {
            $query = PropertyTranslation::query();
        }

        if ($shouldFilterByNews) {
            $query
                ->where('language_id', $lang->id)
                ->with('property')
                ->join('properties', 'properties.id', '=', 'property_id')
                ->orderBy('properties.created_at', 'desc');
        } else {
            $query
                ->where('language_id', $lang->id)
                ->with('property');
        }

        if (!$shouldFilterByUserId && $shouldFilterByWorkgroup && WorkgroupHelper::shouldFilterByCity()) {
            $query->whereHas('property', function ($q) {
                $table = (new Property())->_getTable();
                $q->whereIn($table . '.city_id', WorkgroupHelper::getAllowedCities());
            });
        }

        if ($shouldFilterByUserId) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->whereHas('users', function ($q) use ($config) {
                    $q->where('properties_has_users.user_id', $config['filterByUserId']);
                });
            })->where('language_id', $lang->id);
        }

        if ($shouldCleaningStaffId) {
            $query->whereHas('property', function ($q) use ($shouldCleaningStaffId) {
                $q->where('cleaning_staff_ids', 'like', "%\"{$shouldCleaningStaffId}\"%");
            })->where('language_id', $lang->id);
        }

        if ($shouldFilterBySlug) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('slug', $config['filterBySlug']);
            })->where('language_id', $lang->id);
        }


        if ($shouldFilterByOnline) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('properties.is_online', 1);
            });
        }

        if ($filterPetFriendly) {
            $query->whereHas('property', function ($q) {
                $q->where('properties.pet_friendly', 1);
            });
        }

        if ($filterAdultsOnly) {
            $query->whereHas('property', function ($q) {
                $q->where('properties.adults_only', 1);
            });
        }

        if ($filterBeachFront) {
            $query->whereHas('property', function ($q) {
                $q->where('properties.beachfront', 1);
            });
        }

        if ($shouldFilterByFeatured) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('properties.is_featured', 1);
            });
            $query->orderByRaw('RAND()');
        }

        if ($shouldFilterByEnabled) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('properties.is_enabled', 1);
            });
        }

        if ($shouldFilterByOffline) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('properties.is_online', '!=', 1);
            });
        }

        if ($shouldFilterByDisabled) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->where('properties.is_enabled', '!=', 1);
            });
        }

        if ($shouldFilterByPM) {
            $query->whereHas('property', function ($q) use ($config) {
                $q->whereHas('management');
            })->where('language_id', $lang->id);
        }

        if ($shouldFilterByFeatured) {
            $result = $query->limit(4)->get();
        } else {
            $query->orderBy('name', 'asc');

            if ($shouldPaginate) {
                $result = $query->paginate(config('constants.pagination.per-page'));
            } else {
                $result = $query->get();
            }
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

        $checkboxesConfig = [
            'is_featured' => 0,
            'is_enabled' => 0,
            'is_online' => 0,
            'is_special' => 0,
            'pet_friendly' => 0,
            'adults_only' => 0,
            'beachfront' => 0,
            'has_parking' => 0,
        ];
        $requestData = array_merge($checkboxesConfig, $request->all());

        if ($is_new) {
            $property = $this->blueprint();
            $property->fill($requestData);
            $property->save();

            $property->en->language_id = LanguageHelper::getId('en');
            $property->en->property_id = $property->id;

            $property->es->language_id = LanguageHelper::getId('es');
            $property->es->property_id = $property->id;
        } else {
            $property = $this->find($id);
            $property->fill($requestData);
            $property->save();
        }

        $property->en->fill($request->en);
        if (!$request->en['slug']) {
            $property->en->slug = generateSlug($request->en['name']);
        }
        $property->en->save();

        $property->es->fill($request->es);
        if (!$request->es['slug']) {
            $property->es->slug = generateSlug($request->es['name']);
        }
        $property->es->save();

        // bedding options
        if ($request->bedding_options) {
            $property->bedding = $request->bedding_options;
            $property->save();
        }
        if ($request->bedding_options_notes) {
            $property->bedding_notes = $request->bedding_options_notes;
            $property->save();
        }

        // amenities assignation
        $property->amenities()->sync($request->amenities_ids);
        $property->users()->sync($request->users_ids);

        return $property;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $property = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if ($property) {
            $property->en =
                $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

            $property->es =
                $property
                ->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();
        }

        if (!$property) {
            throw new ModelNotFoundException('Property not found');
        }

        return $property;
    }

    public function delete($id)
    {
        $property = $this->model->find($id);
        if ($property && $this->canDelete($id)) {
            $property->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $property->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            if ($property->images()->count()) {
                foreach ($property->images as $image) {
                    $image->delete();
                    ImagesHelper::deleteFile($image->file_path);
                    ImagesHelper::deleteThumbnails($image->file_path);
                }
            }

            $property->rates()->delete();
            $property->notes()->delete();
            $property->amenities()->sync([]);
            $property->contacts()->sync([]);

            $property->delete();
        }

        return $property;
    }

    public function canDelete($id)
    {
        $property = $this->model->find($id);

        if ($property) {
            if ($property->management()->count()) {
                return false;
            }

            if ($property->bookings()->count()) {
                return false;
            }

            if ($property->reservationRequests()->count()) {
                return false;
            }

            if ($property->cleaningServices()->count()) {
                return false;
            }
        }

        return true;
    }

    public function blueprint()
    {
        $property = new Property();
        $property->en = new PropertyTranslation();
        $property->es = new PropertyTranslation();

        return $property;
    }
}
