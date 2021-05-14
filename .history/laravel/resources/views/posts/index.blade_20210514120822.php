@extends('layouts.app')
@section('title', 'トップページ')
@section('content')
@include('posts.search')
@if (session('err_msg'))
        <p class="alert alert-danger text-center">
            {{ session('err_msg') }}
        </p>
@endif
<div class="row">
    @foreach ($posts as $post)
        @include('posts.card')
    @endforeach
</div>
@endsection