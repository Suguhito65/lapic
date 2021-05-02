@extends('layouts.app')
@section('title', '詳細ページ')
@section('content')
<div class="row">
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="card">
            <div class="card-header text-center bg-secondary">
                <a href="#" class="text-white btn">
                    <span class="font-weight-bold">ID：</span>{{ $post->id }}
                </a>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <span class="font-weight-bold">内容：</span>{{ $post->body }}
                </p>
                
                <div class="row justify-content-center mt-3">
                    <a href="{{ route('posts.edit',['id' => $post->id]) }}" class="btn btn-success mr-3">編集</a>
                
                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="delete btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection