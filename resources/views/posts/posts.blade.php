@if (isset($posts) > 0)
<ul class="list-unstyled">
    @foreach ($posts as $post)
    <li class="media mb-3">
        <div class="media-body border">
            <div>
                <a class="nav-link" href="{{ route('users.show', $post->user->id) }}">{{ $post->user->name }}</a>
                <p class="mb-0">　{!! nl2br(e($post->content)) !!}</p>
                <span class="text-muted">　posted at {{ $post->created_at }}</span>
            </div>
            <div class="row justify-content-center">
                @if($post->users()->where('user_id', Auth::id())->exists())
                <div class="col-md-2">
                    {!! Form::open(['route' => ['post.unfavorite', $post->id], 'method' => 'delete']) !!}
                    {!! Form::submit('いいねはずす', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
                @else
                <div class="col-md-2">
                    {!! Form::open(['route' => ['post.favorite', $post->id], 'method' => 'post']) !!}
                    {!! Form::submit('いいね', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
                @endif
            </div>
            @if (Auth::id() == $post->user_id)
            {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
            {!! Form::close() !!}
            @endif
        </div>
    </li>
    @endforeach
    @endif