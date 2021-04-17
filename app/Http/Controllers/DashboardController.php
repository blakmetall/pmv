<?php

namespace App\Http\Controllers;

use App\Repositories\PropertiesRepositoryInterface;
use App\Repositories\PropertyManagementTransactionsRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $pmTransactionsRepository;
    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        PropertyManagementTransactionsRepositoryInterface $pmTransactionsRepository
    ) {
        $this->middleware('auth');
        $this->pmTransactionsRepository = $pmTransactionsRepository;
        $this->propertiesRepository = $propertiesRepository;
    }

    public function index()
    {
        return view('dashboard.index');
    }

    public function generalSearch(Request $request)
    {
        $search = trim($request->topSearch);

        $topFilter = $request->topFilter;

        // properties
        $properties = [];
        $showProperties = true;
        if ($topFilter != '' && $topFilter != 'properties') {
            $showProperties = false;
        }
        if ($showProperties) {
            $config = [
                'filterByWorkgroup' => true,
            ];
            $properties = $this->propertiesRepository->all($search, $config);
        }

        // transactions
        $transactions = [];
        $showTransactions = true;
        if ($topFilter != '' && $topFilter != 'transactions') {
            $showTransactions = false;
        }
        if ($showTransactions) {
            $config = [];
            $transactions = $this->pmTransactionsRepository->all($search, $config);
        }

        return view('dashboard.general-search')
            ->with('properties', $properties)
            ->with('showProperties', $showProperties)
            ->with('transactions', $transactions)
            ->with('showTransactions', $showTransactions);
    }

    public function maintenance()
    {
        return view('dashboard.maintenance');
    }
}
