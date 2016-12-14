


<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <h1>Jobs Posted <small>job listing</small></h1>
    </div>

    <?php if(count($posts)> 0): ?>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="panel panel-default">
                <div class="panel-heading"><a href="<?php echo e(\Core\Helper::makeUrl("post/show/".$post->id)); ?>"> <?php echo e($post->title); ?></a></div>
                <div class="panel-body">
                    <?php echo e($post->description); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php else: ?>
    No jobs found
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates\template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>