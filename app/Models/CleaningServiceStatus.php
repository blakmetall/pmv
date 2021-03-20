<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\AppModel;

class CleaningServiceStatus extends Model
{

    use AppModel;

    protected $table = 'cleaning_services_status';
    public $timestamps = true;
    protected $fillable = [
        'name',
    ];
}
