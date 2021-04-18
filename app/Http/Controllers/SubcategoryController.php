<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subcategory\CreateSubRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('Subcategories.index')->with('subcategories', SubCategory::all());
    }

    public function create()
    {
        // $category = DB::select('select * from categories');
        $category = Category::all();
        return view('Subcategories.create')->with('categories', $category);
    }


    public function edit(Category $category)
    {
        return view('Categories.create')->with('category', $category);
    }

    public function store(CreateSubRequest $request)
    {

//        return "sub hits";
        $sub = SubCategory::create([
            'subcategory' => $request->subcategory,
            'category_id' => $request->category,
        ]);
//            dd($sub);
//
        // Todo: Flash Msg
        session()->flash('Success', 'Categories created Successfully.');

        return redirect(route('subcategories.index'));


    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        session()->flash('Success', 'SubCategory deleted Successfully');
        return redirect(route('subcategories.index'));

    }



}
