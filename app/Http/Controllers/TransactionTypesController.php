<?php

namespace App\Http\Controllers;

use App\Models\TransactionTypeTranslation;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Illuminate\Support\Facades\Validator;

class TransactionTypesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $language_id = 1; // for now is a simulated language

        $transaction_types = (new TransactionTypeTranslation)
        ->where('language_id', $language_id)
        ->with('transactionType')
        ->orderBy('id', 'asc')
        ->paginate(30);

        return view('transaction-types.index', [
            'transaction_types' => $transaction_types
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactionType = new TransactionType();
        return view('transaction-types.create', [
            'transaction_types' => $transactionType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveData(false, $request);
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

        return view('transaction-types.edit', [
            'transaction_type' => $transactionType
        ]);
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
        $transactionType = TransactionType::find($id);
        $transactionType->translations()->delete();
        $transactionType->delete();

        return redirect()->route('transaction-types')->with('message', 'messages.property-types-delete-success-message');
    }

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
}
