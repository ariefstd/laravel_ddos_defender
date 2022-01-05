<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Market;
use App\Models\Stall;
use App\Models\StallsPhoto;
use App\Models\CategoriesFood;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class StallController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Stall Show', ['only' => 'index']);
        $this->middleware('permission:Stall Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Stall Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Stall Delete', ['only' => 'destroy']);
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
        $optionMarket = ['value' => null, 'label' => ''];
        $stalls = Stall::with(['city', 'region', 'market']);

        if ($request->get('city')) {
            $stalls->where('city_id', $request->city);
            $city = City::where('id', $request->city)->first();
            $optionCity = [
                'value' =>  $city->id,
                'label' => $city->city_name
            ];
        }

        if ($request->get('region')) {
            $stalls->where('region_id', $request->region);
            $region = Region::where('id', $request->region)->first();
            $optionRegion = [
                'value' =>  $region->id,
                'label' => $region->region_name
            ];
        }

        if ($request->get('market')) {
            $stalls->where('market_id', $request->market);
            $market = Market::where('id', $request->market)->first();
            $optionMarket = [
                'value' =>  $market->id,
                'label' => $market->market_name
            ];
        }

        if ($request->get('keyword')) {
            $stalls->where('stall_name', 'LIKE', "%{$request->keyword}%");
        }
        return view('stalls.index', [
            'stalls' => $stalls->orderBy('stall_name', 'asc')->paginate(10),
            'optionCity' => $optionCity,
            'optionRegion' => $optionRegion,
            'optionMarket' => $optionMarket,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoriesFood::all();

        $statuses = $this->statuses();
        return view('stalls.create', compact('statuses', 'categories'));
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
            'city' => 'required',
            'region' => 'required',
            'market' => 'required',
            'stall_name' => 'required|string|max:30',
            'stall_slug' => 'required|string|unique:stalls,stall_slug',
            'stall_address' => 'required',
            'stall_cover' => 'required',
            'stall_desc' => 'required',
            'stall_operational' => 'required',
            'stall_gmap' => 'required',
            'stall_iframe' => 'required',
            'stall_phone' => 'required|max:12',
            'stall_wa' => 'required|max:12',
        ]);

        DB::beginTransaction();
        try {
            $stall = Stall::create([
                'city_id' => $request->city,
                'region_id' => $request->region,
                'market_id' => $request->market,
                'stall_name' => $request->stall_name,
                'stall_slug' => $request->stall_slug,
                'stall_address' => $request->stall_address,
                'stall_cover' => parse_url($request->stall_cover)['path'],
                'stall_desc' => $request->stall_desc,
                'stall_operational' => $request->stall_operational,
                'stall_phone' => $request->stall_phone,
                'stall_wa' => $request->stall_wa,
                'stall_iframe' => $request->stall_iframe,
                'stall_gmap' => $request->stall_gmap,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);

            if ($request->hasFile("photos")) {
                foreach ($request->photos as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName();
                    $request['stall_id'] = $stall->id;
                    $request['filename'] = $imageName;
                    $photo->move(\public_path("/images"), $imageName);
                    StallsPhoto::create($request->all());
                }
            }

            //dd($request->photo);

            $stall->categories()->attach($request->category);
            Alert::success('Add Stall', 'Added Stall Success');
            return redirect()->route('stall.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        //dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function show(Stall $stall)
    {
        $categories = $stall->categories;
        return view('stalls.show', compact('stall', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function edit(Stall $stall)
    {
        $categories = CategoriesFood::all();
        $marketChecked = $stall->categories->pluck('id')->toArray();
        $citySelected = $stall->city;
        $regionSelected = $stall->region;
        $marketSelected = $stall->market;
        $photos = $stall->photos->all('filename');
        $statuses = $this->statuses();

        //dd($photos);
        return view('stalls.edit', compact('stall', 'categories', 'photos', 'marketChecked', 'marketSelected', 'citySelected', 'regionSelected', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stall $stall)
    {
        $request->validate([
            'city' => 'required',
            'region' => 'required',
            'market' => 'required',
            'stall_name' => 'required|string|max:30,' . $stall->id,
            'stall_slug' => 'required|string|unique:stalls,stall_slug,' . $stall->id,
            'stall_address' => 'required',
            'stall_cover' => 'required',
            'stall_desc' => 'required',
            'stall_operational' => 'required',
            'stall_gmap' => 'required',
            'stall_iframe' => 'required',
            'stall_phone' => 'required|max:12',
            'stall_wa' => 'required|max:12',
        ]);

        DB::beginTransaction();
        try {
            $stall->update([
                'city_id' => $request->city,
                'region_id' => $request->region,
                'market_id' => $request->market,
                'stall_name' => $request->stall_name,
                'stall_slug' => $request->stall_slug,
                'stall_address' => $request->stall_address,
                'stall_cover' => parse_url($request->stall_cover)['path'],
                'stall_desc' => $request->stall_desc,
                'stall_operational' => $request->stall_operational,
                'stall_phone' => $request->stall_phone,
                'stall_wa' => $request->stall_wa,
                'stall_iframe' => $request->stall_iframe,
                'stall_gmap' => $request->stall_gmap,
                'is_active' => ($request->is_active) ? '1' : '0',
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName();
                    $request['stall_id'] = $stall->id;
                    $request['filename'] = $imageName;
                    $photo->move(\public_path("/images"), $imageName);
                    StallsPhoto::create($request->all());
                }
            }

            $stall->categories()->sync($request->category);
            Alert::success('Update Stall', 'Updated Stall Success');
            //dd($request->photo);
            return redirect()->route('stall.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th->getMessage());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stall  $stall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stall $stall)
    {
        try {
            $stall->delete();
            Alert::success('Delete Kios', 'Delete Kios Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Kios', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }

    public function deleteimagestall($id)
    {
        try {
            $photos = StallsPhoto::findOrFail($id);
            if (File::exists("images/" . $photos->filename)) {
                File::delete("images/" . $photos->filename);
            }

            StallsPhoto::find($id)->delete();
            Alert::success('Delete Images', 'Delete Images Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Images', 'Error' . $th->getMessage());
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
