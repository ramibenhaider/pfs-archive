

<?php $__env->startSection('title', 'تعديل الملاحظة'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="edit-note-container">

        <div class="edit-note-header text-center">
            <h1><?php echo $__env->yieldContent('note-title'); ?></h1>
        </div>

        <form method="POST" action="<?php echo $__env->yieldContent('action'); ?>">
            <?php echo csrf_field(); ?>
            <?php echo $__env->yieldContent('method'); ?>

            <div class="mb-4">
                <label class="form-label-custom">العنوان</label>
                <input type="text" name="title" 
                       value="<?php echo e(old('title', $note->title ?? $myNote->title ?? '')); ?>" 
                       class="form-control custom-input <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="أدخل عنوان الملاحظة">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label class="form-label-custom">الملاحظة التفصيلية</label>
                <textarea name="note" class="form-control custom-input custom-textarea <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"placeholder="اكتب ملاحظاتك هنا..."><?php echo e(old('note', $note->note ?? $myNote ?? '')); ?></textarea>
                <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn btn-save-note">
                    <i class="bi bi-check-lg"></i> حفظ
                </button>
                <a href=<?php echo $__env->yieldContent('backTo'); ?> class="btn btn-back-note"><i class="bi bi-arrow-right"></i>عودة</a>
        </form>
                <?php echo $__env->yieldContent('deleteButton'); ?>
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/note-layout.blade.php ENDPATH**/ ?>