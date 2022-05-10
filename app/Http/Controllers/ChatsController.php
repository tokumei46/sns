<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatsController extends Controller
{

    public function index() {
        $length = Chat::all()->count();

        $display = 5;
        $chats = Chat::offset($length-$display)->limit($display)->get();
        return view('chats.chats',compact('chats'));
    }

    public function store(Request $request) {
        $chat = new Chat;
        $form = $request->all();
        $chat->fill($form)->save();
        return back();
    }
}
