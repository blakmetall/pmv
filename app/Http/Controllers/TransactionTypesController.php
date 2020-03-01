<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LanguageHelper;
use App\Models\{ TransactionType, TransactionTypeTranslation };

class TransactionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lang = LanguageHelper::current();

        $transaction_types = 
            TransactionTypeTranslation::
                where('language_id', $lang->id)
                ->with('transactionType')
                ->orderBy('id', 'asc')
                ->paginate(30);

        return view('transaction-types.index')->with('transaction_types', $transaction_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaction-types.create')
            ->with('transaction_type', (new TransactionType) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('transaction-types.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionType $transactionType)
    {
        return view('transaction-types.edit')->with('transaction_type', $transactionType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionType = TransactionType::findOrFail($id);

        $transactionType->translations()->delete();
        $transactionType->delete();

        return redirect(route('transaction-types'));
    }
}