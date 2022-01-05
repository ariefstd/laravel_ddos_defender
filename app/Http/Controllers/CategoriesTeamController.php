<?php

namespace App\Http\Controllers;

use App\Models\CategoriesTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesTeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Category Team Show', ['only' => 'index']);
        $this->middleware('permission:Category Team Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Category Team Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Category Team Delete', ['only' => 'destroy']);
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
            $categories = CategoriesTeam::search($request->keyword)->orderBy('category_name', 'asc')->paginate(10);
        } else {
            $categories = CategoriesTeam::orderBy('category_name', 'asc')->paginate(10);
        }
        return view('categories-team.index', [
            'categories' => $categories
        ]);
    }

    public function select(Request $request)
    {
        $categories = [];

        if ($request->has('q')) {
            $search = $request->q;
            $categories = CategoriesTeam::select("id", "category_name")
                ->Where('category_name', 'LIKE', "%$search%")
                ->get();
        } else {
            $categories = CategoriesTeam::limit(10)->get();
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
        return view('categories-team.create', compact('statuses'));
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
            'category_name' => 'required|string|max:60|unique:categories_teams,category_name',
            'category_slug' => 'required|string|unique:categories_teams,category_slug',
        ]);

        CategoriesTeam::create([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Category', 'Added Category Success');
        return redirect()->route('categories-team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesTeam  $categoriesTeam
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesTeam $categoriesTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesTeam  $categoriesTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesTeam $categoriesTeam)
    {
        $statuses = $this->statuses();
        return view('categories-team.edit', compact('categoriesTeam', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesTeam  $categoriesTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesTeam $categoriesTeam)
    {
        $request->validate([
            'category_name' => 'required|string|max:60|unique:categories_teams,category_name,' . $categoriesTeam->id,
            'category_slug' => 'required|string|unique:categories_teams,category_slug,' . $categoriesTeam->id,
        ]);
        $categoriesTeam->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Category', 'Updated Category Success');
        return redirect()->route('categories-team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesTeam  $categoriesTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesTeam $categoriesTeam)
    {
        try {
            $categoriesTeam->delete();
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
