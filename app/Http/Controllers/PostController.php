<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $validating;

    public function __construct() {
        $this->validating = [
            'title' => 'required',
            'slug' => 'unique',
            'description' => 'required',
            'category_id' => 'required'
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myPost = Post::with('categories')->get();
        return view('post.index', ['posts' => $myPost]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->validating);
        $post = new Post;
        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->description = $request->description;
        $post->save();

        $post->categories()->attach($request->category_id);
        return redirect('/post')->with('success', 'Post Successfully Published');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $myPost = Post::with(['categories'])
                        ->where('id', $post->id)
                        ->get();
        return view('post.edit', ['posts' => $myPost]);
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
        $validated = $request->validate($this->validating);
        $post->title = $request->title;
        $post->slug = Str::slug($post->title);
        $post->description = $request->description;
        $post->save();

        $post->categories()->sync($request->category_id, ['post_id' => true]);
        return redirect('/post')->with('update', 'Post Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->categories()->detach();
        $post->delete();
        return redirect('/post')->with('delete', 'Your Post Has Been Deleted');
    }
}
