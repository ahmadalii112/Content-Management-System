<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdateRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('VerifyCategoryCount')->only(['create', 'store']);

    }


    public function index()
    {
        return view('Posts.index')->with('posts', Post::all());
    }


    public function create()
    {
//        $cat = Category::all();
//        dd($cat->pluck('id')->toArray());
        $data = DB::table('categories')->get();
        return view('Posts.create')
            ->with('categories', $data)
//            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('subcategory', SubCategory::all());

    }
    public function getsubcategory($category_id)
    {
        $sub = DB::table('sub_categories')->where('category_id', $category_id)->get();
        return response()->json($sub);
    }

    public function GetSubCatAgainstMainCatEdit($id)
    {
        return json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }

    public function editsubcategory($id)
    {

        return json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }


    public function store(CreatePostsRequest $request)
    {

        // Todo: 1-upload the image
        $image = $request->image->store('uploads', 'public');

        // Todo: 2-Create the Post

        $post = Post::create([
            'title' => $request['title'],
            'description' => $request['description'],

            'image' => $image,
            'content' => $request['content'],
            'published_at' => $request['published_at'],
            'category_id' => $request['category'],
            'sub_category_id'=> $request['subcategory'],
            'user_id' => auth()->user()->id,
        ]);
        //TODO: MANY TO MANY FOR ATTACHING TAGS
        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }


        // Todo: 4-Redirect
        return redirect(route('posts.index'));
    }

    public function show($id)
    {
        echo json_encode(DB::table('sub_categories')->where('category_id', $id)->get());
    }



    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $subcategory = DB::table('sub_categories')->where('category_id', $id)->get();
        return view('Posts.create')
            ->with('post', $post)
            ->with('categories', Category::all())
            ->with('tags', Tag::all())
            ->with('subcategories',$subcategory);

    }

    public function update(UpdateRequest $request, Post $post)
    {

        $data = $request->only(['title', 'description', 'published_at', 'content']);
        //check if new
        if ($request->hasFile('image')) {
            //upload it
            $image = $request->image->store('uploads', 'public');
            //delete old one
            Storage::delete($post->image);
            $data['image'] = $image;
        }
        //   
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        //Update Attributes
        $post->update($data);

        session()->flash('Success', 'Post has been Updated Successfully');
        return redirect(route('posts.index'));


    }


    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        if ($post->trashed()) {
            Storage::delete($post->image); #to delete image completely from the storage
            $post->forceDelete();
        } else {
            $post->delete();
        }

        session()->flash('success', 'Post Deleted successfully');
        return $this->index();
    }

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();
        session()->flash('success', 'Post Restore successfully');
        return redirect(route('posts.index'));
    }
}
