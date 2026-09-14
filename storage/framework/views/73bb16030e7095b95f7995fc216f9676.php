<?php $__env->startSection('sidebar'); ?>
<div class="custom-sidebar">
    <div class="sidebar-header">
        <span class="header-text">👤 الأدمن</span>
    </div>

    <nav class="sidebar-nav" style="display: flex; flex-direction: column; justify-content: center;">
        <a href="<?php echo e(route('admin.permissions')); ?>" class="sidebar-link <?php echo $__env->yieldContent('sidebar-permissions'); ?>">
            <span class="icon">🔐</span> 
            <span class="text">المستخدمين والصلاحيات</span>
        </a>

        <a href="<?php echo e(route('admin.fields')); ?>" class="sidebar-link <?php echo $__env->yieldContent('sidebar-fields'); ?>">
            <span class="icon">📊</span> 
            <span class="text">البيانات المدخلة</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="<?php echo e(route('user.logout')); ?>" method="POST" style="margin: 0; width: 100%;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="logout-link" style="background: none; border: none; cursor: pointer; text-align: right; width: 100%; display: flex; align-items: center; color: inherit; font: inherit; padding: 14px 22px;">
                <span class="icon">🚪</span> 
                <span class="text">تسجيل الخروج</span>
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/admin-layout.blade.php ENDPATH**/ ?>