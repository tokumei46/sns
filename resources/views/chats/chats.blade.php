@extends('layouts.app')
@section('content')
<div>
    <h1 class="my-4 text-3xl font-bold">{{('チャット')}}</h1>
    <div class="my-4 p-4 rounded-lg bg-blue-200">
        <ul>
            @foreach ($chats as $chat)
            <p class="text-xs @if($chat->user_name == 'DaiNaka') text-right @endif">{{$chat->created_at}} ＠{{$chat->user_name}}</p>
                    <li class="w-max mb-3 p-2 rounded-lg bg-blue-200 relative @if($chat->user_name == 'DaiNaka') self ml-auto @else other @endif">
                        {{$chat->message}}
                    </li>
            @endforeach
        </ul>
    </div>
    <form class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow" action="/chat" method="POST">
        @csrf
        <input type="hidden" name="user_identifier" value="test">
        <input class="py-1 px-2 rounded text-center flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20">
        <input class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded flex-auto" type="text" name="message" placeholder="Input message." maxlength="200">
        <button class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded text-center bg-gray-500 text-white" type="submit">Send</button>
    </form>
</div>
@endsection