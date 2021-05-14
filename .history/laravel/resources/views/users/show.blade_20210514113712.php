@extends('layouts.app')
@section('title', 'ユーザーページ')
@section('content')
@include('posts.search')
<div class="row">
    @if (session('err_msg'))
        <p class="text-danger">
            {{ session('err_msg') }}
        </p>
    @endif
    @foreach ($user->posts as $post)
        @include('posts.card')
    @endforeach
</div>
@endsection