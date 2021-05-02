<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController', ['only' => ['index','show', 'create', 'store']]);
Route::get('posts/edit/{id}', 'PostController@edit');
Route::post('posts/edit', 'PostController@update');
Route::post('posts/delete/{id}', 'PostController@destroy');Copy
 

こんな感じです。

コントローラーの編集
Viewとモデルをつなぐ役目のコントローラーですが、今回はほぼメインパーツです。

コントローラーファイル
編集するのは以下の通り。

PostController.php

基本的な動きはここだけでできます。

PostController.php
<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::id();
        //インスタンス作成
        $post = new Post();
        
        $post->body = $request->body;
        $post->user_id = $id;

        $post->save();

       return redirect()->to('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $usr_id = $post->user_id;
        $user = DB::table('users')->where('id', $usr_id)->first();
        

        return view('posts.detail',['post' => $post,'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $usr_id = $post->user_id;
        $post = \App\Post::findOrFail($id);

        return view('posts.edit',['post' => $post]);
        // return view('posts.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->post_id;
        
        //レコードを検索
        $post = Post::findOrFail($id);
        
        $post->body = $request->body;
        
        //保存（更新）
        $post->save();
        
        return redirect()->to('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = \App\Post::find($id);
        //削除
        $post->delete();

        return redirect()->to('/posts');
    }
}Copy
 

モデルの編集
今回そこまで使いませんが、本来であればDBの接続、関数の指定などに使います。

モデルファイル
今回編集するのは以下の通り。

Post.php

User.phpはデフォルトのままにします。

Post.php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    
}Copy
protected $table = 'posts';だけ加えました。

これでテーブルを指定したので、コントローラーからインスタンスを呼び出すと、postsテーブルを選択できます。

Viewの編集
特にコマンドではなく、新規ファイルを作っていきましょう。

場所は、/resources/viewsになります。

welcome.blade.phpが入っているのが目印です。

作成ファイル一覧
・index.blade.php
・detail.blade.php
・create.blade.php
・edit.blade.php

ちなみにbladeと言うのがlaravelのviewを作る上で使います。

これを使うことで独自の関数の読み込みができたりするので、覚えておきましょう。

【ポイント】共通部分はテンプレに
質問者質問者
headerやfooterなどは基本的に同じものをつかうはどうすればいいですか？
そういった毎回書いていること、使い回すようなパーツはテンプレートにするのが有効です。

なので、こういう風に考えます。

一つ一つファイルを作る

テンプレートのベースを作って、そこにパーツを入れる

なので変更していきましょう。

テンプレの基礎となるファイルを作成
先ほど、Authで作成した、

/resources/views/layoutsの中にapp.blade.phpというファイルがあります。

それを編集していきましょう。

app.blade.php
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App掲示板 - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/posts') }}">
                    App掲示板
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <a href="/posts/create" class="btn btn-outline-primary">新規投稿</a>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        {{ __('Home') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.app_script')
</body>
</html>Copy
という感じです。

@yield('content')とかいてある、yield(イェルド)というのがテンプレを表示するもので、カッコ内にどこのパーツを持っていくか書きます。

Viewファイル
テンプレができたので、中身の部分を作成します。

ディレクトリは、分かりやすくするために/resources/views/postsします。

index.blade.php
一番最初に表示する部分ですね。

@extends('layouts.app')
@section('title', 'TOP page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-8 offset-1 offset-md-2">
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
@endsectionCopy
ポイントは@extends('layouts.app')をつけることで、テンプレにしたapp.blade.phpと紐づきます。継承するって言い方もしますね。

detail.blade.php
編集

@extends('layouts.app')
@section('title', 'detail page')

@section('content')
<div class="container">
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <div class="card-header">
                   {{ $post->id }}
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $post->body }}</p>
                    <div class="card-footer bg-transparent"><span class="font-weight-bold">by:</span> {{ $user->name }}</div>
                    @auth
                        <a href="{{ url('posts/edit/'.$post->id) }}" class="btn btn-dark">編集する</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsectionCopy
 

create.blade.php
新規作成

@extends('layouts.app')
@section('title', 'create page')

@section('content')
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <form action="/posts" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">新規投稿</label>
                    <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <div class="text-center mt-3">
                        <input class="btn btn-primary" type="submit" value="投稿する">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsectionCopy
edit.blade.php
投稿編集

@extends('layouts.app')

@section('title', 'edit page')
@section('content')
    <div class="row">
        <!-- メイン -->
        <div class="col-10 col-md-6 offset-1 offset-md-3">
            <div class="card">
                <form action="/posts/edit" method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <p class="card-text">
                    <textarea class="form-control" name="body" id="exampleFormControlTextarea1" rows="3">{{$post->body}}</textarea>
                    </p>
                    <div class="text-center mt-3">
                        <input name="post_id" type="hidden" value="{{$id}}" >
                        <input class="btn btn-primary" type="submit" value="変更する">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsectionCopy
app_script.blade.php
削除ボタン用です。

<script>
  $(function(){
  $(".post_del_btn").click(function(){
  if(confirm("削除しますか？")){
  //そのままsubmit（削除）
  }else{
  //cancel
  return false;
  }
  });
  });
</script>Copy
スクリプトもかけちゃいます。

 laravel mysql

 

読まれてます新卒を捨てた私が派遣エンジニアを選んだ理由【おすすめエージェント紹介】

読まれてます【スクール出身者が選んだ】オススメのプログラミングスクールまとめ
RELATED POST

FREELANCE
【個人開発用】これだけ覚えておくべきgitの使い方【普段使わない人も】
2021年2月17日

PROGRAMMING
WordPressで自作テーマをサクッと作ってみる【その3】
2019年4月2日

PROGRAMMING
GAEにあるプロジェクトのソースコードをDLする(2つの方法)
2019年8月13日

FREELANCE
【個人開発用】これだけ覚えておくべきgitの使い方【普段使わない人も】
2021年2月17日

PROGRAMMING
WordPressで自作テーマをサクッと作ってみる【その3】
2019年4月2日

PROGRAMMING
GAEにあるプロジェクトのソースコードをDLする(2つの方法)
2019年8月13日

FREELANCE
【個人開発用】これだけ覚えておくべきgitの使い方【普段使わない人も】
2021年2月17日

PROGRAMMING
WordPressで自作テーマをサクッと作ってみる【その3】
2019年4月2日

PROGRAMMING
GAEにあるプロジェクトのソースコードをDLする(2つの方法)
2019年8月13日
記事検索
キーワードを入力してEnter
プロフィール

管理者 : もんしょー
Twitter
YouTube
詳しいプロフィール

ポートフォリオサイトへ

スキルセット・過去の開発案件

お問い合わせフォーム

web制作の依頼はこちら

 

おすすめ




カテゴリー
LIFE
BLOG
ENGINNER
FREELANCE
WORK
MONEY
PROGRAMMING
REVIEW
THOUGHT
TRAVEL
月別記事

月を選択
よく読まれる記事
1
カフェやコワーキングよりおすすめ！「快活クラブ」のオープンシートがいい！
2
エンジニアの私がポートフォリオサイトを作成した理由【スキルの見える化】
3
仕事を「休職したい。。」は甘えなのか。休職経験者が語ります。
4
新卒を捨てた私が派遣エンジニアを選んだ理由【おすすめエージェント紹介】
