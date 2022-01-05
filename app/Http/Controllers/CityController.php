<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:City Show', ['only' => 'index']);
        $this->middleware('permission:City Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:City Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:City Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = [];
        if ($request->get('keyword')) {
            $cities = City::search($request->keyword)->orderBy('city_name', 'asc')->paginate(9);
        } else {
            $cities = City::orderBy('city_name', 'asc')->paginate(10);
        }
        return view('cities.index', [
            'cities' => $cities
        ]);
    }

    public function select(Request $request)
    {
        $cities = [];

        if ($request->has('q')) {
            $search = $request->q;
            $cities = City::select("id", "city_name")
                ->Where('city_name', 'LIKE', "%$search%")
                ->get();
        } else {
            $cities = City::limit(10)->get();
        }
        return response()->json($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = $this->statuses();
        return view('cities.create', compact('statuses'));
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
            'city_name' => 'required|string|max:60|unique:cities,city_name',
            'city_slug' => 'required|string|unique:cities,city_slug',
        ]);

        City::create([
            'city_name' => $request->city_name,
            'city_slug' => $request->city_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add City', 'Added City Success');
        return redirect()->route('city.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $statuses = $this->statuses();
        return view('cities.edit', compact('city', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'city_name' => 'required|string|max:60|unique:cities,city_name,' . $city->id,
            'city_slug' => 'required|string|unique:cities,city_slug,' . $city->id,
        ]);
        $city->update([
            'city_name' => $request->city_name,
            'city_slug' => $request->city_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update City', 'Updated City Success');
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            $city->delete();
            Alert::success('Delete City', 'Delete City Success');
        } catch (\Throwable $th) {
            Alert::error('Delete City', 'Error' . $th->getMessage());
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
