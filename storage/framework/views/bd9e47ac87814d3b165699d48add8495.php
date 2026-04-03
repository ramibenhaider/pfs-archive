

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('title'); ?>
بيانات الموظف
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الاسم:</strong>
                        <textarea class="text-muted form-control auto-resize" rows="1"><?php echo e($employee->name); ?></textarea>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الرقم الوظيفي:</strong>
                        <span class="text-muted"><?php echo e($employee->job_number); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>رقم الهوية:</strong>
                        <span class="text-muted"><?php echo e($employee->id_number); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>رقم جواز السفر:</strong>
                        <span class="text-muted"><?php echo e($employee->passport_number); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>تاريخ انتهاء الهوية:</strong>
                        <span class="text-muted"><?php echo e($employee->expiry_date_id); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الإدارة:</strong>
                        <span class="text-muted"><?php echo e($employee->management->management_name); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الجنسية:</strong>
                        <span class="text-muted"><?php echo e($employee->nationality->nationality_name); ?></span>
                    </li>
                </ul>

                <div class="card-footer">
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary btn-sm">رجوع</a>
                    <a href="#" class="btn btn-primary btn-sm">حفظ التعديلات</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/employee/show.blade.php ENDPATH**/ ?>