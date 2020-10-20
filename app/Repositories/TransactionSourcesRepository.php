<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{TransactionSource, TransactionSourceTranslation};
use App\Repositories\TransactionSourcesRepositoryInterface;
use App\Validations\TransactionSourcesValidations;

class TransactionSourcesRepository implements TransactionSourcesRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(TransactionSource $transaction_source)
    {
        $this->model = $transaction_source;
        $this->validation = new TransactionSourcesValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query =
                TransactionSourceTranslation::where('name', 'like', "%" . $search . "%");
        } else {
            $query = TransactionSourceTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('transactionSource')
            ->orderBy('name', 'asc');

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
            $transaction_source = $this->blueprint();
            $transaction_source->save();

            $transaction_source->en->language_id = LanguageHelper::getId('en');
            $transaction_source->en->transaction_source_id = $transaction_source->id;

            $transaction_source->es->language_id = LanguageHelper::getId('es');
            $transaction_source->es->transaction_source_id = $transaction_source->id;
        } else {
            $transaction_source = $this->find($id);
        }

        $transaction_source->en->fill($request->en);
        $transaction_source->en->save();

        $transaction_source->es->fill($request->es);
        $transaction_source->es->save();

        return $transaction_source;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $transaction_source = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);

        if ($transaction_source) {

            $transaction_source->en =
                $transaction_source
                ->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

            $transaction_source->es =
                $transaction_source
                ->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();
        }

        if (!$transaction_source) {
            throw new ModelNotFoundException("TransactionSource not found");
        }

        return $transaction_source;
    }

    public function delete($id)
    {
        $transaction_source = $this->model->find($id);

        if ($transaction_source && $this->canDelete($id)) {
            $transaction_source->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $transaction_source->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $transaction_source->delete();
        }

        return $transaction_source;
    }

    public function canDelete($id)
    {
        $isNotDefaultItem = $id > 84;

        $transaction_source = $this->find($id);
        if ($transaction_source) {

            // validate empty usage in property-management-transactions
            if ($transaction_source->pmTransactions()->count()) {
                return false;
            }
        }

        return $isNotDefaultItem;
    }

    public function blueprint()
    {
        $transaction_source = new TransactionSource;
        $transaction_source->en = new TransactionSourceTranslation;
        $transaction_source->es = new TransactionSourceTranslation;

        return $transaction_source;
    }
}
