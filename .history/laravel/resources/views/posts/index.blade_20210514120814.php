@extends('layouts.app')
@section('title', 'トップページ')
@section('content')
@include('posts.search')
<div class="row">
    @foreach ($posts as $post)
        @include('posts.card')
    @endforeach
</div>
@endsection