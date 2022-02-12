<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class PostTagController extends Controller
{
    public function index($tag){

        $tag = Tag::findOrFail($tag);

        return view('posts.index', [
                'post' => $tag->blogposts()
                ->latest()
                ->withCount('comments')
                ->with('user', 'tags')
                ->get(),
            ]);

    }
}
