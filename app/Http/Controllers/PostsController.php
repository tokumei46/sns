<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Reply;


class PostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();

            $posts = $user->free_posts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'posts' => $posts,
            ];
        }
        return view('welcome', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:300',
        ]);

        $request->user()->posts()->create([
            'content' => $request->content,
        ]);
        return back();
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(\Auth::id() === $post->user_id) {
            $post->delete();
        }
        return back();
    }
}
