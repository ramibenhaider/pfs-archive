

<?php $__env->startSection('title', 'لوحة التحكم'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="perm-container-unique">
    <h2 class="section-title">إدارة صلاحيات المستخدمين</h2>

    <div class="perm-card-wrapper">
        <ul class="perm-table-header">
            <li>اسم المستخدم</li>
            <li>الحالة</li>
            <li>إضافة موظف</li>
            <li>حذف موظف</li>
            <li>تعديل موظف</li>
            <li>إضافة مستند</li>
            <li>عرض مستند</li>
            <li>حذف مستند</li>
            <li>إجراء</li>
        </ul>

        <div class="perm-table-body">
            <?php $__currentLoopData = /*$user*/s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as /*$user*/): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <ul class="perm-row-item">
                <li class="emp-name-cell"><strong><?php echo e(/*$user*/->name); ?></strong></li>
                
                <li>
                    <label class="switch-perm">
                        <input type="checkbox" <?php echo e(/*$user*/->is_active ? 'checked' : ''); ?>>
                        <span class="slider-perm"></span>
                    </label>
                </li>

                <?php for($i = 0; $i < 6; $i++): ?>
                <li>
                    <label class="switch-perm">
                        <input type="checkbox">
                        <span class="slider-perm"></span>
                    </label>
                </li>
                <?php endfor; ?>

                <li>
                    <button class="btn-delete-perm" title="حذف المستخدم">
                        🗑️
                    </button>
                </li>
            </ul>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="perm-footer-actions">
            <button class="save-btn-perm">حفظ التغييرات</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>