<?php

namespace App\Http\Controllers;

use App\Helpers\ContactsHelper;
use App\Models\Contact;
use App\Repositories\{ContactsRepositoryInterface};
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    private $repository;

    public function __construct(ContactsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $contacts = $this->repository->all($search);

        return view('contacts.index')
            ->with('contacts', $contacts)
            ->with('search', $search);
    }

    public function create()
    {
        $contact = $this->repository->blueprint();
        $types = ContactsHelper::getTypes();

        return view('contacts.create')
            ->with('contact', $contact)
            ->with('types', $types);
    }

    public function store(Request $request)
    {
        $contact = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        // redirect back if sent from modal
        if ($request->fromModal) {
            return redirect()->back();
        }

        return redirect(route('contacts.edit', [$contact->id]));
    }

    public function show(Contact $contact)
    {
        $contact = $this->repository->find($contact);
        $types = ContactsHelper::getTypes();

        return view('contacts.show')
            ->with('contact', $contact)
            ->with('types', $types);
    }

    public function edit(Contact $contact)
    {
        $contact = $this->repository->find($contact);
        $types = ContactsHelper::getTypes();

        return view('contacts.edit')
            ->with('contact', $contact)
            ->with('types', $types);
    }

    public function createAjax()
    {
        $contact = $this->repository->blueprint();
        $types = ContactsHelper::getTypes();

        return view('contacts.create-ajax')
            ->with('contact', $contact)
            ->with('types', $types)
            ->with('withModal', true);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('contacts.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('contacts'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
