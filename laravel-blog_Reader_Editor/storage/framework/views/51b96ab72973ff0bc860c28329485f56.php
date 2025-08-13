<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title','Editor'); ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .avatar-badge{
      width:32px;height:32px;display:inline-flex;align-items:center;justify-content:center;
      border-radius:50%;font-weight:700;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?php echo e(route('editor.home')); ?>">Editor</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ednav"
            aria-controls="ednav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="ednav" class="collapse navbar-collapse">
      
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="<?php echo e(route('editor.home')); ?>">Home</a></li>
      </ul>

      
      <ul class="navbar-nav ms-auto align-items-center">
        <?php if(auth()->guard()->check()): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span class="avatar-badge bg-primary text-white">
                <?php echo e(strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1))); ?>

              </span>
              <span class="d-none d-sm-inline"><?php echo e(auth()->user()->name); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow">
              <li><a class="dropdown-item" href="<?php echo e(route('editor.posts.create')); ?>">Create Post</a></li>

            <?php $currentPost = request()->route('post');
            ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $currentPost)): ?>
            <li>
            <a class="dropdown-item" href="<?php echo e(route('editor.posts.edit', $currentPost)); ?>">
            Edit Post</a></li>
<?php endif; ?>
              <li><a class="dropdown-item" href="<?php echo e(route('posts.mine')); ?>">My Posts</a></li>
              <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>">Edit Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="<?php echo e(route('logout')); ?>"><?php echo csrf_field(); ?>
                  <button class="dropdown-item">Logout</button>
                </form>
              </li>
            </ul>
          </li>
        <?php else: ?>
          
          <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="py-4">
  <?php echo $__env->yieldContent('content'); ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\Mi.tasks\laravel-blog\resources\views/layouts/editor.blade.php ENDPATH**/ ?>