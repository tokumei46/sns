@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                @include('users.card')
            </aside>
            <div class="col-sm-8">
                @include('posts.form')
                @include('posts.posts')
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the sns</h1>
            </div>
        </div>
    @endif
@endsection