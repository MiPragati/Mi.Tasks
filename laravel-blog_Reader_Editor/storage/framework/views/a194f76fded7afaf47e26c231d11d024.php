<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-1 py-8">
    <h1 class="text-5xl font-bold mb-6">Browse Categories</h1>

    <div class="grid grid-cols-3 gap-6">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="border rounded-lg p-3 shadow hover:shadow-lg transition duration-300">
                <a href="<?php echo e(route('editor.categories.show', $category->slug)); ?>" class="text-xl font-semibold text-blue-600 hover:text-blue-800">
                    <?php echo e($category->name); ?>

                </a>
                <?php if($category->description): ?>
                    <p class="mt-2 text-gray-600"><?php echo e($category->description); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.editor', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Mi.tasks\laravel-blog\resources\views/editor/categories/index.blade.php ENDPATH**/ ?>