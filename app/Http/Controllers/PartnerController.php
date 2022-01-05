<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Partner Show', ['only' => 'index']);
        $this->middleware('permission:Partner Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Partner Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Partner Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $partners = [];
        if ($request->get('keyword')) {
            $partners = Partner::search($request->keyword)->orderBy('partner_seq', 'asc')->paginate(10);
        } else {
            $partners = Partner::orderBy('partner_seq', 'asc')->paginate(10);
        }
        return view('partners.index', [
            'partners' => $partners,
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
        return view('partners.create', compact('statuses'));
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
            'partner_name' => 'required|string|max:60',
            'partner_slug' => 'required|string|unique:partners,partner_slug',
            'partner_logo' => 'required',
            'partner_seq' => 'required',

        ]);

        Partner::create([
            'partner_name' => $request->partner_name,
            'partner_slug' => $request->partner_slug,
            'partner_seq' => $request->partner_seq,
            'partner_logo' => parse_url($request->partner_logo)['path'],
            'partner_link' => $request->partner_link,
            'user_id' => $request->user_id,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Add Partner', 'Added Partner Success');
        return redirect()->route('partner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return view('partners.show', compact('partner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        $statuses = $this->statuses();
        return view('partners.edit', compact('partner', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'partner_name' => 'required|string|max:60',
            'partner_slug' => 'required|string|unique:partners,partner_slug,' . $partner->id,
            'partner_logo' => 'required',
            'partner_seq' => 'required',

        ]);

        $partner->update([
            'partner_name' => $request->partner_name,
            'partner_slug' => $request->partner_slug,
            'partner_seq' => $request->partner_seq,
            'partner_logo' => parse_url($request->partner_logo)['path'],
            'partner_link' => $request->partner_link,
            'user_id' => $request->user_id,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Partner', 'Updated Partner Success');
        return redirect()->route('partner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        try {
            $partner->delete();
            Alert::success('Delete Partner', 'Delete Partner Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Partner', 'Error' . $th->getMessage());
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
