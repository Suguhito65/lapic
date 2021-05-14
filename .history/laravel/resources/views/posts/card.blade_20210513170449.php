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
<div class="card mb-5">
    <div class="card-header text-center bg-secondary">
        <span class="font-weight-bold">：</span>{{ $post->user->name }}
    </div>
    <div class="card-body" style="background: #fafafa">
        <div class="card-title">
            <i class="fas fa-user-circle"></i><span class="font-weight-bold"> 投稿者</span>
            <a href="{{ route('users.show', $post->user_id) }}" class="text-dark btn">
                {{ $post->user->name }}
            </a>
        </div>
        <div class="card-title text-break">
            <i class="fas fa-comment-dots"></i>
            <span class="font-weight-bold"> 投稿</span>　{{ $post->body }}
        </div>
        <div class="row justify-content-around card-footer bg-transparent pt-4">
            <div>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn">
                    <i class="fas fa-pen text-success"></i>
                </a>
            </div>
        </div>
        
    </div>
</div>