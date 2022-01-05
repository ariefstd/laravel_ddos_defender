<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Region Show', ['only' => 'index']);
        $this->middleware('permission:Region Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Region Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Region Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = Region::with(['city']);
        if ($request->get('city')) {
            $city = $request->city;
            $regions->whereHas(
                'city',
                function ($query) use ($city) {
                    $query->where('city_name', 'LIKE', "%{$city}%");
                }
            );
        } else {
        }

        if ($request->get('keyword')) {
            $regions->search($request->keyword);
        }
        return view('regions.index', [
            'regions' => $regions->orderBy('region_name', 'asc')->paginate(10)->withQueryString(),
            'cities' => City::all()
        ]);
    }

    public function select(Request $request)
    {
        $regions = [];
        $cityID = $request->cityID;
        if ($request->has('q')) {
            $search = $request->q;
            $regions = Region::select("id", "region_name")
                ->where('city_id', $cityID)
                ->Where('region_name', 'LIKE', "%$search%")
                ->get();
        } else {
            $regions = Region::where('city_id', $cityID)->limit(10)->get();
            //"Choose City First";

        }
        return response()->json($regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('regions.create', compact('statuses'));
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
                "region_name" => "required|string|max:30",
                "city" => "required",
                'region_slug' => 'required|string|unique:regions,region_slug',

            ],
            []
        );

        Region::create([
            'region_name' => $request->region_name,
            'region_slug' => $request->region_slug,
            'city_id' => $request->city,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Region', 'Added Region Success');
        return redirect()->route('region.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $statuses = $this->statuses();
        $citySelected = $region->city;
        return view('regions.edit', compact('region', 'statuses', 'citySelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'region_name' => 'required|string|max:60|unique:regions,region_name,' . $region->id,
            'region_slug' => 'required|string|unique:regions,region_slug,' . $region->id,
            "city" => "required",
        ]);
        $region->update([
            'region_name' => $request->region_name,
            'region_slug' => $request->region_slug,
            'city_id' => $request->city,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Region', 'Updated Region Success');
        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        try {
            $region->delete();
            Alert::success('Delete Region', 'Delete Region Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Region', 'Error' . $th->getMessage());
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
