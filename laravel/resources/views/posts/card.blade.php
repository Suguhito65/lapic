<div class="card mb-5">
    <div class="card-header text-center bg-secondary">
        <a href="{{ route('users.show', $post->user_id) }}" class="text-white btn">
            <span class="font-weight-bold">投稿者：</span>{{ $post->user->name }}
        </a>
    </div>
    <div class="card-body">
        <p class="card-title"><span class="font-weight-bold">内容：</span>{{ $post->body }}</p>
        <div>
            <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="card-link btn btn-success mb-3" style="width: 100%">詳細</a>
        </div>
    </div>
</div>