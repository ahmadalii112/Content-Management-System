<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        /* Old way of Doing Search
        $search = request()->query('search');
        if($search)
        {
            $posts = Post::where('title','LIKE',"%{$search}%")->simplePaginate(3);
        }
        else{
        $posts = Post::simplePaginate(2);
        }*/

        # Using Post Model Method for Search

        return view('welcome')
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('posts', Post::searched()->simplePaginate(4)); # searched function it  is in Post Model scopeSearched Method

    }
}
