<?php

namespace App\Http\Controllers;

use App\Models\FlashNews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FlashNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Flash New Show', ['only' => 'index']);
        $this->middleware('permission:Flash New Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Flash New Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Flash New Delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $news = [];
        if ($request->get('keyword')) {
            $news = FlashNews::search($request->keyword)->orderBy('created_at', 'desc')->paginate(9);
        } else {
            $news = FlashNews::orderBy('created_at', 'desc')->paginate(9);
        }
        return view('flash-news.index', [
            'news' => $news
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
        return view('flash-news.create', compact('statuses'));
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
            'news_name' => 'required|string|max:255',
            'news_slug' => 'required|string|unique:flash_news,news_slug',

        ]);

        FlashNews::create([
            'news_name' => $request->news_name,
            'news_slug' => $request->news_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Add Flash News', 'Added Flash News Success');
        return redirect()->route('flash-news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function show(FlashNews $flashNews)
    {
        return view('flash-news.show', compact('flashNews'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function edit(FlashNews $flashNews)
    {
        $statuses = $this->statuses();
        return view('flash-news.edit', compact('flashNews', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlashNews $flashNews)
    {
        $request->validate([
            'news_name' => 'required|string|max:255,' . $flashNews->id,
            'news_slug' => 'required|string|unique:flash_news,news_slug,' . $flashNews->id,

        ]);

        $flashNews->update([
            'news_name' => $request->news_name,
            'news_slug' => $request->news_slug,
            'is_active' => ($request->is_active) ? '1' : '0',
        ]);

        Alert::success('Update Flash News', 'Update Flash News Success');
        return redirect()->route('flash-news.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlashNews  $flashNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlashNews $flashNews)
    {
        try {
            $flashNews->delete();
            Alert::success('Delete Flash News', 'Delete Flash News Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Flash News', 'Error' . $th->getMessage());
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
