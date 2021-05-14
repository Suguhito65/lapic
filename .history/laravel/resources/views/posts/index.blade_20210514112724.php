@extends('layouts.app')
@section('title', 'トップページ')
@section('content')
@include('posts.search')
<div class="row">

        @if (session('err_msg'))
            <p class="alert alert-danger text-center">
                {{ session('err_msg') }}
            </p>
        @endif
        <div class="col">
        @foreach ($posts as $post)
            @include('posts.card')
        @endforeach
        </div>
    </div>
</div>
@endsection