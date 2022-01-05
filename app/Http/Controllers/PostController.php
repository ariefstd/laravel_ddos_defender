<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\CategoriesPost;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Post Show', ['only' => 'index']);
        $this->middleware('permission:Post Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Post Update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Post Delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::with(['category']);

        if ($request->get('category')) {
            $category = $request->category;
            $posts->whereHas(
                'category',
                function ($query) use ($category) {
                    $query->where('category_title', 'LIKE', "%{$category}%");
                }
            );
        } else {
        }

        if ($request->get('keyword')) {
            $posts->search($request->keyword);
        }
        return view('posts.index', [
            'posts' => $posts->orderBy('created_at', 'desc')->paginate(7)->withQueryString(),
            'categoriesPosts' => CategoriesPost::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CategoriesPost::all();
        $tags = Tag::all();
        $statuses = $this->statuses();
        return view('posts.create', compact('statuses', 'tags', 'categories'));
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
            'post_title' => 'required|string|max:100|unique:posts,post_title',
            'post_slug' => 'required|string|unique:posts,post_slug',
            'post_thumbnail' => 'required',
            'post_excerpt' => 'required|string|max:500',
            'post_desc' => 'required|string',
            'category' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $post = Post::create([
                'category_id' => $request->category,
                'post_title' => $request->post_title,
                'post_slug' => $request->post_slug,
                'post_thumbnail' => parse_url($request->post_thumbnail)['path'],
                'post_excerpt' => $request->post_excerpt,
                'post_desc' => $request->post_desc,
                'post_meta_title' => $request->post_meta_title,
                'post_meta_description' => $request->post_meta_description,
                'post_meta_keyword' => $request->post_meta_keyword,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            $post->tags()->attach($request->tag);
            Alert::success('Add Post', 'Added Post Success');
        } catch (\Throwable $th) {
            DB::rollBack();
            //dd($th->getMessage());
        } finally {
            DB::commit();
        }

        //dd($request->all());
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = $post->categories;
        $tags = $post->tags;

        return view('posts.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = CategoriesPost::all();

        $statuses = $this->statuses();
        $categorySelected = $post->category;

        //dd($post->category);
        return view('posts.edit', compact('post', 'categorySelected', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'post_title' => 'required|string|max:100',
                'post_slug' => 'required|string|unique:posts,post_slug,' . $post->id,
                'post_thumbnail' => 'required',
                'post_excerpt' => 'required|string|max:500',
                'post_desc' => 'required|string',
                'category' => 'required'
            ],
            [],
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'tag_title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        DB::beginTransaction();
        try {
            $post->update([
                'category_id' => $request->category,
                'post_title' => $request->post_title,
                'post_slug' => $request->post_slug,
                'post_thumbnail' => parse_url($request->post_thumbnail)['path'],
                'post_excerpt' => $request->post_excerpt,
                'post_desc' => $request->post_desc,
                'post_meta_title' => $request->post_meta_title,
                'post_meta_description' => $request->post_meta_description,
                'post_meta_keyword' => $request->post_meta_keyword,
                'is_active' => ($request->is_active) ? '1' : '0',
                'user_id' => $request->user_id
            ]);
            $post->tags()->sync($request->tag);

            Alert::success('Update Post', 'Updated Post Success');
            //dd($request->all());
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::success('Update Post', 'Updated Post Success', ['error' => $th->getMessage()]);
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'tag_title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally {
            DB::commit();
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            Alert::success('Delete Post', 'Delete Post Success');
        } catch (\Throwable $th) {
            Alert::error('Delete Post', 'Error' . $th->getMessage());
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
