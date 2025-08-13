<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog CMS</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>
</head>
<body class="antialiased">
    <nav class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div>
                <a href="<?php echo e(route('posts.index')); ?>" class="mr-4">Home</a>
                <span class="text-muted mx-3">|</span>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('editor.posts.create')); ?>" class="mr-4">Create Post</a>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="mr-4">Admin Dashboard</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div>
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="mr-2">Login</a>
                    <span class="text-muted mx-3">|</span>
                    <a href="<?php echo e(route('register')); ?>" class="mr-2">Register (Editor)</a>
                    <span class="text-muted mx-3">|</span>
                    <a href="<?php echo e(route('admin.register.form')); ?>" class="mr-2">Register (Admin)</a>
                <?php else: ?>
                    <span class="mr-2">Hello, <?php echo e(auth()->user()->name); ?></span>
                    <span class="text-muted mx-3">|</span>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" style="display:inline"><?php echo csrf_field(); ?> <button type="submit">Logout</button></form>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <?php if(session('success')): ?> <div class="bg-green-200 p-2 mb-4"><?php echo e(session('success')); ?></div> <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH D:\Mi.tasks\laravel-blog\resources\views/layouts/app.blade.php ENDPATH**/ ?>