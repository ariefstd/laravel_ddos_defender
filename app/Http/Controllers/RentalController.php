<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Market;
use App\Models\RentalPhoto;
use App\Models\Rental;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RentalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Rental Show', ['only' => 'index']);
        $this->middleware('permission:Rental Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Rental Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Rental Delete', ['only' => 'destroy']);
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
        $rentals = Rental::with(['city', 'region', 'market']);

        if ($request->get('city')) {
            $rentals->where('city_id', $request->city);
            $city = City::where('id', $request->city)->first();
            $optionCity = [
                'value' =>  $city->id,
                'label' => $city->city_name
            ];
        }

        if ($request->get('region')) {
            $rentals->where('region_id', $request->region);
            $region = Region::where('id', $request->region)->first();
            $optionRegion = [
                'value' =>  $region->id,
                'label' => $region->region_name
            ];
        }

        if ($request->get('market')) {
            $rentals->where('market_id', $request->market);
            $market = Market::where('id', $request->market)->first();
            $optionMarket = [
                'value' =>  $market->id,
                'label' => $market->market_name
            ];
        }

        if ($request->get('keyword')) {
            $rentals->where('rental_name', 'LIKE', "%{$request->keyword}%");
        }
        return view('rentals.index', [
            'rentals' => $rentals->orderBy('rental_name', 'asc')->paginate(10),
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
        $positions = $this->positions();
        $statuses = $this->statuses();
        return view('rentals.create', compact('statuses', 'positions'));
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
            'rental_name' => 'required|string|max:30',
            'rental_slug' => 'required|string|unique:rentals,rental_slug',
            'rental_address' => 'required',
            'rental_cover' => 'required',
            'rental_desc' => 'required',
            'rental_gmap' => 'required',
            'rental_iframe' => 'required',
            'rental_phone' => 'required',
            'rental_wa' => 'required',
            'rental_price' => 'required',
            'rental_posisi' => 'required',
            'rental_size' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $rental = Rental::create([
                'city_id' => $request->city,
                'region_id' => $request->region,
                'market_id' => $request->market,
                'rental_name' => $request->rental_name,
                'rental_slug' => $request->rental_slug,
                'rental_address' => $request->rental_address,
                'rental_cover' => parse_url($request->rental_cover)['path'],
                'rental_desc' => $request->rental_desc,
                'rental_phone' => $request->rental_phone,
                'rental_wa' => $request->rental_wa,
                'rental_iframe' => $request->rental_iframe,
                'rental_gmap' => $request->rental_gmap,
                'rental_price' => $request->rental_price,
                'rental_posisi' => $request->rental_posisi,
                'rental_size' => $request->rental_size,
                'is_active' => ($request->is_active) ? '1' : '0',
                'is_recommended' => ($request->is_recommended) ? '1' : '0',
            ]);

            if ($request->hasFile("photos")) {
                foreach ($request->photos as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName();
                    $request['rental_id'] = $rental->id;
                    $request['filename'] = $imageName;
                    $photo->move(\public_path("/images"), $imageName);
                    RentalPhoto::create($request->all());
                }
            }

            Alert::success('Add Rental', 'Added Rental Success');
            return redirect()->route('rental.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        } finally {
            DB::commit();
        }
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function edit(Rental $rental)
    {
        $citySelected = $rental->city;
        $regionSelected = $rental->region;
        $marketSelected = $rental->market;
        $photos = $rental->photos->all('filename');
        $statuses = $this->statuses();
        $positions = $this->positions();

        //dd($photos);
        return view('rentals.edit', compact('rental', 'photos', 'marketSelected', 'citySelected', 'regionSelected', 'statuses', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'city' => 'required',
            'region' => 'required',
            'market' => 'required',
            'rental_name' => 'required|string|max:30,' . $rental->id,
            'rental_slug' => 'required|string|unique:rentals,rental_slug,' . $rental->id,
            'rental_address' => 'required',
            'rental_cover' => 'required',
            'rental_desc' => 'required',
            'rental_gmap' => 'required',
            'rental_iframe' => 'required',
            'rental_phone' => 'required',
            'rental_wa' => 'required',
            'rental_price' => 'required',
            'rental_posisi' => 'required',
            'rental_size' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $rental->update([
                'city_id' => $request->city,
                'region_id' => $request->region,
                'market_id' => $request->market,
                'rental_name' => $request->rental_name,
                'rental_slug' => $request->rental_slug,
                'rental_address' => $request->rental_address,
                'rental_cover' => parse_url($request->rental_cover)['path'],
                'rental_desc' => $request->rental_desc,
                'rental_phone' => $request->rental_phone,
                'rental_wa' => $request->rental_wa,
                'rental_iframe' => $request->rental_iframe,
                'rental_gmap' => $request->rental_gmap,
                'rental_price' => $request->rental_price,
                'rental_posisi' => $request->rental_posisi,
                'rental_size' => $request->rental_size,
                'is_active' => ($request->is_active) ? '1' : '0',
                'is_recommended' => ($request->is_recommended) ? '1' : '0',
            ]);

            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $imageName = time() . '_' . $photo->getClientOriginalName();
                    $request['rental_id'] = $rental->id;
                    $request['filename'] = $imageName;
                    $photo->move(\public_path("/images"), $imageName);
                    RentalPhoto::create($request->all());
                }
            }

            Alert::success('Update Rental', 'Updated Rental Success');
            //dd($request->photo);
            return redirect()->route('rental.index');
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
     * @param  \App\Models\Rental  $rental
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rental $rental)
    {
        try {
            $rental->delete();
            Alert::success('Delete Rental Kios', 'Delete Rental Kios Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Rental Kios', 'Error' . $th->getMessage());
        }
        return redirect()->back();
    }

    public function deleteimage($id)
    {
        try {
            $photos = RentalPhoto::findOrFail($id);
            if (File::exists("images/" . $photos->filename)) {
                File::delete("images/" . $photos->filename);
            }

            RentalPhoto::find($id)->delete();
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

    private function positions()
    {
        return [
            'luar' => 'Luar',
            'dalam' => 'Dalam',
        ];
    }
}
