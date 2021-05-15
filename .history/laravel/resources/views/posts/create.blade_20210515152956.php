@extends('layouts.app')
@section('title', '新規投稿ページ')
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        @include('layouts.error')
        <div class="card shadow">
        <h3 class="card-header text-center text-white" for="exampleFormControlTextarea1" style="background: linear-gradient(45deg, #ffa500, #f00, #ffa500)">新規投稿</h3>
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <p class="form-group">
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="title" name="title">
                    </p>
                    <p class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="body" name="body" rows="3"></textarea>
                    </p>
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                            <option selected="">選択する</option>
                            <option value="1">息子</option>
                            <option value="2">娘</option>
                            <option value="3">犬</option>
                            <option value="4">猫</option>
                            <option value="5">その他</option>
                        </select>
                    </div>
                    <div class="text-center mt-3">
                        <input class="btn btn-primary px-4 mt-3" style="border-radius: 1.2em" type="submit" value="投稿する">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection