<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\PaymentMethodsRepositoryInterface;

class PaymentMethodsController extends Controller
{
    private $repository;

    public function __construct(
        PaymentMethodsRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $paymentMethods = $this->repository->all($search, '');

        return view('payment-methods.index')
            ->with('paymentMethods', $paymentMethods)
            ->with('search', $search);
    }

    public function create()
    {
        $paymentMethod = $this->repository->blueprint();

        return view('payment-methods.create')
            ->with('paymentMethod', $paymentMethod);
    }

    public function store(Request $request)
    {
        $paymentMethod = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('payment-methods.edit', [$paymentMethod->id]));
    }

    public function show(PaymentMethod $paymentMethod)
    {
        $paymentMethod = $this->repository->find($paymentMethod);

        return view('payment-methods.show')
            ->with('paymentMethod', $paymentMethod);
    }


    public function edit(PaymentMethod $paymentMethod)
    {
        $paymentMethod = $this->repository->find($paymentMethod);

        return view('payment-methods.edit')
            ->with('paymentMethod', $paymentMethod);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('payment-methods.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('payment-methods'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
