

<?php $__env->startSection('title', 'تعديل الملاحظة'); ?>

<?php $__env->startPush('styles'); ?>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: "Cairo", sans-serif;
  background-color: #e8e8e8 !important;
}

.logo-area {
  width: 100%;
  padding: 5px 0 0 0;
  text-align: center;
}

.logo-area img {
  max-width: min(800px, 100%);
  height: auto;
  display: block;
  margin: 0 auto;
}

.container {
  max-width: 900px;
  margin: 40px auto 0 auto;
  padding: clamp(12px, 4vw, 20px);
  box-sizing: border-box;
}

.btn-delete-sm {
    background-color: #D20E00 !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 5px 12px !important;
    font-size: 14px !important;
    color: white !important;
}

.edit-note-container {
    max-width: 700px;
    margin: clamp(20px, 5vw, 40px) auto;
    background: #fff;
    padding: clamp(16px, 5vw, 30px);
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    box-sizing: border-box;
    width: calc(100% - 24px);
}

.edit-note-header {
    border-bottom: 2px solid #f0f0f0;
    margin-bottom: 25px;
    padding-bottom: 15px;
}

.edit-note-header h1 {
    font-size: clamp(18px, 5vw, 24px);
    color: #3B524A;
    margin: 0;
    font-weight: bold;
}

.form-label-custom {
    font-weight: bold;
    color: #444;
    margin-bottom: 8px;
    display: block;
    font-size: clamp(14px, 4vw, 16px);
}

.custom-input {
    border-radius: 10px !important;
    padding: 12px 15px !important;
    border: 1px solid #ddd !important;
    transition: all 0.3s ease;
    width: 100%;
    box-sizing: border-box;
    font-size: clamp(14px, 4vw, 15px);
}

.custom-input:focus {
    border-color: #3B524A !important;
    box-shadow: 0 0 0 0.2rem rgba(126, 2, 2, 0.1) !important;
}

.custom-textarea {
    min-height: 150px;
    resize: none;
    overflow: hidden;
    line-height: 1.6;
}

.invalid-feedback { color: red; font-size: 13px; margin-top: 5px; }
.is-invalid { border-color: red !important; }

.edit-actions {
    margin-top: 30px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: space-between;
}

.btn-save-note {
    background-color: #3B524A !important;
    color: #ffffff !important;
    border: none !important;
    padding: 10px clamp(16px, 5vw, 30px) !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
    text-align: center;
    min-width: 120px;
}

.btn-save-note:hover {
    background-color: #497033 !important;
    transform: translateY(-2px);
}

.btn-save-note:active {
    transform: translateY(0);
}

.btn-back-note {
    background-color: #6c757d !important;
    color: #ffffff !important;
    text-decoration: none !important;
    padding: 10px clamp(16px, 5vw, 30px) !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
    text-align: center;
    min-width: 120px;
}

.btn-back-note:hover {
    background-color: #5a6268 !important;
    color: #ffffff !important;
}

@media (max-width: 480px) {
    .container {
        margin-top: 20px;
    }

    .edit-note-container {
        width: calc(100% - 16px);
        border-radius: 12px;
    }

    .edit-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-save-note,
    .btn-back-note {
        width: 100%;
        text-align: center;
    }
}

@media (max-width: 360px) {
    .edit-note-container {
        width: 100%;
        border-radius: 0;
        margin: 10px auto;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="edit-note-container">
                <a href=<?php echo $__env->yieldContent('backTo'); ?> class="btn btn-back-note"><i class="bi bi-arrow-right"></i>عودة</a>

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
        </form>
                <?php echo $__env->yieldContent('deleteButton'); ?>
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/note-layout.blade.php ENDPATH**/ ?>