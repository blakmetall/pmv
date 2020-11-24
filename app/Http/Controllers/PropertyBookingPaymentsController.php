<?php

namespace App\Http\Controllers;

use Notification;
use App\Notifications\DetailsPayment;
use Illuminate\Http\Request;
use App\Models\{PropertyBooking};
use App\Repositories\PropertyBookingsPaymentsRepositoryInterface;
use App\Repositories\PropertyBookingsRepositoryInterface;
use App\Repositories\TransactionSourcesRepositoryInterface;

class PropertyBookingPaymentsController extends Controller
{
    private $repository;
    private $bookingsRepository;
    private $transactionSourcesRepository;

    public function __construct(
        PropertyBookingsPaymentsRepositoryInterface $repository,
        PropertyBookingsRepositoryInterface $bookingsRepository,
        TransactionSourcesRepositoryInterface $transactionSourcesRepository
    ) {
        $this->repository = $repository;
        $this->bookingsRepository = $bookingsRepository;
        $this->transactionSourcesRepository = $transactionSourcesRepository;
    }

    public function index(Request $request, PropertyBooking $booking)
    {
        $search = trim($request->s);
        $payments = $this->repository->all($search, ['bookingID' => $booking->id]);

        return view('property-booking-payments.index')
            ->with('payments', $payments)
            ->with('booking', $booking)
            ->with('search', $search);
    }

    public function create(PropertyBooking $booking)
    {
        $payment = $this->repository->blueprint();
        $booking = $this->bookingsRepository->find($booking);
        $transactionSources = $this->transactionSourcesRepository->all('');

        return view('property-booking-payments.create')
            ->with('payment', $payment)
            ->with('booking', $booking)
            ->with('transactionSources', $transactionSources);
    }

    public function store(Request $request)
    {
        $payment = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        if ($request->email_notification) {
            return redirect(route('property-booking-payments.email', [$payment->id]));
        } else {
            return redirect(route('property-booking-payments.edit', [$payment->id]));
        }
    }

    public function email($id)
    {
        $payment = $this->repository->find($id);
        $booking = $this->bookingsRepository->find($payment->booking_id);
        $property = $booking->property;
        $serialOwners = [];
        foreach ($property->users as $owner) {
            $serialOwners[] = $owner->email;
        }
        $owners = implode(',', $serialOwners);

        return view('property-booking-payments.email')
            ->with('payment', $payment)
            ->with('booking', $booking)
            ->with('owners', $owners)
            ->with('property', $property);
    }

    public function sendEmail(Request $request, PropertyBooking $booking)
    {
        $guests = explode(',', $request->guests_recipients);
        $content = $request->guest_email_content;
        if ($guests) {
            foreach ($guests as $guest) {
                $this->notification($booking, $content, $guest);
            }
        }

        $owners = explode(',', $request->owners_recipients);
        if ($owners) {
            foreach ($owners as $owner) {
                $this->notification($booking, $content, $owner);
            }
        }
        return redirect(route('property-bookings.edit', [$booking->id]));
    }

    private function notification($booking, $content, $email)
    {
        Notification::route('mail', $email)
            ->notify(new DetailsPayment($content, $booking));
    }

    public function show($id)
    {
        $payment = $this->repository->find($id);
        $booking = $this->bookingsRepository->find($payment->booking_id);
        $property = $booking->property;
        $transactionSources = $this->transactionSourcesRepository->all('');

        return view('property-booking-payments.show')
            ->with('payment', $payment)
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('transactionSources', $transactionSources);
    }

    public function edit($id)
    {
        $payment = $this->repository->find($id);
        $booking = $this->bookingsRepository->find($payment->booking_id);
        $property = $booking->property;
        $transactionSources = $this->transactionSourcesRepository->all('');

        return view('property-booking-payments.edit')
            ->with('payment', $payment)
            ->with('booking', $booking)
            ->with('property', $property)
            ->with('transactionSources', $transactionSources);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        if ($request->email_notification) {
            return redirect(route('property-booking-payments.email', [$id]));
        } else {
            return redirect(route('property-booking-payments.edit', [$id]));
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {

            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect()->back();
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
