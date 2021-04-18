<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('Categories.index')->with('categories',Category::all());
    }


    public function create()
    {
        return view('Categories.create');
    }


    public function store(CreateCategoryRequest $request)
    {
        Category::create([
           'name'=>$request->name
        ]);

        // Todo: Flash Msg
        session()->flash('Success','Categories created Successfully.');

        return redirect(route('categories.index'));
//        return redirect()->route('categories.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('Categories.create')->with('category',$category);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        session()->flash('Success','Categories Updated Successfully.');
        return redirect(route('categories.index'));
    }


    public function destroy(Category $category)
    {
        if ($category->post->count() > 0) {
            session()->flash('error', 'Category Cannot be deleted Because it attached with some Posts');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('Success','Category deleted Successfully');
        return redirect(route('categories.index'));
    }
}
