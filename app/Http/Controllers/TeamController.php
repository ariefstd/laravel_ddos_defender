<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\CategoriesTeam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Team Show', ['only' => 'index']);
        $this->middleware('permission:Team Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Team Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Team Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teams = Team::with(['category']);
        if ($request->get('category')) {
            $category = $request->category;
            $teams->whereHas(
                'category',
                function ($query) use ($category) {
                    $query->where('category_name', 'LIKE', "%{$category}%");
                }
            );
        } else {
        }

        if ($request->get('keyword')) {
            $teams->search($request->keyword);
        }
        return view('teams.index', [
            'teams' => $teams->orderBy('team_name', 'asc')->paginate(10)->withQueryString(),
            'categories' => CategoriesTeam::all()
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
        return view('teams.create', compact('statuses'));
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
                "category" => "required",
                "team_name" => "required|string|max:30",
                "team_slug" => "required|string|unique:teams,team_slug",
                "team_seq" => "required|string",
                "team_position" => "required|string|max:255",
                "team_image" => "required|string",
                "team_desc" => "required"
            ],
            []
        );

        Team::create([
            'category_id' => $request->category,
            'team_name' => $request->team_name,
            'team_slug' => $request->team_slug,
            'team_seq' => $request->team_seq,
            'team_position' => $request->team_position,
            'team_image' => $request->team_image,
            'team_desc' => $request->team_desc,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Team', 'Added Team Success');
        //dd($request->all());
        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $statuses = $this->statuses();
        $categorySelected = $team->category;
        return view('teams.edit', compact('team', 'statuses', 'categorySelected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            "category" => "required",
            "team_name" => "required|string|max:30," . $team->id,
            "team_slug" => "required|string|unique:teams,team_slug," . $team->id,
            "team_seq" => "required|string",
            "team_position" => "required|string|max:255",
            "team_image" => "required|string",
            "team_desc" => "required"
        ]);
        $team->update([
            'category_id' => $request->category,
            'team_name' => $request->team_name,
            'team_slug' => $request->team_slug,
            'team_seq' => $request->team_seq,
            'team_position' => $request->team_position,
            'team_image' => $request->team_image,
            'team_desc' => $request->team_desc,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);
        Alert::success('Update Team', 'Updated Team Success');
        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            Alert::success('Delete Team', 'Delete Team Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Team', 'Error' . $th->getMessage());
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
