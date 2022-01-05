<?php

namespace App\Http\Controllers;

use App\Models\CategoriesFood;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriesFoodController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Stall Category Show', ['only' => 'index']);
        $this->middleware('permission:Stall Category Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Stall Category Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Stall Category Delete', ['only' => 'destroy']);
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
            $categories = CategoriesFood::search($request->keyword)->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $categories = CategoriesFood::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('categories-food.index', [
            'categories' => $categories
        ]);
    }

    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $categories = CategoriesFood::select('id', 'food_name')->search($request->q)->get();
        } else {
            $categories = CategoriesFood::select('id', 'food_name')->limit(5)->get();
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
        return view('categories-food.create', compact('statuses'));
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
            'food_name' => 'required|string|max:60',
            'food_slug' => 'required|string|unique:food_categories,food_slug',
            'food_seq' => 'required',
            'food_thumbnail' => 'required',

        ]);

        CategoriesFood::create([
            'food_name' => $request->food_name,
            'food_slug' => $request->food_slug,
            'food_seq' => $request->food_seq,
            'food_thumbnail' => parse_url($request->food_thumbnail)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Food Category', 'Added Food Category Success');
        return redirect()->route('categories-food.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriesFood  $categoriesFood
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriesFood $categoriesFood)
    {
        return view('categories-food.show', compact('categoriesFood'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriesFood  $categoriesFood
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriesFood $categoriesFood)
    {
        $statuses = $this->statuses();
        return view('categories-food.edit', compact('categoriesFood', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriesFood  $categoriesFood
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriesFood $categoriesFood)
    {
        $request->validate([
            'food_name' => 'required|string|max:60,' . $categoriesFood->id,
            'food_slug' => 'required|string|unique:food_categories,food_slug,' . $categoriesFood->id,
            'food_seq' => 'required',
            'food_thumbnail' => 'required',

        ]);

        $categoriesFood->update([
            'food_name' => $request->food_name,
            'food_slug' => $request->food_slug,
            'food_seq' => $request->food_seq,
            'food_thumbnail' => parse_url($request->food_thumbnail)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Update Food Category', 'Update Food Category Success');
        return redirect()->route('categories-food.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriesFood  $categoriesFood
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriesFood $categoriesFood)
    {
        try {
            $categoriesFood->delete();
            Alert::success('Delete Food Category', 'Delete Food Category Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Food Category', 'Error' . $th->getMessage());
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
