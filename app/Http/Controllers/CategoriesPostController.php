<?php

namespace App\Http\Controllers;

use App\Models\CategoriesPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Post Category Show', ['only' => 'index']);
        $this->middleware('permission:Post Category Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Post Category Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Post Category Delete', ['only' => 'destroy']);
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
            $categories = CategoriesPost::search($request->keyword)->orderBy('category_title', 'asc')->paginate(9);
        } else {
            $categories = CategoriesPost::orderBy('category_title', 'asc')->paginate(10);
        }
        return view('categories-posts.index', [
            'categories' => $categories
        ]);
    }

    public function select(Request $request)
    {
        $cities = CategoriesPost::select('id', 'category_title')->limit(10);
        if ($request->has('q')) {
            $cities->where('category_title', 'LIKE', "%{$request->q}%");
        }

        return response()->json($cities->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('categories-posts.create', compact('statuses'));
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
            'category_title' => 'required|string|max:60',
            'category_slug' => 'required|string|unique:categories_posts,category_slug',
            'category_desc' => 'required|string|max:240',

        ]);

        CategoriesPost::create([
            'category_title' => $request->category_title,
            'category_slug' => $request->category_slug,
            'category_desc' => $request->category_desc,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Category', 'Added Category Success');
        return redirect()->route('categories-post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesPost  $categoriesPost
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesPost $categoriesPost)
    {
        return view('categories-posts.show', compact('categoriesPost'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesPost  $categoriesPost
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesPost $categoriesPost)
    {
        $statuses = $this->statuses();
        return view('categories-posts.edit', compact('categoriesPost', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesPost  $categoriesPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesPost $categoriesPost)
    {
        $request->validate([
            'category_title' => 'required|string|max:60|unique:categories_posts,category_title,' . $categoriesPost->id,
            'category_slug' => 'required|string|unique:categories_posts,category_slug,' . $categoriesPost->id,
            'category_desc' => 'required|string|max:240',

        ]);

        $categoriesPost->update([
            'category_title' => $request->category_title,
            'category_slug' => $request->category_slug,
            'category_desc' => $request->category_desc,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Update Post Category', 'Update Post Category Success');
        return redirect()->route('categories-post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesPost  $categoriesPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesPost $categoriesPost)
    {
        try {
            $categoriesPost->delete();
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
