<div class="card mb-5">
    <div class="card-header text-center text-white" style="background: linear-gradient(45deg, orange, red, orange)">
        <span class="font-weight-bold">ID</span> {{ $post->id }}
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
            <like
                :post-id="{{ json_encode($post->id) }}"
                :user-id="{{ json_encode($userAuth->id) }}"
                :default-Liked="{{ json_encode($post->defaultLiked($post, $userAuth->id)) }}"
                :default-Count="{{ json_encode(count($post->likes)) }}"
            ></like>
            <div>
                <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn">
                    <i class="fas fa-pen text-success"></i>
                </a>
            </div>
        </div>
        
    </div>
</div>