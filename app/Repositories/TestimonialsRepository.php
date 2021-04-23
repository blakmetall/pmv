<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Helpers\LanguageHelper;
use App\Models\{ Testimonial, TestimonialTranslation };
use App\Repositories\TestimonialsRepositoryInterface;
use App\Validations\TestimonialsValidations;

class TestimonialsRepository implements TestimonialsRepositoryInterface
{
    protected $model;
    protected $validation;

    public function __construct(Testimonial $testimonial)
    {
        $this->model = $testimonial;
        $this->validation = new TestimonialsValidations();
    }

    public function all($search = '', $config = [])
    {
        $shouldPaginate = isset($config['paginate']) ? $config['paginate'] : true;
        $shouldRandomize = isset($config['randomize']) ? $config['randomize'] : true;

        $lang = LanguageHelper::current();

        if ($search) {
            $query = 
                TestimonialTranslation::where('title', 'like', "%".$search."%")
                    ->orWhere('testimonial_id', $search);
        } else {
            $query = TestimonialTranslation::query();
        }

        $query
            ->where('language_id', $lang->id)
            ->with('testimonial')
            ->join('testimonials', 'testimonials.id', '=', 'testimonial_id');

        if($shouldRandomize) {
            $query->orderByRaw('RAND()');
        }else {
            $query->orderBy('testimonials.created_at', 'desc');
        }

        if($shouldPaginate) {
            $result = $query->paginate( 6 );
        }else{
            $result = $query->get();
        }
        
        return $result;
    }

    public function create(Request $request)
    {
        $this->validation->validate('create', $request);
        return $this->save($request);
    }

    public function update(Request $request, $id)
    {
        $this->validation->validate('edit', $request, $id);
        return $this->save($request, $id);
    }

    public function save(Request $request, $id = '')
    {
        $is_new = ! $id;

        if ($is_new) {
            $testimonial = $this->blueprint();
            $testimonial->save();
            
            $testimonial->en->language_id = LanguageHelper::getId('en');
            $testimonial->en->testimonial_id = $testimonial->id;
            
            $testimonial->es->language_id = LanguageHelper::getId('es');
            $testimonial->es->testimonial_id = $testimonial->id;
        }else{
            $testimonial = $this->find($id);
            $testimonial->save();
        }

        $testimonial->en->fill($request->en);
        $testimonial->en->save();
        
        $testimonial->es->fill($request->es);
        $testimonial->es->save();
        
        return $testimonial;
    }

    public function find($id_or_obj)
    {
        $is_obj = is_object($id_or_obj);
        $testimonial = ($is_obj) ? $id_or_obj : $this->model->find($id_or_obj);
        
        if ($testimonial) { 

            $testimonial->en = 
                $testimonial
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('en'))
                    ->first();
    
            $testimonial->es =
                 $testimonial
                    ->translations()
                    ->where('language_id', LanguageHelper::getId('es'))
                    ->first();
                          
        }

        if (!$testimonial) { 
            throw new ModelNotFoundException("Page not found");
        }

        return $testimonial;
    }
    
    public function delete($id)
    {
        $testimonial = $this->model->find($id);
        
        if ($testimonial) {

            $testimonial->translations()->where('language_id', LanguageHelper::getId('en'))->delete();
            $testimonial->translations()->where('language_id', LanguageHelper::getId('es'))->delete();

            $testimonial->delete();
        }

        return $testimonial; 
    }

    public function canDelete($id)
    {
        return true;
    }

    public function blueprint()
    {
        $testimonial = new Testimonial;
        $testimonial->en = new TestimonialTranslation;
        $testimonial->es = new TestimonialTranslation;

        return $testimonial;
    }
}