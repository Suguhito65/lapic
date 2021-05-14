@extends('layouts.app')
@section('title', '詳細ページ')
@section('content')
<div class="row">
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="card">
            <div class="card-header text-center bg-secondary">
                <span class="font-weight-bold">ID</span> {{ $post->user->id }}
            </div>
            <div class="card-body" style="background: #fafafa">>
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
                @can('edit', $post)
                    <div class="row justify-content-around mt-3">
                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="btn btn-success  px-4" style="border-radius: 1.2em">編集</a>
                        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete btn btn-danger">削除</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection