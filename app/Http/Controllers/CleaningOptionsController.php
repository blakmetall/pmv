<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Repositories\CleaningOptionsRepositoryInterface;
use App\Models\{ CleaningOption, CleaningOptionTranslation };

class CleaningOptionsController extends Controller
{
    private $repository;

    public function __construct(CleaningOptionsRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $cleaning_options = $this->repository->all($search);
        
        return view('cleaning-options.index')
            ->with('cleaning_options', $cleaning_options)
            ->with('search', $search);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cleaning_option = $this->repository->blueprint();
        return view('cleaning-options.create')->with('cleaning_option', $cleaning_option);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cleaning_option = $this->repository->create($request);
        return redirect(route('cleaning-options.edit', [$cleaning_option->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CleaningOption $cleaning_option)
    {
        $cleaning_option = $this->repository->find($cleaning_option);        
        return view('cleaning-options.show')->with('cleaning_option', $cleaning_option);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CleaningOption $cleaning_option)
    {
        $cleaning_option = $this->repository->find($cleaning_option);
        return view('cleaning-options.edit')->with('cleaning_option', $cleaning_option);
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
        $this->repository->update($request, $id);
        return redirect(route('cleaning-options.edit', [$id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        return redirect(route('cleaning-options'));
    }
}
