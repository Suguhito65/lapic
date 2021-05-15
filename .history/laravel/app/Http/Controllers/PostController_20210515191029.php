<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Like;
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
        $q = Request::query();
        // いいね
        $userAuth = \Auth::user();

        if(isset($q['category_id'])){
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(3);
            $posts->load('category', 'user', 'likes');

            return view('posts.index', [
                'posts' => $posts,
                'category_id' => $q['category_id'],
                'userAuth' => $userAuth // いいね
            ]);
        } else {
            $posts = Post::latest()
            $posts->load('category', 'user', 'likes');

            return view('posts.index', [
                'posts' => $posts,
                'userAuth' => $userAuth // いいね
            ]);
        }
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
        $rules = [
            'title' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric']
        ];
        $this->validate($request, $rules);

        $post = new Post();
        $post->user_id = $request->user_id;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->body = $request->body;

        $post->save();

        \Session::flash('err_msg', '登録しました。');

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $userAuth = \Auth::user(); // いいね

        $post->load('user', 'category', 'likes');

        // いいね
        $defaultCount = count($post->likes);
        $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();
        if(isset($defaultLiked) == 0) {
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

        return view('posts.show',[
            'post' => $post,
            // いいね
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::findOrFail($post->id);
        $this->authorize('edit', $post); // 認可
        return view('posts.edit',[
            'post' => $post
        ]);
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
        $rules = [
            'title' => ['required'],
            'body' => ['required'],
            'category_id' => ['required', 'numeric'],
            'user_id' => ['required', 'numeric']
        ];
        $this->validate($request, $rules);

        $id = $request->post_id;
        $post = Post::findOrFail($id);
        $this->authorize('edit', $post); // 認可
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        
        $post->save();

        \Session::flash('err_msg', '更新しました。');
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post = Post::find($post->id);
        $this->authorize('edit', $post); // 認可
        $post->delete();

        \Session::flash('err_msg', '削除しました。');

        return redirect('/');
    }

    // 検索機能
    public function search(Request $request)
    {
        $userAuth = \Auth::user(); // いいね

        $posts = Post::where('body', 'like', '%'.$request->search.'%')
            ->paginate(3);

        $search_result = $request->search.'の検索結果は'.$posts->total().'件';

        return view('posts.index', [
            'posts' => $posts,
            'search_result' => $search_result,
            'search_query'  => $request->search,
            'userAuth' => $userAuth // いいね
        ]);
    }
}
