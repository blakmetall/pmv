<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Repositories\CalendarRepositoryInterface;

class CalendarRepository implements CalendarRepositoryInterface
{
    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        if ($search) {
            $query = CleaningService::
                where('description', 'like', "%".$search."%");
        } else {
            $query = CleaningService::query();
        }

        $query
            ->with('cleaningStaff')
            ->orderBy('is_finished', 'asc')
            ->orderBy('created_at', 'desc');

        if($shouldPaginate) {
            $result = $query->paginate( config('constants.pagination.per-page') );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request) {}
    public function update(Request $request, $id) {}
    public function save(Request $request, $id = '') {}
    public function find($id_or_obj) {}
    public function delete($id) {}
    public function canDelete($id) {}
    public function blueprint() {}
}
