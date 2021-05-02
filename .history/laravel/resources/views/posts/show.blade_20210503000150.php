@extends('layouts.app')
@section('title', '詳細ページ')
@section('content')
<div class="row">
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="card">
            <div class="card-header text-center bg-secondary">
                <a href="{{ route('users.show', $post->user_id) }}" class="text-white btn">
                    <span class="font-weight-bold">投稿者：</span>{{ $post->user->name }}
                </a>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <span class="font-weight-bold">内容：</span>{{ $post->body }}
                </p>
                <div class="card-title">
                    <span class="font-weight-bold">タグ：</span>
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('posts.index', ['tag_name' => $tag->tag_name]) }}" class="text-dark btn">
                            #{{ $tag->tag_name}}
                        </a>
                    @endforeach
                </div>
                <div class="card-footer bg-transparent">
                    @if ($image_url)
                        <!-- ローカル -->
                        <p class="text-center"><img class="img-fluid" src="/{{ $image_url }}"></p>
                        <!-- <p class="text-center"><img class="img-fluid" src="https://larapic65.s3.ap-northeast-1.amazonaws.com/{{ $image_url }}"></p> -->
                    @endif
                </div>
                <div class="text-center">
                    @if($post->is_liked_by_auth_user())
                        <a href="{{ route('posts.unlike', ['id' => $post->id]) }}" class="btn">
                            <i class="fas fa-heart" style="color: #ee82ee"></i> {{ $post->likes->count() }}
                        </a>
                    @else
                        <a href="{{ route('posts.like', ['id' => $post->id]) }}" class="btn">
                            <i class="far fa-heart" style="color: #ee82ee"></i> {{ $post->likes->count() }}
                        </a>
                    @endif
                </div>
                @can('edit', $post)
                    <div class="row justify-content-center mt-3">
                        <a href="{{ route('posts.edit',['id' => $post->id]) }}" class="btn btn-success mr-3">編集</a>
                    
                        <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="delete btn btn-danger">削除</button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection