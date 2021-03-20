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
            'filterByCity' => $request->city,
            'filterByOwner' => isRole('owner'),
            'filterByYear' => $request->year,
            'filterByMonth' => $request->month,
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

    public function confirmEmail(Request $request)
    {
        $pm = PropertyManagement::find($request->source);
        $balance = PMHelper::getBalance($pm->id);
        $property = $pm->property->translate()->name;
        $data = [];
        $data['property'] = $property;
        $data['balance'] = $balance['balance'];
        $data['pendingAudit'] = $balance['pendingAudit'];
        $data['estimatedBalance'] = $balance['estimatedBalance'];
        $getUser = false;
        if ($pm->property->users->isNotEmpty()) {
            foreach ($pm->property->users as $getUser) {
                $getUser = User::find($getUser->id);
            }
        }

        $msg  = '';
        if ($getUser) {
            $msg .= 'Hello ' . $getUser->profile->full_name . '<br><br>';
            $msg .= 'Here are the details of your current balance<br>';
            $msg .= 'Date' . ': ' . getCurrentDateTime() . '<br>';
            $msg .= 'Property' . ': <strong>' . $data['property'] . '</strong><br>';
            $msg .= 'Balance' . ': <strong>' . priceFormat($data['balance']) . ' MXN</strong>';
            $msg .= '<hr>';
            $msg .= 'Hola ' . $getUser->profile->full_name . '<br><br>';
            $msg .= 'Aquí están los detalles de su balance actual<br>';
            $msg .= 'Fecha' . ': ' . getCurrentDateTime() . '<br>';
            $msg .= 'Propiedad' . ': <strong>' . $data['property'] . '</strong><br>';
            $msg .= 'Balance' . ': <strong>' . priceFormat($data['balance']) . ' MXN</strong><br><br>';
        }

        return $msg;
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
        $data['customMsg'] = $request->custom_msg;
        
        if ($pm->property->users->isNotEmpty()) {
            foreach ($pm->property->users as $getUser) {
                $getUser = User::find($getUser->id);
                $getUser->notify(new DetailsBalance((object) $data));
            }
        }

        $request->session()->flash('success', __('Email sended successfully'));

        return redirect()->back();
    }
}
