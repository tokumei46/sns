{!! Form::open(['route' => 'posts.store']) !!}
    <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
    </div>
{!! Form::close() !!}
