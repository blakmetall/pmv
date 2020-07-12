<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Property, User };

class BookingController extends Controller
{
    public function index(Request $request)
    {
        echo 'bookings will be here';
    }

    public function propertyBookings(Request $request, Property $property)
    {
        echo 'property bookings will be here';
        echo '<hr><pre>', print_r($property), '<pre>'; exit; 
    }

    public function ownerBookings(Request $request, User $owner)
    {
        echo 'owner bookings will be here';
        echo '<hr><pre>', print_r($userOwner), '<pre>'; exit; 
    }

    public function clientBookings(Request $request, User $client)
    {
        echo 'client bookings will be here';
        echo '<hr><pre>', print_r($userOwner), '<pre>'; exit; 
    }

    public function create()
    {
        echo __('Coming soon');
    }

    public function store(Request $request)
    {
        echo __('Coming soon');
    }

    public function show($id)
    {
        echo __('Coming soon');
    }

    public function edit($id)
    {
        echo __('Coming soon');
    }

    public function update(Request $request, $id)
    {
        echo __('Coming soon');
    }

    public function destroy($id)
    {
        echo __('Coming soon');
    }
}
