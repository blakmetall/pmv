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
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
