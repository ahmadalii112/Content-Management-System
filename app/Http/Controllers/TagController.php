<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\UpdateTagRequest;
use App\Http\Requests\tags\CreateTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }


    public function create()
    {
        return view('tags.create');
    }


    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name' => $request->name
        ]);

        // Todo: Flash Msg
        session()->flash('Success', 'Tags created Successfully.');

        return redirect(route('tags.index'));
    }


    public function show($id)
    {
        //
    }


    public function edit(Tag $tag)
    {
        return view('Tags.create')->with('tag', $tag);
    }


    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        session()->flash('Success', 'Tag Updated Successfully.');
        return redirect(route('tags.index'));
    }


    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0) {
            session()->flash('error', 'Tags Cannot be deleted Because it attached with some Posts');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('Success', 'Tag deleted Successfully');
        return redirect(route('tags.index'));
    }
}
