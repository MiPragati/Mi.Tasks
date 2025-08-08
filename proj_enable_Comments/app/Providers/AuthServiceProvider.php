use App\Models\Post;
use App\Policies\PostPolicy;

protected $policies = [
    Post::class => PostPolicy::class,
];
