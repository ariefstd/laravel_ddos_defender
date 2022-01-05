<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tags = [];
        if ($request->get('keyword')) {
            $tags = Tag::search($request->keyword)->orderBy('tag_title', 'asc')->paginate(10);
        } else {
            $tags = Tag::orderBy('tag_title', 'asc')->paginate(10);
        }
        return view('tags.index', [
            'tags' => $tags
        ]);
    }

    public function select(Request $request)
    {
        $tags = [];
        if ($request->has('q')) {
            $tags = Tag::select('id', 'tag_title')->search($request->q)->get();
        } else {
            $tags = Tag::select('id', 'tag_title')->limit(10)->get();
        }

        return response()->json($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('tags.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tag_title' => 'required|string|max:60',
            'tag_slug' => 'required|string|unique:tags,tag_slug',
        ]);
        Tag::create([
            'tag_title' => $request->tag_title,
            'tag_slug' => $request->tag_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Add Tag', 'Added Tag Success');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $statuses = $this->statuses();
        return view('tags.edit', compact('tag', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag_title' => 'required|string|max:60',
            'tag_slug' => 'required|string|unique:tags,tag_slug,' . $tag->id,
        ]);

        $tag->update([
            'tag_title' => $request->tag_title,
            'tag_slug' => $request->tag_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Tag', 'Updated Tag Success');
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();
            Alert::success('Delete Tag', 'Delete Tag Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Tag', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }

    private function statuses()
    {
        return [
            '0' => 'Draft',
            '1' => 'Published',
        ];
    }
}
