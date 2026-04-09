

<?php $__env->startSection('loginForWho', "تسجيل دخول المستخدمين"); ?>

<?php $__env->startSection('action', route('doLogin')); ?>

<?php $__env->startSection('goTo', route('admin.login')); ?>

<?php $__env->startSection('goTo-text'); ?>
انتقل للأدمن
<br><br>
<a href="<?php echo e(route('user.register')); ?>">إنشاء حساب جديد</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.login', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/user/login.blade.php ENDPATH**/ ?>