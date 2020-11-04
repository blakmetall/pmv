<?php

namespace App\Http\Controllers;

use App\Repositories\{ContactsRepositoryInterface, UsersRepositoryInterface};
use Illuminate\Http\Request;
use App\Models\Property;
use App\Helpers\UserHelper;

class PropertyContactsController extends Controller
{
    private $repository;
    private $contactsRepository;

    public function __construct(
        ContactsRepositoryInterface $contactsRepository,
        UsersRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        $this->contactsRepository = $contactsRepository;
    }

    public function index(Property $property)
    {
        $contacts =
            $property
            ->contacts()->whereHas('profile', function ($property) {
                $property
                    ->where('profiles.contact_type', '!=', 'home-owner');
            })
            ->paginate();

        $owner = $property->user;
        return view('property-contacts.index')
            ->with('owner', $owner)
            ->with('contacts', $contacts)
            ->with('property', $property)
            ->with('search', '');
    }

    public function create(Property $property)
    {
        $config = ['contactsOnly' => true];
        // if (RoleHelper::is('owner') || RoleHelper::is('regular')) {
        $config['filterByUserId'] = UserHelper::getCurrentUserID();
        // }
        $contacts = $this->repository->all('', $config);

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
