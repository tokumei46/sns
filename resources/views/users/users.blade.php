@if (count($users) > 0)
<ul class="list-unstyled">
    @foreach ($users as $user)
    <li class="media">
        <div class="media-body">
            <div>
                {{ $user->name }}
            </div>
            <div>
                <p><a class="nav-link" href="{{ route('users.show', ['user' => $user]) }}">{{ __('ユーザー詳細') }}</a></p>
                @if (Auth::id() != $user->id)
                @if (Auth::user()->is_following($user->id))
                {!! Form::open(['route' => ['user.unfollow', $user->id], 'method' => 'delete']) !!}
                {!! Form::submit('フォロー外す', ['class' => "btn btn-danger"]) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['route' => ['user.follow', $user->id], 'method' => 'post']) !!}
                {!! Form::submit('フォロー', ['class' => "btn btn-primary "]) !!}
                {!! Form::close() !!}
                @endif
                @endif
            </div>
        </div>
    </li>
    @endforeach
</ul>
@endif
<form class="mb-2 mt-4 text-center" method="GET" action="{{ route('users.index') }}">
    <input class="form-control my-2 mr-5" type="search" placeholder="ユーザー名を入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
    <div class="d-flex justify-content-center">
        <button class="btn btn-info my-2" type="submit">検索</button>
        <button class="btn btn-secondary my-2 ml-5">
            <a href="{{ route('users.index') }}" class="text-white">
                クリア
            </a>
        </button>
    </div>
</form>
</ul>