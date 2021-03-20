<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\TestimonialsRepositoryInterface;

class TestimonialsController extends Controller
{
    private $repository;

    public function __construct(
        TestimonialsRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $search = trim($request->s);

        $testimonials = $this->repository->all($search, '');

        return view('testimonials.index')
            ->with('testimonials', $testimonials)
            ->with('search', $search);
    }

    public function create()
    {
        $testimonial = $this->repository->blueprint();

        return view('testimonials.create')
            ->with('testimonial', $testimonial);
    }

    public function store(Request $request)
    {
        $testimonial = $this->repository->create($request);
        $request->session()->flash('success', __('Record created successfully'));

        return redirect(route('testimonials.edit', [$testimonial->id]));
    }

    public function show(Testimonial $testimonial)
    {
        $testimonial = $this->repository->find($testimonial);

        return view('testimonials.show')
            ->with('testimonial', $testimonial);
    }


    public function edit(Testimonial $testimonial)
    {
        $testimonial = $this->repository->find($testimonial);

        return view('testimonials.edit')
            ->with('testimonial', $testimonial);
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        $request->session()->flash('success', __('Record updated successfully'));

        return redirect(route('testimonials.edit', [$id]));
    }

    public function destroy(Request $request, $id)
    {
        if ($this->repository->canDelete($id)) {
            $this->repository->delete($id);
            $request->session()->flash('success', __('Record deleted successfully'));

            return redirect(route('testimonials'));
        }

        $request->session()->flash('error', __("This record can't be deleted"));

        return redirect()->back();
    }
}
