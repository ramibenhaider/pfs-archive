

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('sidebar'); ?>
<div class="custom-sidebar">
    <div class="sidebar-header">
        <span class="header-text">👤 الأدمن</span>
    </div>

    <nav class="sidebar-nav" style="display: flex; flex-direction: column; justify-content: center;">
        <a href="#" class="sidebar-link active">
            <span class="icon">🔐</span> 
            <span class="text">المستخدمين والصلاحيات</span>
        </a>

        <a href="#" class="sidebar-link">
            <span class="icon">📊</span> 
            <span class="text">البيانات المدخلة</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="#" class="logout-link">
            <span class="icon">🚪</span> 
            <span class="text">تسجيل الخروج</span>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/layouts/admin-layout.blade.php ENDPATH**/ ?>