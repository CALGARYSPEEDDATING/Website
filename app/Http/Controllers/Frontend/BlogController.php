<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('frontend.website.blogs.index');
    }

    public function show(Type $var = null)
    {
        return view('frontend.website.blogs.show');
    }
}
