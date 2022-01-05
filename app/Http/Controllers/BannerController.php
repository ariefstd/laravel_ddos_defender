<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Banner Show', ['only' => 'index']);
        $this->middleware('permission:Banner Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Banner Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Banner Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $banners = [];
        if ($request->get('keyword')) {
            $banners = Banner::search($request->keyword)->orderBy('banner_seq', 'asc')->paginate(9);
        } else {
            $banners = Banner::orderBy('banner_seq', 'asc')->paginate(9);
        }
        return view('banners.index', [
            'banners' => $banners,
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
        $banners = Banner::all();
        $statuses = $this->statuses();
        return view('banners.create', compact('banners', 'statuses'));
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
            'banner_name' => 'required|string|max:60|unique:banners,banner_name',
            'banner_slug' => 'required|string|unique:banners,banner_slug',
            'banner_image' => 'required',
            'banner_seq' => 'required',

        ]);

        Banner::create([
            'banner_name' => $request->banner_name,
            'banner_slug' => $request->banner_slug,
            'banner_seq' => $request->banner_seq,
            'banner_image' => parse_url($request->banner_image)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Add Banner', 'Added Banner Success');
        //dd($request->all());
        return redirect()->route('banners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $statuses = $this->statuses();
        return view('banners.edit', compact('banner', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'banner_name' => 'required|string|max:60|unique:banners,banner_name,' . $banner->id,
            'banner_slug' => 'required|string|unique:banners,banner_slug,' . $banner->id,
            'banner_image' => 'required',
            'banner_seq' => 'required',

        ]);

        $banner->update([
            'banner_name' => $request->banner_name,
            'banner_slug' => $request->banner_slug,
            'banner_seq' => $request->banner_seq,
            'banner_image' => parse_url($request->banner_image)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
            'user_id' => $request->user_id
        ]);
        Alert::success('Update Banner', 'Updated Banner Success');
        return redirect()->route('banners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        try {
            $banner->delete();
            Alert::success('Delete Banner', 'Delete Banner Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Banner', 'Error' . $th->getMessage());
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
