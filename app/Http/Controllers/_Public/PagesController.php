<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PropertyBooking;

class PagesController extends Controller
{
    public function __construct()
    {
    }

    public function home(Request $request)
    {
        return view('public.pages.home');
    }

    public function searchBooking()
    {
        return view('public.pages.search-booking');
    }

    public function findBooking(Request $request)
    {
        $booking = PropertyBooking::find($request->booking_id);
        if (!$booking) {
            $request->session()->flash('error', __('Not Bookings Found'));
            return view('public.pages.search-booking');
        }
        return redirect(route('public.results-bookings', [$booking->id]));
    }

    public function resultsBookings(Request $request, PropertyBooking $booking)
    {
        $total    = $booking->total;
        $payments = $booking->payments;
        $reduced  = 0;
        foreach ($payments as $pay) {
            $reduced += $pay->amount;
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
        return view('public.pages.results-booking')
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('total', $total)
            ->with('mid', $mid)
            ->with('paid', $paid);
    }

    public function thankYou()
    {
        return view('public.pages.search-booking');
    }
}
