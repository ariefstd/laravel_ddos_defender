<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class MetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Meta Show', ['only' => 'index']);
        $this->middleware('permission:Meta Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Meta Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Meta Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metas = [];
        if ($request->get('keyword')) {
            $metas = Meta::search($request->keyword)->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $metas = Meta::orderBy('created_at', 'desc')->paginate(9);
        }
        return view('metas.index', [
            'metas' => $metas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $metas = Meta::all();
        return view('metas.create', compact('metas'));
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
            'meta_page' => 'required|string|max:60|unique:metas,meta_page',
            'meta_title' => 'required|string|max:60|unique:metas,meta_title',
            'meta_slug' => 'required|string|unique:metas,meta_slug',
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
            'is_active' => 'required'
        ]);

        Meta::create([
            'meta_page' => $request->meta_page,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'meta_title' => $request->meta_title,
            'meta_slug' => $request->meta_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
            'user_id' => $request->user_id
        ]);
        Alert::success('Add Meta', 'Added Meta Success');
        return redirect()->route('metas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        return view('metas.show', compact('meta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function edit(Meta $meta)
    {
        return view('metas.edit', compact('meta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        $request->validate([
            'meta_page' => 'required|string|max:60',
            'meta_title' => 'required|string|max:60',
            'meta_slug' => 'required|string|unique:metas,meta_slug,' . $meta->id,
            'meta_description' => 'required|string',
            'meta_keyword' => 'required|string',
            'is_active' => 'required'
        ]);

        $meta->update([
            'meta_page' => $request->meta_page,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
            'meta_title' => $request->meta_title,
            'meta_slug' => $request->meta_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
            'user_id' => $request->user_id
        ]);
        Alert::success('Update Meta', 'Updated Meta Success');
        return redirect()->route('metas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
        try {
            $meta->delete();
            Alert::success('Delete Meta', 'Delete Meta Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Meta', 'Error' . $th->getMessage());
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
