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
        'description',
        'is_finished',
    ];

    public function property() {
        return $this->belongsTo('App\Models\Property');
    }
    
    public function auditedBy() {
        return $this->belongsTo('App\Models\User', 'audit_user_id');
    }
}