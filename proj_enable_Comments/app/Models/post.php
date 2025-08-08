<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ['title','content','category_id', 'user_id','media'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

public function comments(){
    return $this->hasMany(Comment::class);
}

}
