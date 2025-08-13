<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 fw-bold mb-0">My Posts</h1>
    <a href="<?php echo e(route('editor.posts.create')); ?>" class="btn btn-primary btn-sm">Create Post</a>
  </div>

  <?php if($posts->count()): ?>
    <div class="list-group">
      <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="list-group-item d-flex justify-content-between align-items-start">
          <div class="me-3">
            <div class="fw-semibold">
              <a href="<?php echo e(route('posts.show', $post->slug)); ?>" class="text-decoration-none"><?php echo e($post->title); ?></a>
            </div>
            <small class="text-muted">
              <?php echo e(optional($post->category)->name ?? 'Uncategorized'); ?> •
              <?php echo e(optional($post->created_at)->format('d M Y')); ?>

            </small>
          </div>
          <div class="d-flex gap-2">
            <a href="<?php echo e(route('posts.edit', $post)); ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
            <form method="POST" action="<?php echo e(route('posts.destroy', $post)); ?>" onsubmit="return confirm('Delete this post?')">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
              <button class="btn btn-outline-danger btn-sm">Delete</button>
            </form>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-3"><?php echo e($posts->links()); ?></div>
  <?php else: ?>
    <div class="alert alert-info">You haven’t written any posts yet.</div>
  <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.editor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Mi.tasks\laravel-blog\resources\views/posts/mine.blade.php ENDPATH**/ ?>