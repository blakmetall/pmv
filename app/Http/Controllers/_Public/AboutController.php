<?php

namespace App\Http\Controllers\_Public;

use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Testimonial;
use App\Repositories\PagesRepositoryInterface;
use App\Repositories\TestimonialsRepositoryInterface;

class AboutController extends Controller
{

    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository,
        TestimonialsRepositoryInterface $testimonialsRepository
    ) {
        $this->repository = $repository;
        $this->testimonialsRepository = $testimonialsRepository;
    }

    public function index(Request $request)
    {
        $id = getPage('about');
        $page = $this->repository->find($id);
        return view('public.pages.about.index')->with('page', $page);
    }

    public function puertoVallarta(Request $request)
    {
        $id = getPage('puerto-vallarta-history');
        $page = $this->repository->find($id);
        return view('public.pages.about.puerto-vallarta-history')->with('page', $page);
    }

    public function nuevoVallarta(Request $request)
    {
        $id = getPage('nuevo-vallarta-history');
        $page = $this->repository->find($id);
        return view('public.pages.about.nuevo-vallarta-history')->with('page', $page);
    }

    public function mazatlanVallarta(Request $request)
    {
        $id = getPage('mazatlan-history');
        $page = $this->repository->find($id);
        return view('public.pages.about.mazatlan-history')->with('page', $page);
    }

    public function testimonials(Request $request)
    {
        $id = getPage('testimonials');
        $page = $this->repository->find($id);
        $config = ['paginate' => true];
        $testimonials = $this->testimonialsRepository->all('', $config);
        return view('public.pages.about.testimonials')
            ->with('page', $page)
            ->with('testimonials', $testimonials);
    }

    public function testimonialDetail(Testimonial $id)
    {
        $testimonial = $this->testimonialsRepository->find($id);
        return view('public.pages.about.testimonial-detail')
            ->with('testimonial', $testimonial);
    }

    public function privacyPolicy(Request $request)
    {
        $id = getPage('privacy-policy');
        $page = $this->repository->find($id);
        return view('public.pages.about.privacy-policy')->with('page', $page);
    }

    public function termsOfUse(Request $request)
    {
        $id = getPage('terms-of-use');
        $page = $this->repository->find($id);
        return view('public.pages.about.terms-of-use')->with('page', $page);
    }

    public function realEstateBusinessDirectory(Request $request)
    {
        $id = getPage('real-estate-business-directory');
        $page = $this->repository->find($id);
        return view('public.pages.about.real-estate-business-directory')->with('page', $page);
    }

    public function lgbtBusinessDirectory(Request $request)
    {
        $id = getPage('lgbt-business-directory');
        $page = $this->repository->find($id);
        return view('public.pages.about.lgbt-business-directory')->with('page', $page);
    }
}
