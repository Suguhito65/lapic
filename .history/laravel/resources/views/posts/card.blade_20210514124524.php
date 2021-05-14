<div class="col-md-4">
    <div class="card mb-5">
        <div class="card-header text-center text-white" style="background: linear-gradient(45deg, #ffa500, #f00, #ffa500)">
            <span class="font-weight-bold">ID</span> {{ $post->id }}
        </div>
        <div class="card-body">
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
                @guest
                    <a href="{{ route('login') }}" class="btn">
                        <i class="far fa-heart" style="color: #ee82ee"></i> {{ $post->likes->count() }}
                    </div>
                @else
                    <like
                        :post-id="{{ json_encode($post->id) }}"
                        :user-id="{{ json_encode($userAuth->id) }}"
                        :default-Liked="{{ json_encode($post->defaultLiked($post, $userAuth->id)) }}"
                        :default-Count="{{ json_encode(count($post->likes)) }}"
                    ></like>
                @endguest
                <div>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn">
                        <i class="fas fa-pen text-success"></i>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</div>