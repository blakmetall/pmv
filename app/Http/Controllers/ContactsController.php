<?php

namespace App\Http\Controllers;

use App\Repositories\{ ContactsRepositoryInterface };
use Illuminate\Http\Request;
use App\Models\Contact;

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

        return view('contacts.create')
            ->with('contact', $contact);
    }

    public function store(Request $request)
    {
        $contact = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));
        return redirect(route('contacts.edit', [$contact->id]));
    }

    public function show(Contact $contact)
    {
        $contact = $this->repository->find($contact);

        return view('contacts.show')
            ->with('contact', $contact);
    }

    public function edit(Contact $contact)
    {
        $contact = $this->repository->find($contact);

        return view('contacts.edit')
            ->with('contact', $contact);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));
        return redirect( route('contacts.edit', [$id]) );
    }

    public function destroy(Request $request, $id)
    {
        if ( $this->repository->canDelete($id) ) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));
            return redirect(route('contacts'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));
        return redirect()->back();
    }
}
