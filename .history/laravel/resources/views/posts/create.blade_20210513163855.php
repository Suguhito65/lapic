@extends('layouts.app')
@section('title', '新規投稿ページ')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        @include('layouts.error')
        <div class="card">
        <div class="card-header text-center bg-dark text-white" for="exampleFormControlTextarea1" style="font-size: 1.5em">新規投稿</div>
            <form action="/post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <p class="card-text">
                        <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </p>
                    <div class="text-center mt-3">
                        <input class="btn btn-primary mt-3" style="width:100%" type="submit" value="投稿する">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection