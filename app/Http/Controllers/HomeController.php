<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;


class HomeController extends Controller
{
    public function index()
    {
        // $post = BlogPost::all();
        // dd(Auth::check());
        // dd(Auth::id());
        // dd(Auth::user());
        return view('home', ['posts' => BlogPost::all()]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function secret()
    {
        return view('secret');
    }
}
