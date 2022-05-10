<div>
    <h1 class="my-4 text-3xl font-bold">{{('コメント返信')}}</h1>
    <div class="my-4 p-4 rounded-lg bg-blue-200">
        <ul>
            @foreach($replies as $rep)
            <p class="text-xs @if($rep->user_id == 'DaiNaka') text-right @endif">{{$rep->created_at}} ＠{{$rep->user_id}}</p>
            <li class="w-max mb-3 p-2 rounded-lg bg-blue-200 relative @if($rep->user_id == 'DaiNaka') self ml-auto @else other @endif">
                {{$rep->comment}}
            </li>
            @endforeach
        </ul>
    </div>
    {!! Form::open(['route' => ['reply.store', $post->id]]) !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '2']) !!}
    {!! Form::submit('返信する', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
</div>