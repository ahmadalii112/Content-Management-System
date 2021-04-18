<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return view('Blog.show')->with('post',$post);

    }
    public function category(Category $category)
    {
        return view('Blog.category')
//            ->with('category',$category)
            ->with('category',$category)
            ->with('posts',$category->post()->searched()->simplePaginate(3))
            ->with('categories',Category::all())
            ->with('tags',Tag::all());

    }
    public function tag(Tag $tag)
    {
        return view('Blog.tags')
            ->with('tag',$tag)
            ->with('categories',Category::all())
            ->with('tags',Tag::all())
            ->with('posts',$tag->posts()->searched()->simplePaginate(3));

    }
}
