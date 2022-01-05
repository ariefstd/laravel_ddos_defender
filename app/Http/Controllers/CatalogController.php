<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CatalogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Catalog Show', ['only' => 'index']);
        $this->middleware('permission:Catalog Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Catalog Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Catalog Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catalogs = [];
        if ($request->get('keyword')) {
            $catalogs = Catalog::search($request->keyword)->orderBy('catalog_seq', 'asc')->paginate(9);
        } else {
            $catalogs = Catalog::orderBy('catalog_seq', 'asc')->paginate(9);
        }
        return view('catalog.index', [
            'catalogs' => $catalogs,
            'statuses' => $this->statuses()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogs = Catalog::all();
        $statuses = $this->statuses();
        return view('catalog.create', compact('catalogs', 'statuses'));
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
            'catalog_name' => 'required|string|max:60|unique:catalogs,catalog_name',
            'catalog_slug' => 'required|string|unique:catalogs,catalog_slug',
            'catalog_file' => 'required',
            'catalog_seq' => 'required',

        ]);

        Catalog::create([
            'catalog_name' => $request->catalog_name,
            'catalog_slug' => $request->catalog_slug,
            'catalog_seq' => $request->catalog_seq,
            'catalog_file' => parse_url($request->catalog_file)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Add Catalog', 'Added Catalog Success');
        //dd($request->all());
        return redirect()->route('catalog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        $statuses = $this->statuses();
        return view('catalog.edit', compact('catalog', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalog $catalog)
    {
        $request->validate([
            'catalog_name' => 'required|string|max:60|unique:catalogs,catalog_name,' . $catalog->id,
            'catalog_slug' => 'required|string|unique:catalogs,catalog_slug,' . $catalog->id,
            'catalog_file' => 'required',
            'catalog_seq' => 'required',

        ]);

        $catalog->update([
            'catalog_name' => $request->catalog_name,
            'catalog_slug' => $request->catalog_slug,
            'catalog_seq' => $request->catalog_seq,
            'catalog_file' => parse_url($request->catalog_file)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
            'user_id' => $request->user_id
        ]);
        Alert::success('Update Catalog', 'Updated Catalog Success');
        return redirect()->route('catalog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catalog  $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        try {
            $catalog->delete();
            Alert::success('Delete Catalog', 'Delete Catalog Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Catalog', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }

    private function statuses()
    {
        return [
            '0' => 'Non-Active',
            '1' => 'Active',
        ];
    }
}
