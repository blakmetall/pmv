<?php

namespace App\Http\Controllers;

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

        return redirect(route('property-booking-payments.edit', [$payment->id]));
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

        return redirect(route('property-booking-payments.edit', [$id]));
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
