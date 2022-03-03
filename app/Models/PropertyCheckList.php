<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\AppModel;

class PropertyCheckList extends Model
{

    use AppModel;
    use SoftDeletes;

    protected $table = 'property_check_list';
    public $timestamps = true;

    protected $fillable = [
        'property_id',
        'entrance_locks_entry',
        'door_entry',
        'walls_and_trim_entry',
        'ceiling_entry',
        'lighting_fixtures_entry',
        'door_mat_entry',
        'electrical_outlets_entry',
        'floor_entry',
        'comments_entry',
        'ceiling_living_room',
        'walls_and_trim_living_room',
        'floor_living_room',
        'windows_living_room',
        'internet_living_room',
        'electronics_living_room',
        'furniture_living_room',
        'ac_living_room',
        'electrical_outlets_living_room',
        'cable_living_room',
        'remote_controls_living_room',
        'comments_living_room',
        'ceiling_dinning_room',
        'walls_and_trim_dinning_room',
        'floor_dinning_room',
        'furniture_dinning_room',
        'placematts_dinning_room',
        'lighting_fixtures_dinning_room',
        'windows_dinning_room',
        'electrical_outlets_dinning_room',
        'ceiling_kitchen',
        'walls_and_trim_kitchen',
        'floor_kitchen',
        'countertop_kitchen',
        'cabinets_kitchen',
        'dish_towels_kitchen',
        'dishes_kitchen',
        'pots_kitchen',
        'glasses_kitchen',
        'stove_kitchen',
        'oven_kitchen',
        'exhaust_hood_kitchen',
        'cooking_utensils_kitchen',
        'taps_kitchen',
        'fridge_kitchen',
        'freezer_kitchen',
        'door_exterior_kitchen',
        'floor_beside_refrigerator_kitchen',
        'floor_under_refrigerator_kitchen',
        'pantry_kitchen',
        'dishwasher_kitchen',
        'lighting_fixtures_kitchen',
        'electrical_outlets_kitchen',
        'appliances_kitchen',
        'comments_kitchen',
        'bedrooms',
        'bathrooms',
        'ceiling_terrace',
        'walls_and_trim_terrace',
        'floor_terrace',
        'lighting_fixtures_terrace',
        'furniture_terrace',
        'railings_terrace',
        'comments_terrace',
        'door_utility_room',
        'washer_utility_room',
        'dryer_utility_room',
        'areas_clean_utility_room',
        'shelves_utility_room',
        'lighting_fixtures_utility_room',
        'electrical_outlets_utility_room',
        'water_heater_utility_room',
        'overall_plumbing_utility_room',
        'comments_utility_room',
        'building_entrance_other',
        'interior_exterior_plants_other',
        'interior_exterior_plants_pots_other',
        'plants_other',
        'comments_other',
        'comments_general',
    ];

    public function property()
    {
        return $this->belongsTo('App\Models\Property');
    }
}
