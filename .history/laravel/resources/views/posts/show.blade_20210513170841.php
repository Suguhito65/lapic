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
                <p class="card-text">
                    <span class="font-weight-bold">内容：</span>{{ $post->body }}
                </p>
                @can('edit', $post)
                    <div class="row justify-content-center mt-3">
                        <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="btn btn-success mr-3">編集</a>
                    
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