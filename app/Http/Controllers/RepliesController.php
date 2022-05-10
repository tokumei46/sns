<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Post;
use App\Models\User;
use Google\Service\CloudRun\ExecAction;

class RepliesController extends Controller
{
    public function reps() {
        if (\Auth::check()) {
            $user = \Auth::user();

            $replies = $user->replies()->orderBy('created_at', 'desc')->get();

            $data = [
                'user' => $user,
                'replies' => $replies,
            ];
        }
        return view('posts.posts', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|max:300',
        ]);
        $reply = new Reply;
        $reply->user_id = \Auth::id();
        $reply->comment = $request->comment;
        $reply->save();
        return back();
    }
}
