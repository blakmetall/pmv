<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{Zone, ZoneTranslation};
use App\Repositories\ZonesRepositoryInterface;
use App\Validations\ZonesValidations;

class ZonesRepository implements ZonesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Zone $zone)
    {
        $this->model = $zone;
        $this->validation = new ZonesValidations();
    }

    public function all($search = '', $config = [], $city = false)
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = ZoneTranslation::where('zones_translations.name', 'like', "%" . $search . "%");
            $query
                ->where('language_id', $lang->id)
                ->with('zone')
                ->orderBy('zones_translations.name', 'asc');
        } else if ($city) {
            $query = ZoneTranslation::whereHas(
                'zone',
                function ($q) use ($city) {
                    $q->where('zones.city_id', $city);
                }
            )
                ->where('language_id', $lang->id)
                ->orderBy('zones_translations.name', 'asc');
        } else {
            $query = ZoneTranslation::query();
            $query
                ->where('language_id', $lang->id)
                ->with('zone')
                ->orderBy('zones_translations.name', 'asc');
        }

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
            $zone = $this->blueprint();
            $zone->fill($request->all());
            $zone->save();

            $zone->en->language_id = LanguageHelper::getId('en');
            $zone->en->zone_id = $zone->id;

            $zone->es->language_id = LanguageHelper::getId('es');
            $zone->es->zone_id = $zone->id;
        } else {
            $zone = $this->find($id);
            $zone->fill($request->all());
            $zone->save();
        }

        $zone->en->fill($request->en);
        $zone->en->save();

        $zone->es->fill($request->es);
        $zone->es->save();

        return $zone;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $zone = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if ($zone) {

            $zone->en =
                $zone
                ->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

            $zone->es =
                $zone
                ->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();
        }

        if (!$zone) {
            throw new ModelNotFoundException("Zone not found");
        }

        return $zone;
    }

    public function delete($id)
    {
        $zone = $this->model->find($id);

        if ($zone && $this->canDelete($id)) {
            $zone->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $zone->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $zone->delete();
        }

        return $zone;
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 36;

        $zone = $this->find($id);
        if ($zone) {

            // do not delete if zone is assigned to property
            if ($zone->properties()->count()) {
                return false;
            }
        }

        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $zone = new Zone;
        $zone->en = new ZoneTranslation;
        $zone->es = new ZoneTranslation;

        return $zone;
    }
}
