<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'post_id', 'comment_id', 'author', 'title', 'text'
    ];

    public function comments(){
        return $this->hasMany('App\Comment', 'comment_id');
    }

    public function nestedComments(){
        foreach ($this->comments as $comment) {
            $comment->nestedComments();
        }
    }
}
