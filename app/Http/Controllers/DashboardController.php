<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{PropertiesRepositoryInterface, PropertyManagementTransactionsRepositoryInterface, PropertyBookingsRepositoryInterface};

class DashboardController extends Controller
{
    private $pmTransactionsRepository;
    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository,
        PropertyManagementTransactionsRepositoryInterface $pmTransactionsRepository,
        PropertyBookingsRepositoryInterface  $propertiesBookingsRepository
    ) {
        $this->middleware('auth');
        $this->pmTransactionsRepository = $pmTransactionsRepository;
        $this->propertiesRepository = $propertiesRepository;
        $this->propertiesBookingsRepository = $propertiesBookingsRepository;
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

        // bookings
        $bookings = [];
        $showBookings = true;
        if ($topFilter != '' && $topFilter != 'bookings') {
            $showBookings = false;
        }
        if ($showBookings) {
            $config = [
                'filterById' => $search
            ];
            $bookings = $this->propertiesBookingsRepository->all($search, $config);
        }

        return view('dashboard.general-search')
            ->with('properties', $properties)
            ->with('showProperties', $showProperties)
            ->with('transactions', $transactions)
            ->with('showTransactions', $showTransactions)
            ->with('bookings', $bookings)
            ->with('showBookings', $showBookings);
    }

    public function maintenance()
    {
        return view('dashboard.maintenance');
    }
}
