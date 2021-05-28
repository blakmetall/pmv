<?php

namespace App\Http\Controllers\_Public;

use App;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PropertyBooking;
use App\Repositories\PagesRepositoryInterface;
use App\Repositories\PaymentMethodsRepositoryInterface;

class VacationServicesController extends Controller
{

    private $repository;
    private $paymentMethodsRepository;

    public function __construct(
        PagesRepositoryInterface $repository,
        PaymentMethodsRepositoryInterface $paymentMethodsRepository
    ) {
        $this->repository = $repository;
        $this->paymentMethodsRepository = $paymentMethodsRepository;
    }

    public function index()
    {
        $id = getPage('vacation-services');
        $page = $this->repository->find($id);

        return view('public.pages.vacation-services.index')->with('page', $page);
    }

    public function searchBooking()
    {
        return view('public.pages.vacation-services.make-payment');
    }

    public function findBooking(Request $request)
    {
        $booking = PropertyBooking::find($request->booking_id);
        
        if (!$booking) {
            $request->session()->flash('error', __('No Bookings Found'));
            return redirect(route('public.vacation-services.make-payment', [App::getLocale()]));
        }

        return redirect(route('public.vacation-services.make-payment-verify', [App::getLocale(), $booking->id]));
    }

    public function resultsBookings(Request $request, $locale, PropertyBooking $booking)
    {
        $total    = $booking->total;
        $payments = $booking->payments;

        $reduced  = 0;
        if($payments){
            foreach ($payments as $pay) {
                if($pay->is_paid) {
                    $reduced += $pay->amount;
                }
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
        }else if ($balance < 0) {
            $request->session()->flash('success', __('Your reservations has credit'));
            $paid = true;
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
        $id = getPage('payment-methods');
        $page = $this->repository->find($id);

        $config = ['paginate' => false];
        $paymentMethods = $this->paymentMethodsRepository->all('', $config);
        
        return view('public.pages.vacation-services.payment-methods')
            ->with('page', $page)
            ->with('paymentMethods', $paymentMethods);
    }

    public function rentalAgreement()
    {
        $id = getPage('rental-agreement');
        $page = $this->repository->find($id);

        return view('public.pages.vacation-services.rental-agreement')->with('page', $page);
    }

    public function damageInsurance()
    {
        $id = getPage('accidental-rental-damage-insurance');
        $page = $this->repository->find($id);
        
        return view('public.pages.vacation-services.accidental-rental-damage-insurance')->with('page', $page);
    }
}
