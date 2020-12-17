<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyBooking;
use App\Repositories\PropertiesRepositoryInterface;

class VacationServicesController extends Controller
{

    private $propertiesRepository;

    public function __construct(
        PropertiesRepositoryInterface $propertiesRepository
    ) {
        $this->propertiesRepository = $propertiesRepository;
    }

    public function index(Request $request)
    {
        return view('public.pages.vacation-services.index');
    }

    public function searchBooking()
    {
        return view('public.pages.vacation-services.make-payment');
    }

    public function findBooking(Request $request)
    {
        $booking = PropertyBooking::find($request->booking_id);
        if (!$booking) {
            $request->session()->flash('error', __('Not Bookings Found'));
            return redirect(route('public.vacation-services.make-payment'));
        }
        return redirect(route('public.vacation-services.make-payment-verify', [$booking->id]));
    }

    public function resultsBookings(Request $request, PropertyBooking $booking)
    {
        $total    = $booking->total;
        $payments = $booking->payments;
        $reduced  = 0;
        if($payments){
            foreach ($payments as $pay) {
                $reduced += $pay->amount;
            }
        }
        $balance = $total - $reduced;
        $secure = 45;
        $total = 0;
        if ($balance == 0) {
            $request->session()->flash('success', __('Your reservation has been PAID IN FULL!'));
            $paid = true;
        } else if ($balance > 0) {
            $paid = false;
        }
        $property = $booking->property->translations()->where('language_id', LanguageHelper::current()->id)->first();
        $total = $booking->total + $secure;
        $mid = $total / 2;
        return view('public.pages.vacation-services.make-payment-verify')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('total', $total)
            ->with('mid', $mid)
            ->with('paid', $paid);
    }

    public function thankYou()
    {
        return view('public.pages.vacation-services.make-payment');
    }

    public function paymentMethods()
    {
        return view('public.pages.vacation-services.payment-methods');
    }

    public function rentalAgreement()
    {
        return view('public.pages.vacation-services.rental-agreement');
    }

    public function damageInsurance()
    {
        return view('public.pages.vacation-services.accidental-rental-damage-insurance');
    }
}
