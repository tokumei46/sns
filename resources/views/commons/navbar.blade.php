<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h3>SNS BOX</h3>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-haspopup="true" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarSupportedContent" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarSupportedContent">
                            <a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">{{ __('ユーザー詳細') }}</a>
                            <a class="dropdown-item" href="{{ url('/') }}">{{ __('ツイート一覧')}}</a>
                            <a class="dropdown-item" href="{{ route('users.followings', Auth::user()->id) }}">{{ __('ユーザー検索')}}</a>
                            <a class="dropdown-item" href="{{ route('users.favorites', Auth::user()->id) }}">{{ __('お気に入り')}}</a>
                            <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}">{{ __('プロフィール変更')}}</a>
                            <a class="dropdown-item" href="{{ route('chat.index', Auth::user()->id) }}">{{ __('チャット')}}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                            </a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            </li>
            @endguest
            </ul>
        </div>
</div>
</nav>

