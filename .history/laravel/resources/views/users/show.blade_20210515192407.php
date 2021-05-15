@extends('layouts.app')
@section('title', 'ユーザーページ')
@section('content')
@include('posts.search')
<div class="row">
    @foreach ($user->posts as $post)
        @include('posts.card')
    @endforeach
</div>

@endsection