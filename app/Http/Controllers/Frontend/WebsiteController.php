<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function faq()
    {
        return view('frontend.website.faq');
    }

    public function about()
    {
        return view('frontend.website.about');
    }

    public function testimonials()
    {
        return view('frontend.website.testimonials');
    }

    public function policies()
    {
        return view('frontend.website.policies');
    }
    public function how()
    {
        return view('frontend.website.how');
    }
}
