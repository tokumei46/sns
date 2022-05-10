<div class="card">
    <div class="card-header">
        <h3 class="card-name">{{ $user->name }}</h3>  
        <p class="card-title">ID : {{ $user->id }}</p>
        <p class="card-title">自己紹介 : {{ $user->comment }}</p>
    </div>
</div>
@include('user_follow.follow')