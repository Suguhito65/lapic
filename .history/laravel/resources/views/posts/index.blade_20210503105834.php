@extends('layouts.app')
@section('title', 'トップページ')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 col-md-8 offset-1 offset-md-2">
            @if (session('err_msg'))
                <p class="text-danger">
                    {{ session('err_msg') }}
                </p>
            @endif
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th colspan="3">内容</th>
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->body }}</td>
                        
                        <td>
                            <a href="{{ url('posts/'.$post->id) }}" class="btn btn-success">詳細</a>
                        @auth
                            <form action="/posts/delete/{{$post->id}}" method="POST">
                                {{ csrf_field() }}
                                <input type="submit" value="削除" class="btn btn-danger post_del_btn">
                            </form>
                        @endauth
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>
@endsection