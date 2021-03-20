<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function all($search);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function save(Request $request, $id);

    public function find($id_or_obj);

    public function delete($id);

    public function canDelete($id);

    public function blueprint();
}
