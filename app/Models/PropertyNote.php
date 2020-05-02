<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class PropertyNote extends Model {

    use AppModel;
    
    protected $table = 'property_notes';
    public $timestamps = true;
    protected $fillable = [
        'property_id',
        'description'
    ];

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
}