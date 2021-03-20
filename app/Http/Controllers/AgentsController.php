<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositoryInterface;

class AgentsController extends Controller
{
    private $usersRepository;

    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);
        $agents = $this->usersRepository->all($search, ['agentsOnly' => true]);

        return view('agents.index')
            ->with('agents', $agents)
            ->with('search', $search);
    }
}
