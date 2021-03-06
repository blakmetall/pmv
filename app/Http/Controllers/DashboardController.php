<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\{PropertiesRepositoryInterface, PropertyManagementTransactionsRepositoryInterface, PropertyBookingsRepositoryInterface};
use App\Helpers\RoleHelper;

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

        $_current_role = RoleHelper::current();

        // properties
        $properties = [];
        $showProperties = true;
        if ($topFilter != '' && $topFilter != 'properties') {
            $showProperties = false;
        }

        if ($showProperties && $_current_role->isAllowed('properties', 'index')) {
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

        if ($showTransactions && $_current_role->isAllowed('property-management', 'index')) {
            $config = [
                'orderBy' => 'date',
                'orderDirection' => 'up',
            ];
            $transactions = $this->pmTransactionsRepository->all($search, $config);
        }

        // bookings
        $bookings = [];
        $showBookings = true;
        if ($topFilter != '' && $topFilter != 'bookings') {
            $showBookings = false;
        }

        if ($showBookings && $_current_role->isAllowed('property-bookings', 'index')) {
            $config = [
                'reservation_id' => $search
            ];
            $bookings = $this->propertiesBookingsRepository->all($search, $config);
        }

        return view('dashboard.general-search')
            ->with('_current_role', $_current_role)
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
