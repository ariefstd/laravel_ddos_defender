<?php

namespace App\Http\Controllers;

use App\Models\BannerPromo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BannerPromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Banner Promo Show', ['only' => 'index']);
        $this->middleware('permission:Banner Promo Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Banner Promo Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Banner Promo Delete', ['only' => 'destroy']);
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
            $banners = BannerPromo::search($request->keyword)->orderBy('banner_seq', 'asc')->paginate(9);
        } else {
            $banners = BannerPromo::orderBy('banner_seq', 'asc')->paginate(9);
        }
        return view('banner-promo.index', [
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
        $banners = BannerPromo::all();
        $statuses = $this->statuses();
        return view('banner-promo.create', compact('banners', 'statuses'));
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
            'banner_name' => 'required|string|max:60|unique:banner_promos,banner_name',
            'banner_slug' => 'required|string|unique:banner_promos,banner_slug',
            'banner_image' => 'required',
            'banner_seq' => 'required',

        ]);

        BannerPromo::create([
            'banner_name' => $request->banner_name,
            'banner_slug' => $request->banner_slug,
            'banner_seq' => $request->banner_seq,
            'banner_link' => $request->banner_link,
            'banner_image' => parse_url($request->banner_image)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Add Banner Promo', 'Added Banner Promo Success');
        //dd($request->all());
        return redirect()->route('banner-promo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerPromo  $bannerPromo
     * @return \Illuminate\Http\Response
     */
    public function show(BannerPromo $bannerPromo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerPromo  $bannerPromo
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerPromo $bannerPromo)
    {
        $statuses = $this->statuses();
        return view('banner-promo.edit', compact('bannerPromo', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerPromo  $bannerPromo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerPromo $bannerPromo)
    {
        $request->validate([
            'banner_name' => 'required|string|max:60|unique:banner_promos,banner_name,' . $bannerPromo->id,
            'banner_slug' => 'required|string|unique:banner_promos,banner_slug,' . $bannerPromo->id,
            'banner_image' => 'required',
            'banner_seq' => 'required',

        ]);

        $bannerPromo->update([
            'banner_name' => $request->banner_name,
            'banner_slug' => $request->banner_slug,
            'banner_seq' => $request->banner_seq,
            'banner_link' => $request->banner_link,
            'banner_image' => parse_url($request->banner_image)['path'],
            'is_active' => ($request->is_active) ? '1' : '0',
            'user_id' => $request->user_id
        ]);
        Alert::success('Update Banner Promo', 'Updated Banner Promo Success');
        return redirect()->route('banner-promo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerPromo  $bannerPromo
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerPromo $bannerPromo)
    {
        try {
            $bannerPromo->delete();
            Alert::success('Delete Banner Promo', 'Delete Banner Promo Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Banner Promo', 'Error' . $th->getMessage());
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
