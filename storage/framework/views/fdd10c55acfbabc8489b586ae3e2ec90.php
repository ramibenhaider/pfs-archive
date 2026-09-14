<?php $__env->startSection('loginForWho', "تسجيل دخول المستخدمين"); ?>

<?php $__env->startSection('action', route('user.doLogin')); ?>

<?php $__env->startSection('goTo-text'); ?>
<a href="<?php echo e(route('user.register')); ?>" class="admin-link">إنشاء حساب جديد</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/login.blade.php ENDPATH**/ ?>