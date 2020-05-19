<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;
use App\Validations\UsersValidations;
use App\Models\User;

class AgentsController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = trim($request->s);
        $agents = $this->usersRepository->all($search, ['agentsOnly' => true]);

        return view('agents.index')
            ->with('agents', $agents)
            ->with('search', $search);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $agent)
    {
        $agent = $this->usersRepository->find($agent);
        return view('agents.show')->with('agent', $agent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $agent)
    {        
        $agent = $this->usersRepository->find($agent);
        return view('agents.edit')->with('agent', $agent);
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
        UsersValidations::validateOnEditAgent($request, $agent->id);

        $this->usersRepository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('agents.edit', [$id]) );
    }

    /**
     * Change the status of current user agent
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate(Request $request, $id)
    {
        // change agent status
    }
}
