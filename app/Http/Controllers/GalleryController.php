<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\CategoriesGallery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Gallery Show', ['only' => 'index']);
        $this->middleware('permission:Gallery Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Gallery Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Gallery Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $galleries = Gallery::with(['categories']);

        if ($request->get('categories')) {
            $category = $request->categories;
            $galleries->whereHas(
                'categories',
                function ($query) use ($category) {
                    $query->where('cat_gallery_name', 'LIKE', "%{$category}%");
                }
            );
        } else {
        }

        if ($request->get('keyword')) {
            $galleries->search($request->keyword);
        }
        return view('galleries.index', [
            'galleries' => $galleries->orderBy('created_at', 'desc')->paginate(7)->withQueryString(),
            'categoriesGallery' => CategoriesGallery::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoriesGallery::all();
        $statuses = $this->statuses();
        return view('galleries.create', compact('statuses', 'categories'));
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
            'image_name' => 'required|string|max:60|unique:galleries,image_name',
            'image_slug' => 'required|string|unique:galleries,image_slug',
            'image_image' => 'required',
            'category' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $gallery = Gallery::create([
                'image_name' => $request->image_name,
                'image_slug' => $request->image_slug,
                'image_image' => parse_url($request->image_image)['path'],
                'image_desc' => $request->image_desc,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            $gallery->categories()->attach($request->category);
            Alert::success('Add Gallery', 'Added Gallery Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th->getMessage());
        } finally {
            DB::commit();
        }

        //dd($request->all());
        return redirect()->route('gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $categories = $gallery->categories;

        return view('galleries.show', compact('gallery', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {

        $statuses = $this->statuses();
        return view('galleries.edit', compact('gallery', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image_name' => 'required|string|max:60',
                'image_slug' => 'required|string|unique:galleries,image_slug,' . $gallery->id,
                'image_image' => 'required',
                'category' => 'required'
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['category']) {
                $request['category'] = CategoriesGallery::select('id', 'cat_gallery_name')->whereIn('id', $request->category)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $gallery->update([
                'image_name' => $request->image_name,
                'image_slug' => $request->image_slug,
                'image_image' => parse_url($request->image_image)['path'],
                'image_desc' => $request->image_desc,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            $gallery->categories()->sync($request->category);

            Alert::success('Update Gallery', 'Updated Gallery Success');
            //dd($request->all());
            return redirect()->route('gallery.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::success('Update Gallery', 'Updated Gallery Success', ['error' => $th->getMessage()]);
            if ($request['category']) {
                $request['category'] = CategoriesGallery::select('id', 'cat_gallery_name')->whereIn('id', $request->category)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        try {
            $gallery->delete();
            Alert::success('Delete Gallery', 'Delete Gallery Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Gallery', 'Error' . $th->getMessage());
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
