

<?php $__env->startSection('content'); ?>

    <h1>Create Job</h1>
    <p>Create a job post</p>

    <?php if(isset($errors) && count($errors)> 0): ?>
        <?php $__currentLoopData = $errors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <div class="alert-danger alert-dismissable alert"> <?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    <?php endif; ?>

    <form method="post" action="<?php echo e(\Core\Helper::makeUrl('post/post')); ?>">
        <div class="form-group col-lg-6">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>

        <div class="form-group col-lg-6">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
        </div>

        <div class="form-group col-lg-12">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description"></textarea>
        </div>

        <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-primary" value="Post job">
        </div>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates\template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>