

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="edit-note-container">

        <div class="edit-note-header text-center">
            <h1>تعديل ملاحظة: <?php echo e($note->employee->name); ?></h1>
        </div>

        <form method="POST" action="<?php echo e(route('user.note.update', $note->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label class="form-label-custom">العنوان</label>
                <input type="text" name="title" 
                       value="<?php echo e(old('title', $note->title)); ?>" 
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
unset($__errorArgs, $__bag); ?>"placeholder="اكتب ملاحظاتك هنا..."><?php echo e(old('note', $note->note)); ?></textarea>
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
                    <i class="bi bi-check-lg"></i> حفظ التعديلات
                </button>
                <a href="<?php echo e(route('user.employee.show', encodeId($note->employee->id))); ?>" 
                   class="btn btn-back-note" 
                   onclick="return confirm('هل أنت متأكد؟ لم تقم بحفظ التعديلات!')">
                    <i class="bi bi-arrow-right"></i> رجوع
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('script.js')); ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.querySelector('.custom-textarea');
        
        // وظيفة لتعديل الارتفاع
        function autoResize() {
            textarea.style.height = 'auto'; // إعادة التعيين لحساب الطول الجديد
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        // تشغيل الوظيفة فور تحميل الصفحة لعرض النص الموجود كاملاً
        autoResize();

        // تشغيل الوظيفة أثناء الكتابة (إذا أراد المستخدم التعديل)
        textarea.addEventListener('input', autoResize);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.index-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/user/notes/edit.blade.php ENDPATH**/ ?>