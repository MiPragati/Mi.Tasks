<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = ['name', 'email', 'comment', 'post_id'];

    public function post(){
        return $this->belogsTo(Post::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

}
