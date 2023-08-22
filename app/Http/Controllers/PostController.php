<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostDetailResource;
use GuzzleHttp\Psr7\Response;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('writer:id,username')->get();
        // return response()->json(['data' => $posts]);
        return PostDetailResource::collection($posts);
    }

    public function show($id)
    { //penulisan with custom tidak memakai spasi

        $posts = Post::with('writer:id,username')->findOrFail($id);

        // return response()->json(['data' => $posts]);
        // penulisan jangan pakai collection karena show

        return new PostDetailResource($posts);
    }

    public function show2($id)
    {
        $posts = Post::findOrFail($id);
        return new PostDetailResource($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
