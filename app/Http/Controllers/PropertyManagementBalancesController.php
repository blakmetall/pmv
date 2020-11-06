<?php

namespace App\Http\Controllers;

use App\Helpers\PMHelper;
use App\Helpers\UserHelper;
use App\Models\PropertyManagement;
use App\Models\User;
use App\Notifications\DetailsBalance;
use App\Repositories\CitiesRepositoryInterface;
use App\Repositories\PropertyManagementRepositoryInterface;
use Illuminate\Http\Request;

class PropertyManagementBalancesController extends Controller
{
    private $propertyManagementRepository;
    private $citiesRepository;

    public function __construct(
        PropertyManagementRepositoryInterface $propertyManagementRepository,
        CitiesRepositoryInterface $citiesRepository
    ) {
        $this->propertyManagementRepository = $propertyManagementRepository;
        $this->citiesRepository = $citiesRepository;
    }

    public function general(Request $request)
    {
        $search = trim($request->s);
        $config = ['paginate' => false];

        $config = [
            'filterByContactId' => UserHelper::getCurrentUserID(),
            'filterByCity' => $request->city,
            'filterByOwner' => isRole('owner'),
        ];
        $pm_items = $this->propertyManagementRepository->all($search, $config);
        $cities = $this->citiesRepository->all('', '');

        $totalBalances = [
            'balances' => 0,
            'pendingAudits' => 0,
            'estimatedBalances' => 0,
        ];

        if ($pm_items->count()) {
            foreach ($pm_items as $index => $pm_item) {
                $balance = PMHelper::getBalance($pm_item->id);
                $pm_items[$index]->_balance = $balance;

                // para no tomar calculos de balances de propiedades con property management finalizados
                // en el listado de balances general
                if ($pm_item->is_finished) {
                    continue;
                }

                $totalBalances['balances'] += $balance['balance'];
                $totalBalances['pendingAudits'] += $balance['pendingAudit'];
                $totalBalances['estimatedBalances'] += $balance['estimatedBalance'];
            }
        }

        return view('property-management-balances.general')
            ->with('pm_items', $pm_items)
            ->with('cities', $cities)
            ->with('totalBalances', $totalBalances);
    }

    public function email(Request $request, PropertyManagement $pm)
    {
        $balance = PMHelper::getBalance($pm->id);
        $property = $pm->property->translate()->name;
        $data = [];
        $data['property'] = $property;
        $data['balance'] = $balance['balance'];
        $data['pendingAudit'] = $balance['pendingAudit'];
        $data['estimatedBalance'] = $balance['estimatedBalance'];

        $user = User::find($pm->property->user_id);

        $user->notify(new DetailsBalance((object) $data));

        $request->session()->flash('success', __('Email sended successfully'));

        return redirect()->back();
    }
}
