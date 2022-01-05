<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Market;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MarketController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Market Show', ['only' => 'index']);
        $this->middleware('permission:Market Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Market Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Market Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $optionCity = ['value' => null, 'label' => ''];
        $optionRegion = ['value' => null, 'label' => ''];
        $markets = Market::with(['city', 'region']);

        if ($request->get('city')) {
            $markets->where('city_id', $request->city);
            $city = City::where('id', $request->city)->first();
            $optionCity = [
                'value' =>  $city->id,
                'label' => $city->city_name
            ];
        }

        if ($request->get('region')) {
            $markets->where('region_id', $request->region);
            $region = region::where('id', $request->region)->first();
            $optionRegion = [
                'value' =>  $region->id,
                'label' => $region->region_name
            ];
        }

        if ($request->get('keyword')) {
            $markets->where('market_name', 'LIKE', "%{$request->keyword}%");
        }

        return view('markets.index', [
            'markets' => $markets->orderBy('market_name', 'asc')->paginate(10),
            'optionCity' => $optionCity,
            'optionRegion' => $optionRegion,
        ]);

        //dd($request->all());
    }

    public function select(Request $request)
    {
        $markets = [];
        $regionID = $request->regionID;
        if ($request->has('q')) {
            $search = $request->q;
            $markets = Market::select("id", "market_name")
                ->where('region_id', $regionID)
                ->Where('market_name', 'LIKE', "%$search%")
                ->get();
        } else {
            $markets = Market::where('region_id', $regionID)->limit(10)->get();
        }
        return response()->json($markets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('markets.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate(
            [
                'city' => 'required',
                'region' => 'required',
                'market_name' => 'required|string|max:30',
                'market_slug' => 'required|string|unique:markets,market_slug',
                'market_thumbnail' => 'required',
                'market_lat' => 'required',
                'market_long' => 'required',
                'market_address' => 'required',
                'market_gmap' => 'required',
                'market_phone' => 'required',
                'market_wa' => 'required',

            ],
            []
        );

        Market::create([
            'city_id' => $request->city,
            'region_id' => $request->region,
            'market_name' => $request->market_name,
            'market_slug' => $request->market_slug,
            'market_thumbnail' => parse_url($request->market_thumbnail)['path'],
            'market_lat' => $request->market_lat,
            'market_long' => $request->market_long,
            'market_address' => $request->market_address,
            'market_phone' => $request->market_phone,
            'market_wa' => $request->market_wa,
            'market_gmap' => $request->market_gmap,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Market', 'Added Market Success');
        //dd($request->all());
        return redirect()->route('market.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function show(Market $market)
    {
        return view('markets.show', compact('market'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function edit(Market $market)
    {
        $statuses = $this->statuses();
        $citySelected = $market->city;
        $regionSelected = $market->region;
        return view('markets.edit', compact('market', 'statuses', 'regionSelected', 'citySelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Market $market)
    {
        $request->validate([
            'city' => 'required',
            'region' => 'required',
            'market_name' => 'required|string|max:30,' . $market->id,
            'market_slug' => 'required|string|unique:markets,market_slug,' . $market->id,
            'market_thumbnail' => 'required',
            'market_lat' => 'required',
            'market_long' => 'required',
            'market_address' => 'required',
            'market_gmap' => 'required',
            'market_phone' => 'required',
            'market_wa' => 'required',

        ]);
        $market->update([
            'city_id' => $request->city,
            'region_id' => $request->region,
            'market_name' => $request->market_name,
            'market_slug' => $request->market_slug,
            'market_thumbnail' => parse_url($request->market_thumbnail)['path'],
            'market_lat' => $request->market_lat,
            'market_long' => $request->market_long,
            'market_address' => $request->market_address,
            'market_phone' => $request->market_phone,
            'market_wa' => $request->market_wa,
            'market_gmap' => $request->market_gmap,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Market', 'Updated Market Success');
        return redirect()->route('market.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Market  $market
     * @return \Illuminate\Http\Response
     */
    public function destroy(Market $market)
    {
        try {
            $market->delete();
            Alert::success('Delete Market', 'Delete Market Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Market', 'Error' . $th->getMessage());
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
