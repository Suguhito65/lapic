@extends('layouts.app')
@section('title', '詳細ページ')
@section('content')
<div class="row">
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="card shadow">
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
                    <span class="font-weight-bold"> 投稿　</span>{{ $post->body }}
                </div>
                <like class="text-center"
                    :post-id="{{ json_encode($post->id) }}"
                    :user-id="{{ json_encode($userAuth->id) }}"
                    :default-Liked="{{ json_encode($defaultLiked) }}"
                    :default-Count="{{ json_encode($defaultCount) }}"
                ></like>
                @can('edit', $post)
                    <div class="row justify-content-around mt-3">
                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="btn btn-success  px-4" style="border-radius: 1.2em">編集</a>
                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete btn btn-danger px-4" style="border-radius: 1.2em">削除</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
        <div class="card mt-5 shadow">
            <div class="card-header text-center text-white" style="background: linear-gradient(45deg, #ffa500, #f00, #ffa500)"><i class="fas fa-comment-alt"></i> コメント一覧</div>
            <div class="p-3">
                @foreach($post->comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <div class="pb-3">
                                <p class="card-text text-break">{{ $comment->comment }}</p>
                            </div>
                            @can('edit', $comment)
                                <div class="text-right">
                                    <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="delete btn btn-sm">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                    <div class="text-right mb-3">  
                        <a href="{{ route('users.show', $comment->user->id) }}" class="text-dark btn">
                        <i class="fas fa-user-circle"></i> {{ $comment->user->name }}
                        </a>
                    </div>
                @endforeach
                <div class="text-center mt-3">
                    <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary px-4 mb-1" style="border-radius: 1.2em">
                        コメント投稿
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
