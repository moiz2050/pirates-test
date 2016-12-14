

<?php $__env->startSection('content'); ?>

    <h1><?php echo e($title); ?></h1>
    <p><?php echo e($text); ?></p>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>