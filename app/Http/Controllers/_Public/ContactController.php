<?php

namespace App\Http\Controllers\_Public;

use App;
use Notification;
use App\Helpers\LanguageHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Notifications\DetailsContact;
use App\Repositories\PagesRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    private $repository;

    public function __construct(
        PagesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $id = getPage('contact');
        $page = $this->repository->find($id);

        $captcha = rand(100000, 999999);
        $offices = getOffices();

        return view('public.pages.contact.index')
            ->with('page', $page)
            ->with('offices', $offices)
            ->with('captcha', $captcha);
        
    }

    public function sendEmail(Request $request)
    {
        $rules = [];
        $messages = [];

        $rules['name']     = 'required';
        $rules['mail']     = 'required|email';
        $rules['subject']  = 'required';
        $rules['category'] = 'required';
        $rules['message']  = 'required';

        //STEP 1
        $messages['name.required']     = __('Required name');
        $messages['mail.required']     = __('Required email');
        $messages['mail.email']        = __('Bad Format email');
        $messages['subject.required']  = __('Required subject');
        $messages['category.required'] = __('Required category');
        $messages['message.required']  = __('Required message');

        $validator = Validator::make($request->all(), $rules, $messages);

        if($request->code_catpcha != $request->captcha_response){
            $request->session()->flash('error', __('Code image wrong'));
        }else{
            if (!$validator->fails()) {
                if(isProduction()){
                    $email = 'vallarta@palmeravacations.com';
                }else{
                    $email = 'blakmetall@gmail.com';
                }

                switch ($request->category) {
                    case '1':
                        $category = __('Accounting');
                        break;
                    case '2':
                        $category = __('Concierge');
                        break;
                    case '3':
                        $category = __('Property Management');
                        break;
                    case '4':
                        $category = __('Vacation Services / Reservations');
                        break;
                    case '5':
                        $category = __('Website feedback');
                        break;
                    default:
                        $category = __('Website feedback');
                        break;
                }

                $data = [];

                $data['name'] = $request->name;
                $data['mail'] = $request->mail;
                $data['subject'] = $request->subject;
                $data['category'] = $category;
                $data['message'] = $request->message;

                $this->email($data, $email);

                $request->session()->flash('success', __('Message sent'));
            }else{
                $errors = '';

                foreach($validator->errors()->get('*') as $error){
                    $errors .= $error[0].'<br>';
                }

                $request->session()->flash('error', $errors);
            }
        }

        return redirect(route('public.contact', [App::getLocale()]))->withInput();
    }

    private function email($data, $email)
    {
        Notification::route('mail', $email)->notify(new DetailsContact((object) $data));
    }
}
