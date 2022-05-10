@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ログイン成功') }}
                    <a class="nav-item" href="{{ route('users.show', Auth::user()->id) }}">{{ __('ユーザー詳細') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
