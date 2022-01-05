<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Promo Show', ['only' => 'index']);
        $this->middleware('permission:Promo Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Promo Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Promo Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $promos = [];
        if ($request->get('keyword')) {
            $promos = Promo::search($request->keyword)->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $promos = Promo::orderBy('created_at', 'desc')->paginate(9);
        }
        return view('promos.index', [
            'promos' => $promos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('promos.create', compact('statuses'));
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
            'promo_title' => 'required|string|max:60|unique:promos,promo_title',
            'promo_slug' => 'required|string|unique:promos,promo_slug',
            'promo_thumbnail' => 'required',
            'promo_excerpt' => 'required|string|max:500',
            'promo_description' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $promo = Promo::create([
                'promo_title' => $request->promo_title,
                'promo_slug' => $request->promo_slug,
                'promo_thumbnail' => parse_url($request->promo_thumbnail)['path'],
                'promo_excerpt' => $request->promo_excerpt,
                'promo_description' => $request->promo_description,
                'promo_meta_title' => $request->promo_meta_title,
                'promo_meta_description' => $request->promo_meta_description,
                'promo_meta_keyword' => $request->promo_meta_keyword,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            Alert::success('Add Promo', 'Added Promo Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th->getMessage());
        } finally {
            DB::commit();
        }

        //dd($request->all());
        return redirect()->route('promo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function show(Promo $promo)
    {

        return view('promos.show', compact('promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        $statuses = $this->statuses();
        return view('promos.edit', compact('promo', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promo $promo)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'promo_title' => 'required|string|max:60',
                'promo_slug' => 'required|string|unique:promos,promo_slug,' . $promo->id,
                'promo_thumbnail' => 'required',
                'promo_excerpt' => 'required|string|max:500',
                'promo_description' => 'required|string',
            ],
            [],
        );

        DB::beginTransaction();
        try {
            $promo->update([
                'promo_title' => $request->promo_title,
                'promo_slug' => $request->promo_slug,
                'promo_thumbnail' => parse_url($request->promo_thumbnail)['path'],
                'promo_excerpt' => $request->promo_excerpt,
                'promo_description' => $request->promo_description,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            Alert::success('Update Promo', 'Updated Promo Success');
            //dd($request->all());
            return redirect()->route('promo.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::success('Update Promo', 'Updated Promo Success', ['error' => $th->getMessage()]);
        } finally {
            DB::commit();
        }
        return redirect()->route('promo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        try {
            $promo->delete();
            Alert::success('Delete Promo', 'Delete Promo Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Promo', 'Error' . $th->getMessage());
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
