<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LanguageHelper;
use App\Models\{ TransactionType, TransactionTypeTranslation };

use App\Helpers\languageHelper;

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
        return view('transaction-types.create')->with('transaction_type', (new TransactionType) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction_type = new TransactionType;
        $transaction_type->save();

        $en = new TransactionTypeTranslation;
        $en->language_id = LanguageHelper::getId('en');
        $en->transaction_type_id = $transaction_type->id;
        $en->name = $request->name['en'];
        $en->save();

        $es = new TransactionTypeTranslation;
        $es->language_id = LanguageHelper::getId('es');
        $es->transaction_type_id = $transaction_type->id;
        $es->name = $request->name['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('transaction-types') );
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
        $transactionType['en'] = 
            $transactionType->translations()
                ->where('language_id', LanguageHelper::getId('en'))
                ->first();

        $transactionType['es'] = 
            $transactionType->translations()
                ->where('language_id', LanguageHelper::getId('es'))
                ->first();

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
        // run validations
        // if fails
        // return to edit and restore values from input
        // code: return redirect( route('amenities.edit', $id) )->withInput();

        $transactionType = TransactionType::findOrFail($id);

        $en = $transactionType->translations()->where('language_id', LanguageHelper::getId('en'))->first();
        $en->name = $request->name['en'];
        $en->save();

        $es = $transactionType->translations()->where('language_id', LanguageHelper::getId('es'))->first();
        $es->name = $request->name['es'];
        $es->save();

        // if everything succeeds return to list
        return redirect( route('transaction-types') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find
        $transaction_type = TransactionType::findOrFail($id);
       
        // delete translations
        $transaction_type->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
        $transaction_type->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

        // delete 
        $transaction_type->delete();

        return redirect( route('transaction-types') );
    }

    /*
    private function saveData($transactionType, $request){

        if(!$transactionType){
                $transactionType = new TransactionType;
        }

        $this->validateData($transactionType, $request);
        //Create new transactionType
        $transactionType->save();
        //Create new Translation ES of Transaction Tpe
        $transactionType->translations()->create([
            'language_id' => 1,
            'name' => $request->inputNameEs,
        ]);
        //Create new Translation EN of Transaction Tpe
        $transactionType->translations()->create([
            'language_id' => 2,
            'name' => $request->inputNameEn,
        ]);


        return redirect()->route('transaction-types')->with('message', __('Success' ));
    }

    private function validateData($transactionType, $request){
        $rules = [
            'inputNameEs' => 'required|min:6|max:30',
            'inputNameEn' => 'required|min:6|max:30',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            redirect()->back()->withErrors($validator->messages())->withInput();
        }

    }
    */
}
