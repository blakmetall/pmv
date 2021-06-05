<?php

namespace App\Http\Controllers;

use Image;
use Storage;
use Notification;
use Intervention\Image\ImageManager;
use App\Notifications\DetailsPayment;
use Illuminate\Http\Request;
use App\Models\{PropertyBooking, PropertyBookingPayment};
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
            return redirect(route('property-bookings.edit', [$request->booking_id]));
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
        $content = nl2br($request->guest_email_content);
        if (count($guests)) {
            foreach ($guests as $guest) {
                $this->notification($booking, $content, $guest);
            }
        }

        $owners = explode(',', $request->owners_recipients);
        $content = nl2br($request->owners_email_content);
        if (count($owners)) {
            foreach ($owners as $owner) {
                $this->notification($booking, $content, $owner);
            }
        }

        $request->session()->flash('success', __('Email sent successfully'));

        return redirect(route('property-bookings.edit', [$booking->id]));
    }

    private function notification($booking, $content, $email)
    {
        Notification::route('mail', $email)->notify(new DetailsPayment($content, $booking));
    }

    public function generateImagePayment(Request $request)
    {
        $folder = 'payments';
        $id = $request->source['id'];
        $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->source['image']));
        $slug      = \Illuminate\Support\Str::slug('payment'.$id, '-');
        $timedFileName = $slug . '-' . strtotime('now') ;
        $fileName = $timedFileName . '.' . 'png';
        $getFilePath = $folder . '/' . $fileName;
        Storage::disk('public')->makeDirectory($folder);
        $filePath = public_path() . '/storage/' . $folder . '/' . $fileName;
        Image::make($img)->save($filePath);

        $payment = PropertyBookingPayment::find($id);
        $payment->file_url = Storage::url($getFilePath);
        $payment->save(); 

        return;
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

        if ($request->email_notification) {
            return redirect(route('property-booking-payments.email', [$id]));
        } else {
            return redirect(route('property-bookings.edit', [$request->booking_id]));
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
