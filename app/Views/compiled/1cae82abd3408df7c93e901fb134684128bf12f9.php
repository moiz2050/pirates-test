

<?php $__env->startSection('content'); ?>

    <h1><?php echo e($post->title); ?></h1>
    <p><?php echo e($post->description); ?></p>

    <?php if($post->status == \App\Models\Post::POST_STATUS_PUBLISHED): ?>
        <p><span class="label label-primary">Published</span></p>
    <?php elseif($post->status == \App\Models\Post::POST_STATUS_PENDING): ?>
        <p><span class="label label-warning">Pending</span></p>
    <?php elseif($post->status == \App\Models\Post::POST_STATUS_SPAM): ?>
        <p><span class="label label-danger">Spam</span></p>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates\template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>