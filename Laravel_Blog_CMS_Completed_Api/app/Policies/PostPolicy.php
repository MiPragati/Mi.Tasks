<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['editor', 'admin']);

    }

    public function update(User $user, Post $post)
    {
        return $user->isAdmin() || $post->user_id === $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $user->isAdmin() || $post->user_id === $user->id;
    }
}
