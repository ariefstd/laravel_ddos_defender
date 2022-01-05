<?php

namespace App\Http\Controllers;

use App\Models\CategoriesGallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Gallery Category Show', ['only' => 'index']);
        $this->middleware('permission:Gallery Category Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Gallery Category Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Gallery Category Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = [];
        if ($request->get('keyword')) {
            $categories = CategoriesGallery::search($request->keyword)->orderBy('cat_gallery_name', 'asc')->paginate(10);
        } else {
            $categories = CategoriesGallery::orderBy('cat_gallery_name', 'asc')->paginate(10);
        }
        return view('categories-gallery.index', [
            'categories' => $categories
        ]);
    }

    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $categories = CategoriesGallery::select('id', 'cat_gallery_name')->search($request->q)->get();
        } else {
            $categories = CategoriesGallery::select('id', 'cat_gallery_name')->limit(5)->get();
        }

        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('categories-gallery.create', compact('statuses'));
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
            'cat_gallery_name' => 'required|string|max:60',
            'cat_gallery_slug' => 'required|string|unique:categories_galleries,cat_gallery_slug',
            'cat_gallery_seq' => 'required',

        ]);

        CategoriesGallery::create([
            'cat_gallery_name' => $request->cat_gallery_name,
            'cat_gallery_slug' => $request->cat_gallery_slug,
            'cat_gallery_seq' => $request->cat_gallery_seq,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Category', 'Added Category Success');
        return redirect()->route('categories-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesGallery  $categoriesGallery
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesGallery $categoriesGallery)
    {
        return view('categories-gallery.show', compact('categoriesGallery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesGallery  $categoriesGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesGallery $categoriesGallery)
    {
        $statuses = $this->statuses();
        return view('categories-gallery.edit', compact('categoriesGallery', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesGallery  $categoriesGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesGallery $categoriesGallery)
    {
        $request->validate([
            'cat_gallery_name' => 'required|string|max:60|unique:categories_galleries,cat_gallery_name,' . $categoriesGallery->id,
            'cat_gallery_slug' => 'required|string|unique:categories_galleries,cat_gallery_slug,' . $categoriesGallery->id,
            'cat_gallery_seq' => 'required',
        ]);

        $categoriesGallery->update([
            'cat_gallery_name' => $request->cat_gallery_name,
            'cat_gallery_slug' => $request->cat_gallery_slug,
            'cat_gallery_seq' => $request->cat_gallery_seq,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Update Category', 'Update Category Success');
        return redirect()->route('categories-gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesGallery  $categoriesGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesGallery $categoriesGallery)
    {
        try {
            $categoriesGallery->delete();
            Alert::success('Delete Category', 'Delete Category Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Category', 'Error' . $th->getMessage());
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
