@extends('layouts.app')
@section('title', 'トップページ')
@section('content')
@include('posts.search')
<div class="row">
    <div class="col-10 col-md-6 offset-1 offset-md-3">
        @if (session('err_msg'))
            <p class="alert alert-danger text-center">
                {{ session('err_msg') }}
            </p>
        @endif
        <div class="col"></div>
        @foreach ($posts as $post)
            @include('posts.card')
        @endforeach
    </div>
</div>
@endsection