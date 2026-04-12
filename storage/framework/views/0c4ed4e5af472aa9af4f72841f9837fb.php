

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-createEmployee">
    <div class="mb-3">
        <a href="<?php echo e(route('user.employee.show', encodeId($employee->id))); ?>" class="btn-back-note" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <span>&larr;</span> رجوع
        </a>
    </div>

    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="edit-note-container" style="margin-bottom: 30px;">
        <div class="edit-note-header">
            <h1>تعديل بيانات المستند</h1>
        </div>

        <form action="<?php echo e(route('user.documents.update', $document->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-grid">
                <div class="form-group">
                    <label>اسم الموظف</label>
                    <input type="text" value="<?php echo e($document->employee->name); ?>" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group">
                    <label>نوع المستند</label>
                    <input type="text" value="<?php echo e($document->document_type->type); ?>" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>اسم الملف</label>
                    <input type="text" value="<?php echo e($document->original_name); ?>" disabled class="custom-input" readonly>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label-custom">التعليق</label>
                    <textarea name="comment" class="form-control custom-input custom-textarea auto-resize" placeholder="أدخل ملاحظاتك هنا..."><?php echo e($document->comment); ?></textarea>
                </div>
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn-save-note">حفظ التعديلات</button>
        </form>

                <form action="<?php echo e(route('user.documents.destroy', $document->id)); ?>" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستند نهائياً؟');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
                        حذف المستند
                    </button>
                </form>
            </div>
    </div>
    <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/user/document/show.blade.php ENDPATH**/ ?>