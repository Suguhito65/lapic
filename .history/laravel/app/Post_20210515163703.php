<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth; // ユーザーIDを取得するため

class Post extends Model
{
    protected $fillable = [
        'userid', 'user_id', 'category_id', 'title', 'body'
    ];

    public function category(){
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo(\App\Category::class,'category_id');
      }

    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(\App\Comment::class, 'post_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'post_id', 'id');
    }

    public function defaultLiked($post, $user_auth_id)
    {
        $defaultLiked = $post->likes->where('user_id', $user_auth_id)->first();

        if(isset($defaultLiked) == 0) {
            $defaultLiked == false;
        } else {
            $defaultLiked == true;
        }

        return $defaultLiked;
    }
}
