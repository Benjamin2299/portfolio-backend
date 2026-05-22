<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where("status", "published")
            ->orderBy("published_at", "desc")
            ->get();

        return response()->json($posts);
    }

    public function show($slug)
    {
        $post = Post::where("slug", $slug)
            ->where("status", "published")
            ->firstOrFail();

        $post->increment("views");

        return response()->json($post);
    }
}