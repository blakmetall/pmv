<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Models\Property;
use App\Repositories\ContactsRepositoryInterface;
use Illuminate\Http\Request;

class PropertyContactsController extends Controller
{
    private $contactsRepository;

    public function __construct(ContactsRepositoryInterface $contactsRepository)
    {
        $this->contactsRepository = $contactsRepository;
    }

    public function index(Property $property)
    {
        $contacts =
            $property
            ->contacts()
            ->orderBy('firstname', 'asc')
            ->orderBy('lastname', 'asc')
            ->paginate();

        $owners = $property->users;

        return view('property-contacts.index')
            ->with('owners', $owners)
            ->with('contacts', $contacts)
            ->with('property', $property)
            ->with('search', '');
    }

    public function create(Property $property)
    {
        $config = ['activeOnly' => true];
        $contacts = $this->contactsRepository->all('', $config);

        return view('property-contacts.create')
            ->with('contacts', $contacts)
            ->with('property', $property);
    }

    public function store(Request $request, Property $property)
    {
        $property->contacts()->sync($request->contacts_ids);
        $request->session()->flash('success', __('Contacts Updated'));

        return redirect(route('property-contacts', $property->id));
    }
}
